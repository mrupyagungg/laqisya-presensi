@extends('layouts.dashboard-adm')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pegawai</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="/employees/create" class="btn btn-sm btn-outline-secondary">
                    <span data-feather="plus-square"></span> Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('messageSuccess'))
                <div id="flash-data-success" data-flashdata="{{ session('messageSuccess') }}"></div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover" id="table-employees">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">NIP</th>
                            <th scope="col" class="text-center">Nama Pegawai</th>
                            <th scope="col" class="text-center">Alamat</th>
                            <th scope="col" class="text-center">Posisi</th>
                            <th scope="col" class="text-center">Jenis Kelamin</th>
                            <th scope="col" class="text-center">No Telp</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->name }}</td>
                                <td class="text-center">{{ $employee->alamat }}</td>
                                <td class="text-center">{{ $employee->posisi }}</td>
                                <td class="text-center">{{ $employee->jenis_kelamin }}</td>
                                <td class="text-center">{{ $employee->no_telp }}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="#" class="btn btn-sm btn-outline-secondary me-2"
                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                            onclick="handleEditButton({{ $employee->id }})">
                                            <span data-feather="edit"></span>
                                        </a>
                                        <form action="/employees/{{ $employee->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-secondary"
                                                onclick="return confirm('Yakin data ingin dihapus?')">
                                                <span data-feather="trash"></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="editForm" method="POST">

                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editIdNumber" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="editIdNumber" name="id_number" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAlamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="editAlamat" name="alamat" required>
                        </div>

                        <div class="mb-3">
                            <label for="editPosisi" class="form-label">editPosisi</label>
                            <select name="editPosisi" id="editPosisi" class="form-select" onchange="showOtherInput()"
                                required>
                                <option value="choose" selected>--Pilih--</option>
                                <option value="Barista" {{ old('posisi') == 'Barista' ? 'selected' : '' }}>Barista</option>
                                <option value="Chef" {{ old('posisi') == 'Chef' ? 'selected' : '' }}>Chef</option>
                                <option value="Kasir" {{ old('posisi') == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                                <option value="Waiter" {{ old('posisi') == 'Waiter' ? 'selected' : '' }}>Waiter</option>
                                <option value="Admin" {{ old('posisi') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Other" {{ old('posisi') == 'Other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editJenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="editJenisKelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editNoTelp" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="editNoTelp" name="no_telp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const editForm = document.getElementById('editForm');
        const editIdNumber = document.getElementById('editIdNumber');
        const editName = document.getElementById('editName');
        const editAlamat = document.getElementById('editAlamat');
        const editPosisi = document.getElementById('editPosisi');
        const editJenisKelamin = document.getElementById('editJenisKelamin');
        const editNoTelp = document.getElementById('editNoTelp');

        function handleEditButton(id) {
            fetch(`/employees/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.employee) {
                        editForm.action = `/employees/${id}`;
                        editIdNumber.value = data.employee.id_number;
                        editName.value = data.employee.name;
                        editAlamat.value = data.employee.alamat;
                        editPosisi.value = data.employee.posisi;
                        editJenisKelamin.value = data.employee.jenis_kelamin;
                        editNoTelp.value = data.employee.no_telp;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
