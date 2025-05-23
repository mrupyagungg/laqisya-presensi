@extends('layouts.dashboard-adm')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if (Auth::user()->role == 1)
                Dashboard Admin
            @else
                Dashboard Pegawai
            @endif
        </h1>
    </div>

    {{-- alert succes --}}
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
        <div class="container">
            {{-- Menampilkan greeting sesuai role pengguna --}}
            @if (Auth::user()->role == 1)
                <h2>Selamat Datang {{ Auth::user()->name }}</h2>
            @else
                <h2>Selamat Datang {{ Auth::user()->name }}</h2>
            @endif
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session()->has('messageSuccess'))
        <div id="flash-data-success" data-flashdata="{{ session('messageSuccess') }}"></div>
    @endif

    <script>
        const flashDataSuccess = document.querySelector('#flash-data-success');
        if (flashDataSuccess) {
            alert(flashDataSuccess.dataset.flashdata); // Menampilkan pesan sukses
        }
    </script>
@endsection
