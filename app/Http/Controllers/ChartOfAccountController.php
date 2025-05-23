<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class ChartOfAccountController extends Controller
{
    // Menampilkan semua akun
    public function index()
    {
        $title = "Chart Of Account";
        
        $accounts = ChartOfAccount::all();
        return view('coa.index', compact('accounts','title'));
    }

    // Menampilkan form input akun baru
    public function create()
    {
        return view('coa.create');
    }

    // Menyimpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_akun' => 'required|unique:chart_of_accounts,kode_akun',
            'nama_akun' => 'required',
            'tipe_akun' => 'required|in:Aset,Kewajiban,Ekuitas,Pendapatan,Beban',
        ]);

        ChartOfAccount::create($request->all());

        return redirect()->route('coa.index')->with('success', 'Akun berhasil ditambahkan.');
    }
}