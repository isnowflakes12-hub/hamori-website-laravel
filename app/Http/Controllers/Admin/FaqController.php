<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('urutan')->paginate(20);
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.form', ['faq' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:500',
            'jawaban'    => 'required|string|max:5000',
            'urutan'     => 'nullable|integer|min:0',
        ]);

        $data = $request->only('pertanyaan', 'jawaban', 'urutan');
        $data['is_active'] = $request->boolean('is_active', true);

        Faq::create($data);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:500',
            'jawaban'    => 'required|string|max:5000',
            'urutan'     => 'nullable|integer|min:0',
        ]);

        $data = $request->only('pertanyaan', 'jawaban', 'urutan');
        $data['is_active'] = $request->boolean('is_active');

        $faq->update($data);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus.');
    }

    public function toggleActive(Faq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active]);
        return back()->with('success', 'Status FAQ diperbarui.');
    }
}
