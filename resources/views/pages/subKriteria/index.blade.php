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
                            <h4 class="card-title">Management Sub Kriteria</h4>
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
                                    Nama Kriteria
                                </th>
                                <th>
                                    Nama Sub Kriteria
                                </th>
                                <th>
                                    Bobot Sub
                                </th>
                                <th class="text-right">
                                    action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($subKriteria as $items)
                                    <tr>
                                        <td>
                                            {{ $items->kriterias->nama_kriteria }}
                                        </td>
                                        <td>
                                            {{ $items->nama_sub }}
                                        </td>
                                        <td>
                                            {{ $items->bobot_sub }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" type="button" class="text-secondary font-weight-bold text-md"
                                                data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $items->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('subKriteria.destroy', ['id' => $items->id]) }}"
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Sub Kriteria</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('subKriteria.update', ['id' => $items->id]) }}"
                                                    method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Kriteria</label>
                                                            <select class="form-control" id="exampleFormControlSelect1"
                                                                name="kriteria">
                                                                <option selected disabled>pilih</option>
                                                                @foreach ($kriteria as $kr)
                                                                <option
                                                                    value="{{ $kr->id }}"{{ $items->kriteria_id == $kr->id ? 'selected' : '' }}>
                                                                    {{ $kr->nama_kriteria }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput">Nama Sub Kriteria</label>
                                                            <input type="text" class="form-control" id="exampleInput"
                                                                value="{{ $items->nama_sub }}" name="nama_sub"
                                                                aria-describedby="emailHelp" placeholder="Enter nama">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput">Bobot</label>
                                                            <input type="number" class="form-control" id="exampleInput"
                                                                value="{{ $items->bobot_sub }}" name="bobot_sub"
                                                                aria-describedby="emailHelp">
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Sub Kriteria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('subKriteria.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kriteria</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kriteria">
                                        <option selected disabled>pilih</option>
                                        @foreach ($kriteria as $items)
                                        <option value="{{ $items->id }}">{{ $items->nama_kriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Nama Sub Kriteria</label>
                                    <input type="text" class="form-control" id="exampleInput" name="nama_sub"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Bobot</label>
                                    <input type="number" class="form-control" id="exampleInput" name="bobot_sub"
                                        aria-describedby="emailHelp">
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
