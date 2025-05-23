@extends('layouts.dashboard-adm')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">COA (Chart of Accounts)</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('coa.create') }}" class="btn btn-sm btn-outline-secondary">
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
                    <th scope="col" class="text-start" style="width: 5%;">No</th>
                    <th scope="col" class="text-start" style="width: 20%;">Kode Akun</th>
                    <th scope="col" class="text-start" style="width: 45%;">Nama Akun</th>
                    <th scope="col" class="text-start" style="width: 20%;">Tipe Akun</th>
                    <th scope="col" class="text-start" style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <th scope="row" class="text-start">{{ $loop->iteration }}</th>
                        <td class="text-start">{{ $account->kode_akun }}</td>
                        <td>{{ $account->nama_akun }}</td>
                        <td class="text-start">
                            <span class="text-dark">{{ $account->tipe_akun }}</span>
                        </td>
                        <td class="text-start">
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('coa.edit', $account->id) }}"
                                    class="btn btn-sm btn-outline-secondary me-2" title="Edit">
                                    <span data-feather="edit"></span>
                                </a>
                                <form action="{{ route('coa.destroy', $account->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Yakin ingin menghapus akun ini?')" title="Delete">
                                        <span data-feather="trash-2"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if ($accounts->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data COA.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
