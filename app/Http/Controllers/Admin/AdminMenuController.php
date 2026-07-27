<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminMenu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = AdminMenu::whereNull('parent_id')->with('children')->orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = AdminMenu::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.menus.form', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'parent_id'  => 'nullable|exists:admin_menus,id',
            'name'       => 'required|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'url'        => 'nullable|string|max:255',
            'icon'       => 'nullable|string|max:255',
            'roles'      => 'nullable|array',
            'order'      => 'nullable|integer',
            // is_active dihandle manual di bawah (checkbox mengirim 'on', bukan boolean)
        ]);
        $data['is_active'] = $request->has('is_active');
        if(!$request->filled('roles')) {
            $data['roles'] = [];
        }

        AdminMenu::create($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(AdminMenu $menu)
    {
        $parents = AdminMenu::whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('order')->get();
        return view('admin.menus.form', compact('menu', 'parents'));
    }

    public function update(Request $request, AdminMenu $menu)
    {
        $data = $request->validate([
            'parent_id'  => 'nullable|exists:admin_menus,id',
            'name'       => 'required|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'url'        => 'nullable|string|max:255',
            'icon'       => 'nullable|string|max:255',
            'roles'      => 'nullable|array',
            'order'      => 'nullable|integer',
            // is_active dihandle manual di bawah (checkbox mengirim 'on', bukan boolean)
        ]);
        $data['is_active'] = $request->has('is_active');
        if(!$request->filled('roles')) {
            $data['roles'] = [];
        }

        $menu->update($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items'          => 'required|array',
            'items.*.id'     => 'required|exists:admin_menus,id',
            'items.*.order'  => 'required|integer',
            'items.*.children' => 'nullable|array',
            'items.*.children.*.id'    => 'exists:admin_menus,id',
            'items.*.children.*.order' => 'integer',
        ]);

        foreach ($request->items as $item) {
            AdminMenu::where('id', $item['id'])->update([
                'order'     => $item['order'],
                'parent_id' => null,
            ]);
            if (!empty($item['children'])) {
                foreach ($item['children'] as $child) {
                    AdminMenu::where('id', $child['id'])->update([
                        'order'     => $child['order'],
                        'parent_id' => $item['id'],
                    ]);
                }
            }
        }

        return response()->json(['success' => true]);
    }

    public function destroy(AdminMenu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
