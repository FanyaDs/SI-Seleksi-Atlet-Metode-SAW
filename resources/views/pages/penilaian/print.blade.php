<!DOCTYPE html>
<html>

<head>
    <title>SI Seleksi Atlit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h2 class="text-center">Laporan Data Penilaian</h2>
    <p>Waktu : {{ $date }}</p>
    <p>Tabel Penilaian</p>
    <table class="table table-bordered">
        <tr class="text-center">
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
        </tr>
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
            </tr>
        @endforeach
    </table>
    <p>Tabel Normalisasi</p>
    <table class="table table-bordered">
        <tr class="text-center">
            <th>
                Nama Mahasiswa
            </th>
            @foreach ($kriteria as $kr)
                <th>
                    {{ $kr->nama_kriteria }} [{{ $kr->bobot_kriteria }}%]
                </th>
            @endforeach
        </tr>
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
    </table>
    <p>Tabel Perhitungan</p>
    <table class="table table-bordered">
        <tr class="text-center">
            <th>
                Nama Mahasiswa
            </th>
            <th>
                Perhitungan
            </th>
            <th>
                Hasil
            </th>
             <th>Ranking</th>
        </tr>
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
                @foreach ($ranking as $rankings)
                @if($rankings['mahasiswa_id'] == $items->id)
                    <td class="px-6 py-4"> {{ $rankings['ranking'] }}</td>
                @endif
            @endforeach
            </tr>
        @endforeach
    </table>
    <div class="float-right">
        <p class="text-center">Malang, {{ $date }}</p>
        {{-- <p class="text-center">{{ auth()->user()->roles->role }}</p> --}}
        <br><br><br>
        {{-- <p class="text-center">{{ auth()->user()->name }}</p> --}}
    </div>
</body>
</html>
