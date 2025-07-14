@extends('layout.app')

@section('content')
<div class="container">
    <h4>Rekap Kehadiran Mingguan</h4>

    <form method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <label>Kelas:</label>
            <select name="kelas_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label>Mapel:</label>
            <select name="mapel_id" class="form-control" required>
                <option value="">-- Pilih Mapel --</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->id }}" {{ request('mapel_id') == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 align-self-end">
            <button class="btn btn-primary">Tampilkan</button>
        </div>
    </div>
</form>

    @if(count($rekap))
    <div class="alert alert-info">
        Menampilkan data absensi dari <strong>{{ now()->format('d-m-Y') }}</strong>
        sampai <strong>{{ now()->addDays(6)->format('d-m-Y') }}</strong>
    </div>

    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekap as $r)
            <tr>
                <td>{{ $r['nama'] }}</td>
                <td>{{ $r['hadir'] }}</td>
                <td>{{ $r['izin'] }}</td>
                <td>{{ $r['sakit'] }}</td>
                <td>{{ $r['alpha'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
