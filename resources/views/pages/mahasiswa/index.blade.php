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
                        <h4 class="card-title">Management Atlet Mahasiswa</h4>
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
                                Email
                            </th>
                            <th>
                                Tanggal Lahir
                            </th>
                            <th class="text-right">
                                action
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($data as $items)
                            <tr>
                                <td>
                                    {{ $items->nama }}
                                </td>
                                <td>
                                    {{ $items->jurusan }}
                                </td>
                                <td>
                                    {{ $items->no_telp }}
                                </td>
                                <td>
                                    {{ $items->email }}
                                </td>
                                <td>
                                    {{ $items->ttl }}
                                </td>
                                <td class="text-right">
                                    <a href="#" type="button" class="text-secondary font-weight-bold text-md"
                                        data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $items->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('mahasiswa.destroy', ['id' => $items->id]) }}"
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Mahasiswa</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('mahasiswa.update', ['id' => $items->id]) }}"
                                            method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleInput">Nama</label>
                                                    <input type="text" class="form-control" id="exampleInput"
                                                        value="{{ $items->nama }}" name="nama"
                                                        aria-describedby="emailHelp" placeholder="Enter nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInput">Email</label>
                                                    <input type="email" class="form-control" id="exampleInput"
                                                        value="{{ $items->email }}" name="email"
                                                        aria-describedby="emailHelp" placeholder="Enter Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInput">No Telp</label>
                                                    <input type="tel" class="form-control" id="exampleInput"
                                                        value="{{ $items->no_telp }}" name="no_telp"
                                                        aria-describedby="emailHelp" placeholder="Enter Telp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInput">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="exampleInput"
                                                        value="{{ $items->ttl }}" name="ttl"
                                                        aria-describedby="emailHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Jurusan</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        name="jurusan">
                                                        <option selected disabled>pilih</option>
                                                        <option value="Teknik Informatika"
                                                            {{ $items->jurusan == "Teknik Informatika" ? 'selected' : '' }}>
                                                            Teknik Informatika
                                                        </option>
                                                        <option value="Teknik Kimia"
                                                            {{ $items->jurusan == "Teknik Kimia" ? 'selected' : '' }}>
                                                            Teknik Kimia</option>
                                                        <option value="Teknik Industri"
                                                            {{ $items->jurusan == "Teknik Industri" ? 'selected' : '' }}>
                                                            Teknik Industri</option>
                                                        <option value="Teknik Sipil"
                                                            {{ $items->jurusan == "Teknik Sipil" ? 'selected' : '' }}>
                                                            Teknik Sipil</option>
                                                        <option value="Bisnis Digital"
                                                            {{ $items->jurusan == "Bisnis Digital" ? 'selected' : '' }}>
                                                            Bisnis Digital</option>

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        name="jk">
                                                        <option selected disabled>pilih</option>
                                                        <option value="Laki-Laki"
                                                            {{ $items->jenis_kelamin == "Laki-Laki" ? 'selected' : '' }}>
                                                            Laki-Laki</option>
                                                        <option value="Perempuan"
                                                            {{ $items->jenis_kelamin == "Perempuan" ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInput">Alamat</label>
                                                    <input type="text" class="form-control" id="exampleInput"
                                                        value="{{ $items->alamat }}" name="alamat"
                                                        aria-describedby="emailHelp" placeholder="Enter alamat">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Agama</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        name="agama">
                                                        <option selected disabled>pilih</option>
                                                        <option value="Islam"
                                                            {{ $items->agama == "Islam" ? 'selected' : '' }}>Islam
                                                        </option>
                                                        <option value="Kristen"
                                                            {{ $items->agama == "Kristen" ? 'selected' : '' }}>Kristen
                                                        </option>
                                                        <option value="Katolik"
                                                            {{ $items->agama == "Katolik" ? 'selected' : '' }}>Katolik
                                                        </option>
                                                        <option value="Hindu"
                                                            {{ $items->agama == "Hindu" ? 'selected' : '' }}>Hindu
                                                        </option>
                                                        <option value="Budha"
                                                            {{ $items->agama == "Budha" ? 'selected' : '' }}>Budha
                                                        </option>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mahasiswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInput">Nama</label>
                                <input type="text" class="form-control" id="exampleInput" name="nama"
                                    aria-describedby="emailHelp" placeholder="Enter nama">
                            </div>
                            <div class="form-group">
                                <label for="exampleInput">Email</label>
                                <input type="email" class="form-control" id="exampleInput" name="email"
                                    aria-describedby="emailHelp" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInput">No Telp</label>
                                <input type="tel" class="form-control" id="exampleInput" name="no_telp"
                                    aria-describedby="emailHelp" placeholder="Enter Telp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInput">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="exampleInput" name="ttl"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jurusan</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="jurusan">
                                    <option selected disabled>pilih</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Teknik Kimia">Teknik Kimia</option>
                                    <option value="Teknik Industri">Teknik Industri</option>
                                    <option value="Teknik Sipil">Teknik Sipil</option>
                                    <option value="Bisnis Digital">Bisnis Digital</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="jk">
                                    <option selected disabled>pilih</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput">Alamat</label>
                                <input type="text" class="form-control" id="exampleInput" name="alamat"
                                    aria-describedby="emailHelp" placeholder="Enter alamat">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Agama</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="agama">
                                    <option selected disabled>pilih</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
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