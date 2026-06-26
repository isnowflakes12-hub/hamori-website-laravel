<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $policies = PrivacyPolicy::orderBy('urutan')->paginate(20);
        return view('admin.privacy-policy.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.privacy-policy.form', ['policy' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required|string|max:10000',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only('judul', 'konten', 'urutan');
        $data['is_active'] = $request->boolean('is_active', true);

        PrivacyPolicy::create($data);
        return redirect()->route('admin.privacy-policy.index')->with('success', 'Kebijakan privasi berhasil ditambahkan.');
    }

    public function edit(PrivacyPolicy $privacy_policy)
    {
        return view('admin.privacy-policy.form', ['policy' => $privacy_policy]);
    }

    public function update(Request $request, PrivacyPolicy $privacy_policy)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required|string|max:10000',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only('judul', 'konten', 'urutan');
        $data['is_active'] = $request->boolean('is_active');

        $privacy_policy->update($data);
        return redirect()->route('admin.privacy-policy.index')->with('success', 'Kebijakan privasi berhasil diperbarui.');
    }

    public function destroy(PrivacyPolicy $privacy_policy)
    {
        $privacy_policy->delete();
        return back()->with('success', 'Kebijakan privasi berhasil dihapus.');
    }

    public function toggleActive(PrivacyPolicy $privacy_policy)
    {
        $privacy_policy->update(['is_active' => !$privacy_policy->is_active]);
        return back()->with('success', 'Status kebijakan privasi diperbarui.');
    }
}
