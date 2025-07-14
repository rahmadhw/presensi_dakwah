@extends('layout.app')

@section('content')
<div class="container">
    <h4>Riwayat Kehadiran Siswa</h4>

    <form action="{{ route('orangTua.riwayatPresensi.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <select name="kelas_id" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ $selectedKelas == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
    </form>
    @php
        $grouped = collect($data)->groupBy('siswa_id');
    @endphp

        @if($data && count($data))
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Status Kehadiran</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($grouped as $siswa_id => $absensiList)
                @foreach($absensiList as $index => $absen)
                    <tr>
                        @if ($index == 0)
                            <td rowspan="{{ $absensiList->count() }}">{{ $absen->siswa->nama }}</td>
                        @endif
                        <td>{{ ucfirst($absen->status) }} - {{ $absen->mapel->nama_mapel }}</td>
                    <td>{{ $absen->catatan ?? '-' }}</td>
                </tr>
            @endforeach
        @endforeach
            </tbody>
        </table>
    @elseif($selectedKelas)
        <div class="alert alert-warning">Tidak ada data absensi untuk tanggal ini.</div>
    @endif
</div>
@endsection
