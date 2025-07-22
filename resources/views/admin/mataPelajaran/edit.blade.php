@extends('layout.app')

@section('content')


<div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                	<div class="row align-items-center">
                		Data Mata Pelajaran
                    </div>
                </div>
                <div class="card-body">
                	<form action="{{ url('admin/mata-pelajaran/update') }}/<?php echo $mataPelajaran->id ?>" method="POST">
                		@csrf
                		<div class="form-group">
                			<label>Mata Pelajaran</label>
                			<input type="text" name="nama_mapel" class="form-control" value="{{ $mataPelajaran->nama_mapel }}">
                		</div>

						<div class="form-group">
                			<label>Kode Mata Pelajaran</label>
                			<input type="text" name="kode_mapel" class="form-control" value="{{ $mataPelajaran->kode_mapel }}">
                		</div>

                		<div class="form-group">
                			<button type="submit" class="btn btn-primary">Simpan</button>
                			<a href="{{ url('admin/mata-pelajaran') }}" class="btn btn-dark">Kembali</a>
                		</div>
                	</form>
                </div>
            </div>
        </div>
</div>


@endsection