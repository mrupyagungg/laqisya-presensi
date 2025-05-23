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

    {{-- fitur filter bulan --}}
    <form action="{{ url()->current() }}" method="GET" class="mb-3 row g-2 align-items-center">
        <div class="col-auto">
            <label for="filter_bulan" class="col-form-label">Filter Bulan:</label>
        </div>
        <div class="col-auto">
            <input type="month" id="filter_bulan" name="filter_bulan" class="form-control"
                value="{{ request('filter_bulan') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Run</button>
        </div>
        <div class="col-auto">
            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>


    <!-- Tabel Daftar Pembayaran Gaji -->

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Hadir</th>
                <th>Potongan</th>
                <th>Bonus</th>
                <th>Total Dibayar</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaran as $key => $item)
                @php
                    $grandTotal = $item->grand_total;
                    $isNeedCalc = $grandTotal == 0;
                    $tampilkanTotal = $isNeedCalc ? $item->total : $grandTotal;
                @endphp
                <tr @if ($isNeedCalc) class="table-warning" @endif>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->group ? $item->group->id_number : '-' }}</td>
                    <td>{{ $item->nama_pegawai }}</td>
                    <td>{{ $item->jumlah_hadir }}</td>
                    <td>{{ 'Rp ' . number_format($item->potongan, 0, ',', '.') }}</td>
                    <td>{{ 'Rp ' . number_format($item->bonus, 0, ',', '.') }}</td>
                    <td>
                        {{ 'Rp ' . number_format($tampilkanTotal, 0, ',', '.') }}
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        @if ($item->status === 'paid')
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#bayarModal{{ $item->id }}">
                                <span>Sudah Dibayar</span>
                            </button>
                        @else
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#bayarModal{{ $item->id }}">
                                    Bayar
                                </button>
                                @if ($isNeedCalc)
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#bayarModal{{ $item->id }}">
                                        <span>Tanpa Pajak</span>
                                    </button>
                                @endif
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- bayar pajak --}}
    @foreach ($pembayaran as $item)
        <div class="modal fade" id="bayarModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="bayarModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('pembayaran.bayar', $item->id) }}" method="POST" class="modal-content">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="bayarModalLabel{{ $item->id }}">Konfirmasi Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bayar gaji untuk <strong>{{ $item->nama_pegawai }}</strong> dengan total
                            <strong class="total-nominal">Rp {{ number_format($item->total, 0, ',', '.') }}</strong>
                        </p>

                        <div class="mb-3">
                            <label for="ptkp{{ $item->id }}" class="form-label">Pilih PTKP</label>
                            <select name="ptkp" id="ptkp{{ $item->id }}" class="form-select ptkp-select" required
                                data-total="{{ $item->total }}" data-pajak-input="#pajakInput{{ $item->id }}"
                                data-total-setelah-pajak="#totalSetelahPajak{{ $item->id }}"
                                data-grand-total="#grandTotalInput{{ $item->id }}">
                                <option value="" data-pajak_pct="0">Pilih PTKP</option>
                                @foreach ($averages as $average)
                                    <option value="{{ $average->ptkp }}" data-bruto_min="{{ $average->bruto_min }}"
                                        data-bruto_max="{{ $average->bruto_max }}"
                                        data-pajak_pct="{{ $average->tarik_pct }}">
                                        {{ $average->ptkp_status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pajak (%)</label>
                            <input type="text" class="form-control" id="pajakInput{{ $item->id }}" name="pajak"
                                readonly required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Setelah Pajak (Rp)</label>
                            <input type="text" class="form-control" id="totalSetelahPajak{{ $item->id }}" readonly>
                            <input type="hidden" name="grand_total" id="grandTotalInput{{ $item->id }}">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.ptkp-select');

            selects.forEach(function(select) {
                select.addEventListener('change', function() {
                    const selectedOption = select.options[select.selectedIndex];
                    const pajakPct = parseFloat(selectedOption.getAttribute('data-pajak_pct')) || 0;
                    const total = parseFloat(select.getAttribute('data-total')) || 0;

                    const pajakInput = document.querySelector(select.getAttribute(
                        'data-pajak-input'));
                    const totalSetelahPajakInput = document.querySelector(select.getAttribute(
                        'data-total-setelah-pajak'));
                    const grandTotalInput = document.querySelector(select.getAttribute(
                        'data-grand-total'));

                    // Set input pajak dalam bentuk persen
                    pajakInput.value = pajakPct + ' %';

                    // Hitung pajak nominal
                    const nominalPajak = total * (pajakPct / 100);
                    const totalSetelahPajak = total - nominalPajak;

                    // Format angka ke rupiah
                    function formatRupiah(angka) {
                        return 'Rp ' + angka.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }

                    totalSetelahPajakInput.value = formatRupiah(totalSetelahPajak);
                    grandTotalInput.value = Math.round(totalSetelahPajak);
                });
            });
        });
    </script>

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
                                    <option value="{{ $employee->id }}"
                                        data-basic_salary="{{ $employee->basic_salary }}">
                                        {{ $employee->nama_pegawai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="basic_salary" class="form-label">Gaji Pokok</label>
                            <select name="basic_salary" class="form-select" id="basic_salary" readonly>
                                <option value="">Pilih Gaji Pokok</option>
                                @foreach ($gaji as $gaji)
                                    <option value="{{ $gaji->basic_salary }}"
                                        {{ old('basic_salary') == $gaji->basic_salary ? 'selected' : '' }}>
                                        {{ 'Rp ' . number_format($gaji->basic_salary, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_hadir" class="form-label">Jumlah Hadir</label>
                            <input name="jumlah_hadir" type="number" class="form-control" id="jumlah_hadir"
                                value="{{ old('jumlah_hadir') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bonus" class="form-label">Bonus</label>
                            <input name="bonus" type="number" class="form-control" id="bonus"
                                value="{{ old('bonus') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="potongan" class="form-label">Potongan</label>
                            <input name="potongan" type="number" class="form-control" id="potongan"
                                value="{{ old('potongan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input name="total" type="text" class="form-control" id="total"
                                value="{{ old('total') }}" readonly>
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
        document.addEventListener('DOMContentLoaded', function() {
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
                totalInput.value = total.toLocaleString('id-ID', {
                    style: 'decimal'
                });
            }

            // Menangani perubahan ID Pegawai untuk mengisi gaji otomatis
            const basicSalaryInput = document.getElementById('basic_salary');
            const basicSalaryDisplay = document.getElementById('basic_salary_display');

            idPegawaiSelect.addEventListener('change', function() {
                const selectedOption = idPegawaiSelect.options[idPegawaiSelect.selectedIndex];
                const basicSalary = selectedOption.getAttribute('data-basic_salary');
                basicSalaryInput.value = basicSalary;
                basicSalaryDisplay.value = parseFloat(basicSalary).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                calculateTotal();
            });

            // Menangani perubahan input untuk menghitung total
            jumlahHadirInput.addEventListener('input', calculateTotal);
            potonganInput.addEventListener('input', calculateTotal);
            bonusInput.addEventListener('input', calculateTotal);
        });
    </script>
@endsection
