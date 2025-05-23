<?php

namespace App\Http\Controllers;

use App\Models\PembayaranGaji;
use App\Models\Employee;
use App\Models\Group;
use App\Models\Average;

use Illuminate\Http\Request;

class PembayaranGajiController extends Controller
{
        public function index()
    {
        $title = "Pembayaran Gaji";

        $pembayaran = PembayaranGaji::with('employee')->get();
        $gaji = Group::all();
        $averages = Average::all(); // Ambil semua data PTKP

        return view('pembayaran.index', compact('pembayaran', 'gaji', 'averages', 'title'));
    }


        public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pegawai' => 'required|exists:groups,id',
            'jumlah_hadir' => 'required|integer|min:0',
            'potongan' => 'required|numeric|min:0',
            'bonus' => 'required|numeric|min:0',
        ]);

        $pegawai = Group::find($request->id_pegawai);
        if (!$pegawai) {
            return redirect()->back()->withErrors(['id_pegawai' => 'Pegawai tidak ditemukan']);
        }

        $basicSalary = $pegawai->basic_salary;
        $jumlah_gaji = $basicSalary * $validated['jumlah_hadir'];
        $total = $jumlah_gaji - $validated['potongan'] + $validated['bonus'];
        $pembayaran = PembayaranGaji::with('group')->get();
        
        PembayaranGaji::create([
            'id_pegawai' => $request->id_pegawai,
            'nama_pegawai' => $pegawai->nama_pegawai ?? 'N/A', // pastikan field "nama" ada di tabel Group
            'jumlah_hadir' => $request->jumlah_hadir,
            'potongan' => $request->potongan,
            'jumlah_gaji' => $jumlah_gaji,
            'bonus' => $request->bonus,
            'total' => $total,
            
        ]);


        return redirect()->route('pembayaran.index')->with('messageSuccess', 'Gaji berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pembayaran = PembayaranGaji::findOrFail($id);
        $gaji = Group::all();

        return view('dashboard.pembayaran.edit', compact('pembayaran', 'gaji'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:groups,id',
            'jumlah_hadir' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
            'bonus' => 'required|numeric|min:0',
        ]);

        $pegawai = Group::find($request->id_pegawai);
        if (!$pegawai) {
            return redirect()->back()->withErrors(['id_pegawai' => 'Pegawai tidak ditemukan']);
        }

        $total = ($pegawai->basic_salary * $request->jumlah_hadir) - $request->potongan + $request->bonus;

        $pembayaran = PembayaranGaji::findOrFail($id);
        $pembayaran->update([
            'id_pegawai' => $request->id_pegawai,
            'nama_pegawai' => $pegawai->nama_pegawai,
            'jumlah_hadir' => $request->jumlah_hadir,
            'potongan' => $request->potongan,
            'bonus' => $request->bonus,
            'total' => $total,
        ]);

        return redirect()->route('pembayaran.index')->with('messageSuccess', 'Pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        PembayaranGaji::findOrFail($id)->delete();

        return redirect()->route('pembayaran.index')->with('messageSuccess', 'Pembayaran berhasil dihapus');
    }
        public function bayar($id)
    {
        $pembayaran = PembayaranGaji::findOrFail($id);
        $pembayaran->status = 'paid';
        $pembayaran->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

}