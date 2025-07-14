@extends('layout.app')

@section('content')


<div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                	<div class="row align-items-center">
                		Data Kelas
                    </div>
                </div>
                <div class="card-body">
                	<form action="{{ url('admin/kelas/update') }}/<?php echo $kelas->id ?>" method="POST">
                		@csrf
                		<div class="form-group">
                			<label>Nama Kelas</label>
                			<input type="text" name="nama_kelas" class="form-control" value="{{ $kelas->nama_kelas }}">
                		</div>

                		<div class="form-group">
                			<button type="submit" class="btn btn-primary">Simpan</button>
                			<a href="{{ url('admin/kelas') }}" class="btn btn-dark">Kembali</a>
                		</div>
                	</form>
                </div>
            </div>
        </div>
</div>


@endsection