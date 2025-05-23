@extends('layouts.dashboard-adm')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">TER (Tarif Efektif Rata-Rata)</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span data-feather="plus-square"></span> Tambah Data
                </a>
            </div>
        </div>
    </div>

    @if (session('messageSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('messageSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form Tambah Data TER</h4>
            <form action="{{ route('average.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="ptkp_status" class="form-label">PTKP Status</label>
                    <input type="text" class="form-control" id="ptkp_status" name="ptkp_status" required>
                </div>

                <div class="mb-3">
                    <label for="bruto_min" class="form-label">Bruto Min</label>
                    <input type="number" class="form-control" id="bruto_min" name="bruto_min" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="bruto_max" class="form-label">Bruto Max</label>
                    <input type="number" class="form-control" id="bruto_max" name="bruto_max" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="tarik_pct" class="form-label">Tarik %</label>
                    <input type="number" class="form-control" id="tarik_pct" name="tarik_pct" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="golongan" class="form-label">Golongan</label>
                    <input type="text" class="form-control" id="golongan" name="golongan" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
