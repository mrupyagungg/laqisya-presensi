<?php

namespace App\Http\Controllers;

use App\Models\PembayaranGaji;
use App\Models\Employee;
use App\Models\Group;
use App\Models\Average;
use Illuminate\Http\Request;

class PembayaranGajiController extends Controller
{
   
    public function index(Request $request)
    {
        $title = "Pembayaran Gaji";

        $query = PembayaranGaji::with('employee');

        if ($request->filled('filter_bulan')) {
            $bulan = $request->input('filter_bulan'); // format: YYYY-MM
            $tahun = substr($bulan, 0, 4);
            $bln = substr($bulan, 5, 2);

            $query->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bln);
        }

        $pembayaran = $query->get();

        $gaji = Group::all();
        $averages = Average::all();

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
    
        public function bayar(Request $request, $id)
    {
        // Cari data pembayaran berdasarkan id, jika tidak ditemukan maka 404
        $pembayaran = PembayaranGaji::findOrFail($id);

        // Validasi input dari request
        $request->validate([
            'grand_total' => 'required|numeric|min:0',
        ]);

        // Update data pembayaran
        $pembayaran->grand_total = $request->input('grand_total');  // Simpan grand_total
        $pembayaran->status = 'paid';  // Ubah status menjadi sudah dibayar (paid)
        $pembayaran->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pembayaran berhasil disimpan.');
    }

        public function bayarpajak(Request $request, $id)
    {
        // Cari data pembayaran berdasarkan id, jika tidak ditemukan maka 404
        $pembayaran = PembayaranGaji::findOrFail($id);

        // Validasi input dari request
        $request->validate([
            'grand_total' => 'required|numeric|min:0',
        ]);

        // Update data pembayaran
        $pembayaran->grand_total = $request->input('grand_total');  // Simpan grand_total
        $pembayaran->status = 'paid';  // Ubah status menjadi sudah dibayar (paid)
        $pembayaran->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pembayaran berhasil disimpan.');
    }


}