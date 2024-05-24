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
                            <h4 class="card-title">Management User</h4>
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
                                    Username
                                </th>
                                <th>
                                    Password
                                </th>
                                <th>
                                    Role
                                </th>
                                <th class="text-right">
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($data as $items)
                                    <tr>
                                        <td>
                                            {{ $items->username }}
                                        </td>
                                        <td>
                                            {{ $items->password }}
                                        </td>
                                        <td>
                                            {{ $items->role }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" type="button" class="text-secondary font-weight-bold text-md"
                                                data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $items->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('user.destroy', ['id' => $items->id]) }}"
                                                class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                                data-original-title="Delete user" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal Update-->
                                    <div class="modal fade" id="exampleModal{{ $items->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('user.update',['id' => $items->id]) }}" method="POST">
                                                    @method("PUT")
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInput">Username</label>
                                                            <input type="text" class="form-control" id="exampleInput" name="username" value="{{ $items->username }}"
                                                                aria-describedby="emailHelp" placeholder="Enter Username">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInput">Password</label>
                                                            <input type="password" class="form-control" id="exampleInput" name="password"
                                                                placeholder="Password">
                                                                <small id="emailHelp" class="form-text text-muted">Kosongkan Password jika password tidak diganti</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Role</label>
                                                            <select class="form-control" id="exampleFormControlSelect1" name="role">
                                                                <option selected disabled>pilih</option>
                                                                <option value="Admin" {{ $items->role == "Admin" ? 'selected' : '' }}>Admin</option>
                                                                <option value="Pelatih" {{ $items->role == "Pelatih" ? 'selected' : '' }}>Pelatih</option>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInput">Username</label>
                                    <input type="text" class="form-control" id="exampleInput" name="username"
                                        aria-describedby="emailHelp" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput">Password</label>
                                    <input type="password" class="form-control" id="exampleInput" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                        <option selected disabled>pilih</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Pelatih">Pelatih</option>
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
