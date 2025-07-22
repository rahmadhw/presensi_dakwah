@extends('layout.app')

@section('content')
<div class="container">
    <h4>Rekap Kehadiran Mingguan</h4>

    <form method="GET" class="mb-4">
        <div class="row">

            <div class="col-md-4">
                <label for="tanggal">Pilih Bulan:</label>
                <input type="month" name="bulan" id="bulan" class="form-control" required>
            </div>
            <div class="col-md-4 align-self-end">
                <button class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $data)
            <tr>
                <td>{{ $data['siswa_nama'] }}</td>
                <td>{{ $data['kelas'] }}</td>
                <td>{{ $data['mapel'] }}</td>
                <td>{{ $data['hadir'] }}</td>
                <td>{{ $data['izin'] }}</td>
                <td>{{ $data['sakit'] }}</td>
                <td>{{ $data['alpha'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
