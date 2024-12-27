<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data dari tabel employees
        $pegawai = Employee::select('id','id_number', 'name')->get(); // Ambil id dan name dari pegawai

        return view('groups.index', [
            'title' => 'Golongan',
            'groups' => Group::all(), // Ambil data dari tabel groups
            'pegawai' => $pegawai // Kirim data pegawai ke view
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_number' => 'required|exists:employees,id_number', // Pastikan id_number ada di tabel employees
            'nama_pegawai' => 'required|string|max:255',
            'basic_salary' => 'required|numeric',
        ]);

    // Menghapus koma jika ada dalam basic_salary
    $basicSalary = str_replace(',', '', $request->basic_salary);

        // Simpan data ke tabel groups
        Group::create([
            'id_number' => $request->id_number,
            'nama_pegawai' => $request->nama_pegawai,
            'basic_salary' => $request->basic_salary,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('groups.index')->with('messageSuccess', 'Data gaji berhasil ditambahkan.');
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Employee::all(); // Ambil semua data pegawai dari tabel 'employees'
        return view('groups.create', [
            'pegawai' => $pegawai,
            'title' => 'Tambah Data Gaji',
        ]);
    }
    
    public function showEmployees()
    {
        $employees = Employee::all();  // Fetch all employees from the database
        return view('groups.index', compact('employees'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return response()->json([
            'group' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        // Validasi input
        $rules = [
            'id_number' => 'required', // pastikan nama pegawai valid
            'basic_salary' => 'required', // gaji pokok harus angka dan minimal 100000
        ];

        // Jika nama pegawai berubah, pastikan validasi nama pegawai unik
        if ($request->id_number != $group->id_number) {
            $rules['id_number'] = 'required';
        }

        // Validasi data
        $validatedData = $request->validate($rules);

        // Proses untuk menghapus tanda koma pada basic_salary
        $validatedData['basic_salary'] = implode(explode(',', $request->basic_salary));

        // Update data golongan
        $group->update($validatedData);

        return redirect()->route('groups.index')->with('messageSuccess', 'Data golongan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        // Hapus data golongan
        $group->delete();

        return redirect()->route('groups.index')->with('messageSuccess', 'Data golongan berhasil dihapus');
    }
}