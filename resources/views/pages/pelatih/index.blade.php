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
                            <h4 class="card-title">Management Pelatih</h4>
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
                                    No Telp
                                </th>
                                <th>
                                    Jenis Kelamin
                                </th>
                                <th>
                                    Spesialis Olahraga
                                </th>
                                <th class="text-right">
                                    action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($data as $items)
                                    <tr>
                                        <td>
                                            {{ $items->nama_pelatih }}
                                        </td>
                                        <td>
                                            {{ $items->no_telp }}
                                        </td>
                                        <td>
                                            {{ $items->jenis_kelamin }}
                                        </td>
                                        <td>
                                            {{ $items->spesialis_olahraga }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" type="button" class="text-secondary font-weight-bold text-md"
                                                data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $items->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('pelatih.destroy', ['id' => $items->id]) }}"
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Pelatih</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('pelatih.update', ['id' => $items->id]) }}"
                                                    method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInput">Nama</label>
                                                            <input type="text" class="form-control" id="exampleInput" value="{{ $items->nama_pelatih }}"
                                                                name="nama" aria-describedby="emailHelp"
                                                                placeholder="Enter nama">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput">No Telp</label>
                                                            <input type="tel" class="form-control" id="exampleInput" value="{{ $items->no_telp }}"
                                                                name="no_telp" aria-describedby="emailHelp"
                                                                placeholder="Enter Telp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                            <select class="form-control" id="exampleFormControlSelect1"
                                                                name="jk">
                                                                <option selected disabled>pilih</option>
                                                                <option value="Laki-Laki" {{ $items->jenis_kelamin == "Laki-Laki" ? 'selected' : '' }}>Laki-Laki</option>
                                                                <option value="Perempuan" {{ $items->jenis_kelamin == "Perempuan" ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput">Spesialis Olahraga</label>
                                                            <input type="text" class="form-control" id="exampleInput" value="{{ $items->spesialis_olahraga }}"
                                                                name="spesialis_olahraga" aria-describedby="emailHelp"
                                                                placeholder="Enter Spesialis Olahraga">
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelatih</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('pelatih.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInput">Nama</label>
                                    <input type="text" class="form-control" id="exampleInput" name="nama"
                                        aria-describedby="emailHelp" placeholder="Enter nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">No Telp</label>
                                    <input type="tel" class="form-control" id="exampleInput" name="no_telp"
                                        aria-describedby="emailHelp" placeholder="Enter Telp">
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
                                    <label for="exampleInput">Spesialis Olahraga</label>
                                    <input type="text" class="form-control" id="exampleInput" name="spesialis_olahraga"
                                        aria-describedby="emailHelp" placeholder="Enter Spesialis Olahraga">
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
