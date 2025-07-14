@extends('layout.app')

@section('content')


<div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                	<div class="row align-items-center">
                		Data Guru
                    </div>
                </div>
                <div class="card-body">
                	<form action="{{ url('admin/guru/update') }}/<?php echo $data->id ?>" method="POST">
                		@csrf

                        <div class="form-group">
                            <label>Pengguna</label>
                            <select name="user_id" class="form-control">
                                <option value="">=== Pilih User ===</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                		<div class="form-group">
                			<label>Nama Guru</label>
                			<input type="text" name="name" class="form-control" value="{{ $data->name }}">
                		</div>

                        <div class="form-group">
                			<label>Email</label>
                			<input type="email" name="email" class="form-control" value="{{ $data->email }}">
                		</div>

                		<div class="form-group">
                			<button type="submit" class="btn btn-primary">Simpan</button>
                			<a href="{{ url('admin/guru') }}" class="btn btn-dark">Kembali</a>
                		</div>
                	</form>
                </div>
            </div>
        </div>
</div>


@endsection