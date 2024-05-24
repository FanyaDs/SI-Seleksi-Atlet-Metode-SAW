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
                            <h4 class="card-title">Tabel Penilaian</h4>
                        </div>
                        <div class="col-sm d-flex align-items-center justify-content-end mx-3">
                            <a href="{{ route('penilaian.print') }}"
                                class="text-white font-weight-bold text-md btn btn-success text-center px-4">
                                <i class="fa-solid fa-print "></i>
                            </a>
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
                                    Nama Mahasiswa
                                </th>
                                @foreach ($kriteria as $kr)
                                    <th>
                                        {{ $kr->nama_kriteria }} [{{ $kr->bobot_kriteria }}%]
                                    </th>
                                @endforeach
                                <th>
                                    Total
                                </th>
                                <th class="text-right">
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $items)
                                    <tr>
                                        @php
                                            $total = 0;
                                        @endphp
                                        <td>
                                            {{ $items->nama }}
                                        </td>
                                        @foreach ($kriteria as $kriterias)
                                            @foreach ($penilaian as $penilaians)
                                                @if ($items->id == $penilaians->mahasiswa_id && $penilaians->kriteria_id == $kriterias->id)
                                                    <td class="px-6 py-4">
                                                        {{ $penilaians->nilai }}
                                                        @php
                                                            $total += $penilaians->nilai;
                                                        @endphp
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <td>
                                            {{ $total }}
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('penilaian.destroy', ['id' => $items->id]) }}"
                                                class="text-secondary font-weight-bold text-md" data-toggle="tooltip"
                                                data-original-title="Delete user" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- menampilkan hasil normalisasi --}}
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-sm">
                            <h4 class="card-title">Tabel Normalisasi</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Nama Mahasiswa
                                </th>
                                @foreach ($kriteria as $kr)
                                    <th>
                                        {{ $kr->nama_kriteria }} [{{ $kr->bobot_kriteria }}%]
                                    </th>
                                @endforeach
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $items)
                                    <tr>
                                        <td>
                                            {{ $items->nama }}
                                        </td>
                                        @foreach ($dataSAW as $datas)
                                            @if ($datas['mahasiswa_id'] == $items->id)
                                                <td class="px-6 py-4">
                                                    {{ $datas['hasil_normalisasi'] }}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- menampilkan perhitungan --}}
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-sm">
                            <h4 class="card-title">Tabel Perhitungan</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Nama Mahasiswa
                                </th>
                                <th>
                                    Perhitungan
                                </th>
                                <th>
                                    Hasil
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $items)
                                    @php
                                        $total_akhir = 0;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $items->nama }}
                                        </td>
                                        <td>
                                            @foreach ($dataSAW as $datas)
                                                @if ($datas['mahasiswa_id'] == $items->id)
                                                    ({{ $datas['bobot_kriteria'] }} x {{ $datas['hasil_normalisasi'] }})
                                                    @php
                                                        $total_akhir += $datas['hasil_saw'];
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $total_akhir }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{--  Setelah Dilakukan Perhitungan Dengan Metode SAW maka didapatkan Peserta dengan nilai terbesar yaitu --}}
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-sm">
                            <h4 class="card-title">Tabel Hasil Perangkingan</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Nama Mahasiswa
                                </th>
                                <th>
                                    Hasil
                                </th>
                                <th>
                                    Ranking
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($ranking as $items)
                                    @php
                                        $total_akhir = 0;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $items['nama'] }}
                                        </td>
                                        <td>
                                            @foreach ($dataSAW as $datas)
                                                @if ($datas['mahasiswa_id'] == $items['mahasiswa_id'])
                                                    @php
                                                        $total_akhir += $datas['hasil_saw'];
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{ $total_akhir }}
                                        </td>
                                        <td>
                                            {{ $items['ranking'] }}
                                        </td>
                                    </tr>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penilaian</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('penilaian.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nama Mahasiswa</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="mahasiswa">
                                        <option selected disabled>pilih</option>
                                        @foreach ($getAllMahasiswa as $items)
                                            <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @foreach ($kriteria as $kriterias)
                                    <div class="form-group">
                                        @if ($kriterias->subKriterias->count() > 0)
                                            @foreach ($subKriteria as $subKriterias)
                                                @if ($subKriterias->kriteria_id == $kriterias->id)
                                                    <div class="form-group">
                                                        <label for="exampleInput"
                                                            id="{{ $subKriterias->nama_sub }}">{{ $kriterias->nama_kriteria }}
                                                            [{{ $subKriterias->nama_sub }}]</label>
                                                        <input type="number" class="form-control"
                                                            id="sub_kriteria-{{ $subKriterias->id }}" required
                                                            name="sub_kriteria[{{ $subKriterias->id }}]"
                                                            aria-describedby="emailHelp" placeholder="Enter Nilai">
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="form-group">
                                                <label for="exampleInput"
                                                    id="{{ $kriterias->nama_kriteria }}">{{ $kriterias->nama_kriteria }}</label>
                                                <input type="number" class="form-control"
                                                    id="sub_kriteria-{{ $subKriterias->id }}" required
                                                    name="data[{{ str_replace(' ', '_', $kriterias->nama_kriteria) }}]"
                                                    aria-describedby="emailHelp" placeholder="Enter Nilai">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
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
