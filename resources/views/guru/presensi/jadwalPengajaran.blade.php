@extends('layout.app')

@section('content')

<table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mapel</th>
                    <th>Hari</th> 
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tahun Ajaran</th>
                </tr>
            </thead>
            <tbody>
            	@foreach ($data as $k => $value)

            	<tr>
            		<td>{{ $k+1 }}</td>
            		<td>{{ $value->nama_mapel }}</td>
            		<td>{{ $value->hari }}</td>
            		<td>{{ $value->jam_mulai }}</td>
            		<td>{{ $value->jam_selesai }}</td>
            		<td>{{ $value->tahun_ajaran }}</td>
            	</tr>

            	@endforeach
            </tbody>
        </table>

@endsection