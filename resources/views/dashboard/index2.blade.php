@extends('layouts.dashboard')

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

    <div class="row">
        <div class="container">
            {{-- Menampilkan greeting sesuai role pengguna --}}
            <h2>Selamat Datang <span style="color: brown">{{ Auth::user()->name }}</span></h2>
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <a href="/dashboard/presensi" class="text-decoration-none">Silahkan Absen Untuk Hari ini</a>
            </div>
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
