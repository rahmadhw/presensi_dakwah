@extends('layout.app')

@section('content')
<div class="container">
    <h4>Riwayat Kehadiran Siswa</h4>

    
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Status Kehadiran</th>
                        <th>Nama Guru</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $index => $absen)
                {{-- @dd($absen) --}}
                    <tr>
                        <td>{{ $absen->siswa->nama }}</td>
                        <td>{{ ucfirst($absen->status) }} - {{ $absen->mapel->nama_mapel }}</td>
                    <td>{{ Auth::user()->name }}</td>
                    <td>{{ $absen->catatan ?? '-' }}</td>
                </tr>
            @endforeach
       
            </tbody>
        </table>
   
</div>
@endsection
