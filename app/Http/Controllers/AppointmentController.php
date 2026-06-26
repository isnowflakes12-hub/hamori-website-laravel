<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Dokter;
use App\Models\Poli;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('pages.appointment', [
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'email'      => 'nullable|email',
            'telepon'    => 'required|string|max:20',
            'poli_id'    => 'required|exists:polis,id',
            'dokter_id'  => 'nullable|exists:dokters,id',
            'tanggal'    => 'required|date|after:today',
            'keterangan' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'telepon'    => $request->telepon,
            'poli_id'    => $request->poli_id,
            'dokter_id'  => $request->dokter_id,
            'tanggal'    => $request->tanggal,
            'keterangan' => $request->keterangan,
            'status'     => 'pending',
            'kode'       => 'APT-' . strtoupper(uniqid()),
        ]);

        return redirect()->back()->with('success', "Appointment berhasil dibuat dengan kode: {$appointment->kode}. Kami akan menghubungi Anda segera.");
    }
}
