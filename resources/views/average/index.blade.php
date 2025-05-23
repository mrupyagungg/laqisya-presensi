@extends('layouts.dashboard-adm')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">TER (Tarif Efektif RataRata)</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('average.create') }}" class="btn btn-sm btn-outline-secondary">
                    <span data-feather="plus-square"></span> Tambah Data
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover" id="table-coa">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PTKP Status</th>
                    <th>Bruto Min</th>
                    <th>Bruto Max</th>
                    <th>Tarik %</th>
                    <th>Golongan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($averages as $a)
                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->ptkp_status }}</td>
                        <td>{{ number_format($a->bruto_min, 2) }}</td>
                        <td>{{ number_format($a->bruto_max, 2) }}</td>
                        <td>{{ $a->tarik_pct }}%</td>
                        <td>{{ $a->golongan }}</td>
                        <td>
                            <a href="{{ url('/average/edit/' . $a->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ url('/average/delete/' . $a->id) }}" method="post" style="display:inline;"
                                onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
