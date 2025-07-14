@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    

                    <div class="row align-items-center">
                        <div class="col-md-10">
                           Laporan Kehadiran Siswa
                        </div>
                        <div class="col-md">
                            {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                              Add
                            </button> --}}
                            <a href="{{ route('admin.adminReportPresensi.exportExcel') }}" class="btn btn-success btn-sm">Download</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <form action="{{ route('admin.adminReportPresensi.report') }}" method="GET" class="mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="from" value="{{ request('from') }}">
                        </div>

                        <div class="col-md-4">
                            <input type="date" class="form-control" name="to" value="{{ request('to') }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </div>
                  </form>

                   @if(isset($rekap))
                    <table class="table table-bordered mt-4" id="dataTable">
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
                            @foreach($rekap as $data)
                            <tr>
                                <td>{{ $data['nama'] }}</td>
                                <td>{{ $data['hadir'] }}</td>
                                <td>{{ $data['izin'] }}</td>
                                <td>{{ $data['sakit'] }}</td>
                                <td>{{ $data['alpha'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection