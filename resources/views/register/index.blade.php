@extends('layouts.main')

@section('container')
    <div class="bg-light">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-lg-5">
                    <h3 class="text-center mb-3">Aplikasi Penggajian Pegawai</h3>
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4 class="text-center">Register</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('register') }}" method="POST" autocomplete="on">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Lengkap" required value="{{ @old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ @old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ @old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
                                </div>
                                <button class="btn btn-dark col-12 mb-2">Register</button>
                            </form>
                            <a href="{{ route('login') }}" class="btn btn-secondary col-12">Kembali ke Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection