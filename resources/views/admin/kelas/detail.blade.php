@extends('layout.app')

@section('content')

    

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            Data Kelas
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k => $value)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{ $value->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                  </table>
                </div>
            </div>
        </div>
    </div>


@endsection
