@extends('layout.app')

@section('content')


<div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                	<div class="row align-items-center">
                		Form Create Account Guru
                    </div>
                </div>
                <div class="card-body">
                	<form action="{{ url('admin/create-guru/update') }}/<?php echo $user->id ?>" method="POST">
                		@csrf
                		<div class="form-group">
                			<label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                		</div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                		<div class="form-group">
                			<button type="submit" class="btn btn-primary">Simpan</button>
                			<a href="{{ url('admin/create-guru') }}" class="btn btn-dark">Kembali</a>
                		</div>
                	</form>
                </div>
            </div>
        </div>
</div>


@endsection