@extends('layout.app')

@section('content')


<div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                	<div class="row align-items-center">
                		Data Tahun Ajaran
                    </div>
                </div>
                <div class="card-body">
                	<form action="{{ url('admin/tahun-ajaran/update') }}/<?php echo $tahunAjaran->id ?>" method="POST">
                		@csrf
                		<div class="form-group">
                			<label>Tahun Ajaran</label>
                			<input type="text" name="tahun_ajaran" class="form-control" value="{{ $tahunAjaran->tahun_ajaran }}">
                		</div>

                		<div class="form-group">
                			<button type="submit" class="btn btn-primary">Simpan</button>
                			<a href="{{ url('admin/tahun-ajaran') }}" class="btn btn-dark">Kembali</a>
                		</div>
                	</form>
                </div>
            </div>
        </div>
</div>


@endsection