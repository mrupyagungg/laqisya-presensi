@extends('layouts.dashboard-adm')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Gaji</h1>
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">ID Pegawai</th>
                            <th scope="col" class="text-center">Nama Pegawai</th>
                            <th scope="col" class="text-center">Gaji Pokok</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $group->id_number }}</td>
                                <td class="text-center">{{ $group->nama_pegawai }}</td>
                                <td class="text-end">
                                    Rp. {{ number_format($group->basic_salary, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#updateModal" onclick="handleEditButton({{ $group->id }})">
                                        <span data-feather="edit-2"></span>
                                    </a>
                                    <form action="/groups/{{ $group->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-outline-secondary"
                                            onclick="return confirm('Yakin data ingin dihapus?')">
                                            <span data-feather="trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                        <div class="mb-3">
                            <label for="id_number" class="form-label">ID Pegawai</label>
                            <select name="id_number" id="id_number" class="form-control" onchange="updateNamaPegawai()">
                                <option value="" disabled selected>Pilih ID Pegawai</option>
                                @foreach ($pegawai as $data)
                                    <option value="{{ $data->id_number }}" data-name="{{ $data->name }}">
                                        {{ $data->id_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                            <input name="nama_pegawai" type="text" class="form-control" id="nama_pegawai" readonly>
                        </div>
                        <!-- Tambahan PTKP Status -->
                        <div class="mb-3">
                            <label for="ptkp_status" class="form-label">Status PTKP</label>
                            <select name="ptkp_status" id="ptkp_status" class="form-control" required>
                                <option value="" disabled selected>Pilih Status PTKP</option>
                                <option value="TK0">TK0 (Tidak Kawin, tanpa tanggungan)</option>
                                <option value="K0">K0 (Kawin, tanpa tanggungan)</option>
                                <option value="K1">K1 (Kawin, 1 tanggungan)</option>
                                <option value="K2">K2 (Kawin, 2 tanggungan)</option>
                                <option value="K3">K3 (Kawin, 3 tanggungan)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="basic_salary" class="form-label">Gaji Pokok</label>
                            <input name="basic_salary" type="text" class="form-control" id="basic_salary" required>
                        </div>
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
                            <input name="id" type="text" class="form-control" id="id_update"
                                value="{{ old('id') }}" required>
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

    <script>
        // Fungsi untuk format angka ribuan
        function numberFormatThousands(input) {
            let value = input.value.replace(/[^0-9]/g, ''); // Hapus karakter non-angka
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Format ribuan
            input.value = value;
        }

        // Ambil data untuk modal update
        const formUpdateGroup = document.getElementById('form-update-group');

        function handleEditButton(id) {
            fetch('/groups/' + id + '/edit')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('id_update').value = data.group.id;
                    document.getElementById('basic_salary_update').value = data.group.basic_salary;
                });

            formUpdateGroup.action = "/groups/" + id;
        }

        function updateNamaPegawai() {
            const select = document.getElementById('id_number');
            const selectedOption = select.options[select.selectedIndex];
            const namaPegawai = selectedOption.getAttribute('data-name') || '';
            document.getElementById('nama_pegawai').value = namaPegawai;
        }
    </script>
@endsection
