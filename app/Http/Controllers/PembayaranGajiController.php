<?php
namespace App\Http\Controllers;

use App\Models\PembayaranGaji;
use App\Models\Employee; // Pastikan model Pegawai sudah ada
use App\Models\Group; // Pastikan model Group sudah ada
use Illuminate\Http\Request;
class PembayaranGajiController extends Controller
{
    public function index()
    {
        // Mengambil semua data pembayaran
        $title = "Pembayran Gaji";
        $pembayaran = PembayaranGaji::with('employee')->get();
        $gaji = Group::all();

        return view('pembayaran.index', compact('pembayaran', 'gaji','title'));
    }

     // Menampilkan form tambah data gaji
     public function create()
     {
         $gaji = Employee::all();  // Mendapatkan daftar pegawai
         return view('pembayaran.create', compact('gaji'));
     }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'jumlah_hadir' => 'required|numeric',
            'potongan' => 'required|numeric',
            'bonus' => 'required|numeric',
            'total' => 'required',
        ]);

        // Hitung total
        $pegawai = Group::find($request->id_pegawai);
        $basicSalary = $pegawai->basic_salary;
        $total = ($basicSalary * $request->jumlah_hadir) - $request->potongan + $request->bonus;

        // Simpan data pembayaran
        PembayaranGaji::create([
            'id_pegawai' => $request->id_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'jumlah_hadir' => $request->jumlah_hadir,
            'potongan' => $request->potongan,
            'bonus' => $request->bonus,
            'total' => $total,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Ambil data pembayaran berdasarkan ID
        $pembayaran = PembayaranGaji::findOrFail($id);
        $gaji = Group::all();

        return view('dashboard.pembayaran.edit', compact('pembayaran', 'gaji'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_pegawai' => 'required',
            'jumlah_hadir' => 'required|numeric',
            'potongan' => 'required|numeric',
            'bonus' => 'required|numeric',
        ]);

        // Hitung total
        $pegawai = Employee::find($request->id_pegawai);
        $basicSalary = $pegawai->basic_salary;
        $total = ($basicSalary * $request->jumlah_hadir) - $request->potongan + $request->bonus;

        // Update data pembayaran
        $pembayaran = PembayaranGaji::findOrFail($id);
        $pembayaran->update([
            'id_pegawai' => $request->id_pegawai,
            'jumlah_hadir' => $request->jumlah_hadir,
            'potongan' => $request->potongan,
            'bonus' => $request->bonus,
            'total' => $total,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Hapus data pembayaran
        Pembayaran::findOrFail($id)->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus');
    }
}
