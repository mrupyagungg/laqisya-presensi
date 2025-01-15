@extends('layouts.dashboard-adm')

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

    <!-- Tabel Daftar Pembayaran Gaji -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>id Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Jumlah Hadir</th>
                <th>Potongan</th>
                <th>Bonus</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaran as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->id_pegawai }}</td>
                    <td>{{ $item->nama_pegawai }}</td>
                    <td>{{ $item->jumlah_hadir }}</td>
                    <td>{{ 'Rp ' . number_format($item->potongan, 0, ',', '.') }}</td>
                    <td>{{ 'Rp ' . number_format($item->bonus, 0, ',', '.') }}</td>
                    <td>{{ 'Rp ' . number_format($item->total, 0, ',', '.') }}</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Gaji</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_pegawai" class="form-label">Nama Pegawai</label>
                            <select name="id_pegawai" class="form-select" id="id_pegawai" required>
                                <option value="">Pilih Pegawai</option>
                                @foreach ($gaji as $employee)
                                    <option value="{{ $employee->id }}" data-basic_salary="{{ $employee->basic_salary }}">
                                        {{ $employee->nama_pegawai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="basic_salary" class="form-label">Gaji Pokok</label>
                            <select name="basic_salary" class="form-select" id="basic_salary" disabled>
                                <option value="">Pilih Gaji Pokok</option>
                                @foreach ($gaji as $gaji)
                                    <option value="{{ $gaji->basic_salary }}" {{ old('basic_salary') == $gaji->basic_salary ? 'selected' : '' }}>
                                       {{ 'Rp ' . number_format($gaji->basic_salary, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_hadir" class="form-label">Jumlah Hadir</label>
                            <input name="jumlah_hadir" type="number" class="form-control" id="jumlah_hadir" value="{{ old('jumlah_hadir') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="potongan" class="form-label">Potongan</label>
                            <input name="potongan" type="number" class="form-control" id="potongan" value="{{ old('potongan') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bonus" class="form-label">Bonus</label>
                            <input name="bonus" type="number" class="form-control" id="bonus" value="{{ old('bonus') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input name="total" type="text" class="form-control" id="total" value="{{ old('total') }}" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const basicSalaryDropdown = document.getElementById('basic_salary');
            const jumlahHadirInput = document.getElementById('jumlah_hadir');
            const potonganInput = document.getElementById('potongan');
            const bonusInput = document.getElementById('bonus');
            const totalInput = document.getElementById('total');
            const idPegawaiSelect = document.getElementById('id_pegawai');

            // Fungsi untuk menghitung total
            function calculateTotal() {
                const gaji = parseFloat(basicSalaryDropdown.value) || 0;
                const jumlahHadir = parseFloat(jumlahHadirInput.value) || 0;
                const potongan = parseFloat(potonganInput.value) || 0;
                const bonus = parseFloat(bonusInput.value) || 0;

                let total = (gaji * jumlahHadir) - potongan + bonus;
                
                // Menambahkan titik sebagai pemisah ribuan
                totalInput.value = total.toLocaleString('id-ID', { style: 'decimal' });
            }

            // Menangani perubahan ID Pegawai untuk mengisi gaji otomatis
            idPegawaiSelect.addEventListener('change', function () {
                const selectedOption = idPegawaiSelect.options[idPegawaiSelect.selectedIndex];
                const basicSalary = selectedOption.getAttribute('data-basic_salary');
                basicSalaryDropdown.value = basicSalary;
                calculateTotal();
            });

            // Menangani perubahan input untuk menghitung total
            jumlahHadirInput.addEventListener('input', calculateTotal);
            potonganInput.addEventListener('input', calculateTotal);
            bonusInput.addEventListener('input', calculateTotal);
        });
    </script>
@endsection
