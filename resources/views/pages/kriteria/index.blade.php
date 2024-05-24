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
                            <h4 class="card-title">Management Kriteria</h4>
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
                                    Bobot Kriteria
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th class="text-right">
                                    action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($data as $items)
                                    <tr>
                                        <td>
                                            {{ $items->nama_kriteria }}
                                        </td>
                                        <td>
                                            {{ $items->bobot_kriteria }}
                                        </td>
                                        <td>
                                            {{ $items->kategori }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" type="button" class="text-secondary font-weight-bold text-md"
                                                data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $items->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('kriteria.destroy', ['id' => $items->id]) }}"
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Kriteria</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('kriteria.update', ['id' => $items->id]) }}"
                                                    method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInput">Nama Kriteria</label>
                                                            <input type="text" class="form-control" id="exampleInput"
                                                                value="{{ $items->nama_kriteria }}" name="nama_kriteria"
                                                                aria-describedby="emailHelp" placeholder="Enter nama">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput">Bobot</label>
                                                            <input type="number" class="form-control" id="exampleInput"
                                                                value="{{ $items->bobot_kriteria }}" name="bobot_kriteria"
                                                                aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Kategori</label>
                                                            <select class="form-control" id="exampleFormControlSelect1"
                                                                name="kategori">
                                                                <option selected disabled>pilih</option>
                                                                <option
                                                                    value="Benefit"{{ $items->kategori == 'Benefit' ? 'selected' : '' }}>
                                                                    Benefit</option>
                                                                <option
                                                                    value="Cost"{{ $items->kategori == 'Cost' ? 'selected' : '' }}>
                                                                    Cost</option>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kriteria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('kriteria.store') }}" method="POST">
                            @csrf
                            <div class="modal-body add_kriteria">
                                <div class="form-group">
                                    <label for="exampleInput">Nama Kriteria</label>
                                    <input type="text" class="form-control" id="exampleInput" name="nama_kriteria"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Bobot</label>
                                    <input type="number" class="form-control" id="exampleInput" name="bobot_kriteria"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kategori</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                        <option selected disabled>pilih</option>
                                        <option value="Benefit">Benefit</option>
                                        <option value="Cost">Cost</option>
                                    </select>
                                </div>
                            </div>
                            {{-- button untuk menambahkan sub kriteria --}}
                            <button type="button"
                                class="add-more btn btn-primary mx-4">
                                Add Sub Kriteria
                            </button>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copy invisible">
                <div class="form-group mx-3">
                    <label for="exampleInput">Sub Kriteria</label>
                    <input type="text" class="form-control" name="sub_kriteria[]" aria-describedby="emailHelp"
                        id="sub_kriteria">
                </div>
                <div class="form-group mx-3">
                    <label for="exampleInput">Bobot Sub Kriteria</label>
                    <input type="number" class="form-control" name="bobot_sub_kriteria[]" aria-describedby="emailHelp"
                        id="bobot_sub_kriteria">
                </div>
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
            $(document).ready(function() {
                $(".add-more").click(function() {
                    var html = $(".copy").html();
                    $(".add_kriteria").after(html);
                });
            });
        </script>
    </div>
@endsection
