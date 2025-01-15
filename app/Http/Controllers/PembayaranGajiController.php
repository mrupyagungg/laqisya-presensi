<?php
namespace App\Http\Controllers;

use App\Models\PembayaranGaji;
use App\Models\Employee;
use App\Models\Group;
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

     public function store(Request $request)
        {
            $validated = $request->validate([
                'id_pegawai' => 'required|exists:employees,id', // Pastikan id_pegawai ada di tabel employees
                'nama_pegawai' => 'required|string',
                'jumlah_hadir' => 'required|integer|min:0',
                'potongan' => 'required|numeric|min:0',
                'bonus' => 'required|numeric|min:0',
            ]);
        
            // Hitung total
            $pegawai = Group::find($request->id_pegawai);
            if (!$pegawai) {
                return redirect()->back()->withErrors(['id_pegawai' => 'Pegawai tidak ditemukan']);
            }
            $basicSalary = $pegawai->basic_salary;
            $total = ($basicSalary * $validated['jumlah_hadir']) - $validated['potongan'] + $validated['bonus'];
        
            // Simpan data pembayaran
            PembayaranGaji::create([
                'id_pegawai' => $validated['id_pegawai'],
                'nama_pegawai' => $validated['nama_pegawai'],
                'jumlah_hadir' => $validated['jumlah_hadir'],
                'potongan' => $validated['potongan'],
                'bonus' => $validated['bonus'],
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