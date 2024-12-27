@extends('layouts.dashboard')

@section('container-dashboard')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

{{-- Halaman untuk presensi pegawai --}}
<div class="row">
    
    
    
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
