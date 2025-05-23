@extends('layouts.dashboard')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <a href="/dashboard/index2" class="text-decoration-none">Dashboard ~ </a>Presensi
        </h1>
    </div>
    @if (session()->has('messageSuccess'))
        <div id="flash-data-success" data-flashdata="{{ session('messageSuccess') }}"></div>
    @endif
    @error('basic_salary')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    @error('id')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    <div class="row">
        <!-- Form Presensi -->
        <div class="col-lg-6">
            <h4>Presensi Pegawai</h4>
            <form action="{{ route('presensi.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="id_pegawai">Pilih Nama Anda:</label>
                    <select id="id_pegawai" name="id_pegawai" class="form-control" required>
                        <option value="">----</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status presensi:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpa">Alpa</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Presensi</button>
            </form>

        </div>

        <!-- Tabel Presensi -->
        <div class="col-lg-6">
            <h4>Data Presensi</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->employee ? $data->employee->name : 'Tidak Diketahui' }}</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
