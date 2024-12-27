<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Employee;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        // Ambil data presensi dari database hari ini
        $presensi = Presensi::all();
        
        return view('presensi.index', [
            'title' => 'Presensi',
            'presensi' => $presensi, // Pastikan variabel presensi ini dikirim ke view
            'employees' => Employee::all() // Ambil data pegawai untuk form presensi
        ]);
    }
    
    // Menyimpan data presensi
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pegawai' => 'required|exists:employees,id', // Pastikan pegawai ada
            'status' => 'required|string',
            'tanggal' => 'required|date', // Validasi tanggal
        ]);

        // Menyimpan data presensi
        Presensi::create([
            'id_pegawai' => $request->id_pegawai,
            'status' => $request->status,
            'tanggal' => $request->tanggal, // Menggunakan tanggal yang dipilih
        ]);

        return redirect()->route('presensi.index')->with('messageSuccess', 'Presensi berhasil ditambahkan.');
    }
}
