<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::latest()->paginate(15);
        return view('admin.kontak.index', compact('kontaks'));
    }

    public function show(Kontak $kontak)
    {
        if (!$kontak->is_read) {
            $kontak->update(['is_read' => true]);
        }
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
