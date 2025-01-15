<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard Admin',
            'employees' => Employee::all()
        ]);
    }
    public function index2()
    {
        return view('dashboard.index2', [
            'title' => 'Dashboard Pegawai ',
            'employees' => Employee::all()
        ]);
    }
}
