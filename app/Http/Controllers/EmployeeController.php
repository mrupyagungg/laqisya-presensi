<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index', [
            'title' => 'Pegawai',
            'employees' => Employee::all() // Menampilkan semua pegawai tanpa grup
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Generate unique NIP (id_number)
        $latestEmployee = Employee::latest('id_number')->first();
        $lastIdNumber = $latestEmployee ? $latestEmployee->id_number : null;
        
        // Generate new NIP (e.g., "NIP-001", "NIP-002", etc.)
        $newIdNumber = 'NIP-' . str_pad((intval(substr($lastIdNumber, 4)) + 1), 3, '0', STR_PAD_LEFT);
    
        return view('employees.create', [
            'title' => 'Pegawai | Tambah Data',
            'newIdNumber' => $newIdNumber, // Pass generated NIP to the view
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_number' => 'required|unique:employees,id',
            'name' => 'required|string|max:255',
            'posisi' => 'required',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'no_telp' => 'nullable|numeric',
        ]);

        // Create the employee record
        Employee::create($request->all());

        // Redirect to the employees index page with a success message
        return redirect()->route('employees.index')->with('messageSuccess', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        // Menampilkan detail pegawai, jika diperlukan
        return response()->json([
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'title' => 'Edit Data Pegawai',
            'employee' => $employees
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // Validate the request data
        $request->validate([
            'id_number' => 'unique:employees,id_number,' . $employee->id,
            'name' => 'string|max:255',
            'posisi' => '',
            'alamat' => 'string',
            'jenis_kelamin' => 'in:Laki-Laki,Perempuan',
            'no_telp' => 'nullable|numeric',
        ]);
        

        // Update the employee record
        $employee->update($request->all());

        // Redirect to the employees index page with a success message
        return redirect()->route('employees.index')->with('messageSuccess', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);
        return redirect('/employees')->with('messageSuccess', 'Data pegawai berhasil dihapus');
    }
}