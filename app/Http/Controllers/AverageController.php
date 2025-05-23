<?php

namespace App\Http\Controllers;

use App\Models\Average;
use Illuminate\Http\Request;

class AverageController extends Controller
{
        public function index()
    {
        $averages = Average::all();
        $title = 'Average';

        return view('average.index', compact('averages', 'title'));
    }

    public function create()
    {
        $title = 'Average';
        $averages = Average::all();

        return view('average.create', compact('averages','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ptkp_status' => 'required|string|max:10',
            'bruto_min' => 'required|numeric',
            'bruto_max' => 'required|numeric|gte:bruto_min',
            'tarik_pct' => 'required|numeric|min:0',
            'golongan' => 'required|string|max:10',
        ]);

        Average::create($request->all());

        return redirect()->route('average.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Average $average)
    {
        return view('average.edit', compact('average'));
    }

    public function update(Request $request, Average $average)
    {
        $request->validate([
            'ptkp_status' => 'required|string|max:10',
            'bruto_min' => 'required|numeric',
            'bruto_max' => 'required|numeric|gte:bruto_min',
            'tarik_pct' => 'required|numeric|min:0',
            'golongan' => 'required|string|max:10',
        ]);

        $average->update($request->all());

        return redirect()->route('average.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Average $average)
    {
        $average->delete();
        return redirect()->route('average.index')->with('success', 'Data berhasil dihapus');
    }
}