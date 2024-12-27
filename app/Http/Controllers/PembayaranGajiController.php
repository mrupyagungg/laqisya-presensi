<?php
namespace App\Http\Controllers;

use App\Models\PembayaranGaji;
use Illuminate\Http\Request;

class PembayaranGajiController extends Controller
{

    public function index()
    {
        // Ambil data gaji dari database
        $pembayaran = PembayaranGaji::all();
        
        return view('pembayaran.index', [
            'title' => 'pembayaran',
            'pembayaran' => $pembayaran
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'jumlah_gaji' => 'required|numeric|min:0',
        ]);

        // Simpan data pembayaran gaji
        PembayaranGaji::create([
            'pegawai_id' => $request->pegawai_id,
            'jumlah_gaji' => $request->jumlah_gaji,
            'tanggal_pembayaran' => now(),
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran gaji berhasil dilakukan');
    }
}