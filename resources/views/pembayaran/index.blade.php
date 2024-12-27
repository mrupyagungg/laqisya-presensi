@extends('layouts.dashboard')

@section('container-dashboard')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pembayaran Gaji</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createModal">
                <span data-feather="plus-square"></span> Tambah Data
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
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
       
    </div>
</div>

<!-- Modal Tambah Data-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>            
        </div>
    </div>
</div>

<!-- Modal Edit Data-->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Edit Data Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/groups" method="POST" id="form-update-group">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="form-label">Nama</label>
                        <input name="id" type="text" class="form-control" id="id_update" value="{{ old('id') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="basic_salary" class="form-label">Gaji Pokok</label>
                        <input name="basic_salary" type="text" class="form-control" id="basic_salary_update"
                            value="{{ old('basic_salary') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
