@extends('layouts.dashboard-adm')

@section('container-dashboard')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Data Pegawai</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="/employees" class="btn btn-sm btn-outline-secondary">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
    </div>
</div>

@error('id_number')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

<form action="{{ route('employees.store') }}" method="POST" class="mb-5">
    @csrf
    <div class="row justify-content-center">
        <!-- 1 -->
        <div class="col-lg-6">
            @if (session()->has('messageSuccess'))
            <div id="flash-data-success" data-flashdata="{{ session('messageSuccess') }}"></div>
            @endif

            <div class="mb-2">
                <label for="id_number" class="form-label">NIP</label>
                <input name="id_number" type="text" class="form-control" id="id_number"
                    value="{{ old('id_number', $newIdNumber) }}" readonly required>
            </div>

            <div class="mb-2">
                <label for="name" class="form-label">Nama Pegawai</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-2">
                <label for="posisi" class="form-label">Posisi</label>
                <select name="posisi" id="posisi" class="form-select" onchange="showOtherInput()" required>
                    <option value="choose" selected>--Pilih--</option>
                    <option value="Barista" {{ old('posisi') == 'Barista' ? 'selected' : '' }}>Barista</option>
                    <option value="Chef" {{ old('posisi') == 'Chef' ? 'selected' : '' }}>Chef</option>
                    <option value="Kasir" {{ old('posisi') == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                    <option value="Waiter" {{ old('posisi') == 'Waiter' ? 'selected' : '' }}>Waiter</option>
                    <option value="Admin" {{ old('posisi') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Other" {{ old('posisi') == 'Other' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="mb-2" id="other_posisi" style="display: {{ old('posisi') == 'Other' ? 'block' : 'none' }};">
                <label for="other_posisi_input" class="form-label">Posisi Lainnya</label>
                <input type="text" name="other_posisi" id="other_posisi_input" class="form-control"
                    placeholder="Masukkan posisi lainnya" value="{{ old('other_posisi') }}">
            </div>

            <script>
            function showOtherInput() {
                var positionSelect = document.getElementById("posisi");
                var otherPositionDiv = document.getElementById("other_posisi");
                if (positionSelect.value === "Other") {
                    otherPositionDiv.style.display = "block";
                } else {
                    otherPositionDiv.style.display = "none";
                }
            }
            </script>

            <!-- 2 -->
            <div class="mb-2">
                <label for="alamat" class="form-label">Alamat Pegawai</label>
                <input name="alamat" type="text" class="form-control" id="alamat" value="{{ old('alamat') }}" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-2">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" id="jenis_kelamin" required>
                    <option value="choose" selected>--Pilih--</option>
                    <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                    </option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>
            <div class="mb-2">
                <label for="no_telp" class="form-label">No Telp</label>
                <input name="no_telp" type="text" class="form-control" id="no_telp" value="{{ old('no_telp') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-dark float-end mt-2">Simpan</button>
        </div>
    </div>
</form>
@endsection