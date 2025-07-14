@extends('layout.app')

@section('content')


<div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                	<div class="row align-items-center">
                		Data Orang Tua
                    </div>
                </div>
                <div class="card-body">
                	<form action="{{ url('admin/orang-tua/update') }}/<?php echo $orangTua->id ?>" method="POST">
                		@csrf

                        <div class="form-group">
                            <label>Akun User</label>
                            <select class="form-control" name="user_id">
                                <option>=== Pilih ===</option>
                                @foreach($user as $k)
                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                @endforeach
                            </select>
                        </div>
                		
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $orangTua->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label>No Hp</label>
                            <input type="number" name="no_hp" class="form-control" value="{{ $orangTua->no_hp }}" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $orangTua->alamat }}" required>
                        </div>

                		<div class="form-group">
                			<button type="submit" class="btn btn-primary">Simpan</button>
                			<a href="{{ url('admin/orang-tua') }}" class="btn btn-dark">Kembali</a>
                		</div>
                	</form>
                </div>
            </div>
        </div>
</div>


@endsection