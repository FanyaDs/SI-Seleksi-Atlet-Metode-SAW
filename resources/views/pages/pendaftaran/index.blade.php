@extends('layout')
@section('content')
    {{-- include vendor sweetAlert --}}
    {{-- @include('sweetalert::alert') --}}
    <div class="container-fluid py-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-sm">
                            <h4 class="card-title">Management Pendaftaran</h4>
                        </div>
                        <div class="col-sm  d-flex align-items-center justify-content-end mx-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Nama
                                </th>
                                <th>
                                    Jurusan
                                </th>
                                <th>
                                    No Telp
                                </th>
                                <th>
                                    Tanggal Pendaftaran
                                </th>
                                <th>
                                    Status
                                </th>
                                <th class="text-right">
                                    action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($pendaftaran as $items)
                                    <tr>
                                        <td>
                                            {{ $items->mahasiswas->nama }}
                                        </td>
                                        <td>
                                            {{ $items->mahasiswas->jurusan }}
                                        </td>
                                        <td>
                                            {{ $items->mahasiswas->no_telp }}
                                        </td>
                                        <td>
                                            {{ $items->tgl_pendaftaran }}
                                        </td>
                                        <td>
                                            {{ $items->status }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" type="button" class="text-secondary font-weight-bold text-md"
                                                data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $items->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('pendaftaran.destroy', ['id' => $items->id]) }}"
                                                class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                                data-original-title="Delete user" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal Update-->
                                    <div class="modal fade" id="exampleModal{{ $items->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Pendaftaran</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('pendaftaran.update', ['id' => $items->id]) }}"
                                                    method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInput">Nama</label>
                                                            <input type="text" class="form-control" id="exampleInput" value="{{ $items->mahasiswas->nama }}"
                                                                name="nama" aria-describedby="emailHelp" disabled
                                                                placeholder="Enter nama">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput">Tanggal Pendaftaran</label>
                                                            <input type="date" class="form-control" id="exampleInput" value="{{ $items->tgl_pendaftaran }}"
                                                                name="tgl_pendaftaran" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Status</label>
                                                            <select class="form-control" id="exampleFormControlSelect1"
                                                                name="status">
                                                                <option selected disabled>pilih</option>
                                                                <option value="Proses"{{ $items->status == "Proses" ? 'selected' : '' }}>Proses
                                                                </option>
                                                                <option value="Diterima"{{ $items->status == "Diterima" ? 'selected' : '' }}>Diterima</option>
                                                                <option value="Tidak Diterima"{{ $items->status == "Tidak Diterima" ? 'selected' : '' }}>Tidak Diterima</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal Add-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pendaftar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('pendaftaran.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nama Mahasiswa</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="mahasiswa">
                                        <option selected disabled>pilih</option>
                                        @foreach ($mahasiswa as $items)
                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Tanggal Pendaftaran</label>
                                    <input type="date" class="form-control" id="exampleInput" name="tgl_pendaftaran"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                                        <option selected disabled>pilih</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Tidak Diterima">Tidak Diterima</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
