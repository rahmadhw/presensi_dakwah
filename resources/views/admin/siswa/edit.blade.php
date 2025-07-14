@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    Edit Siswa
                </div>
                <div class="card-body">
                  <form action="{{ url('admin/siswa/update') }}/<?php echo $data->id ?>" method="POST">
                      @csrf

                      <div class="form-group">
                          <label>nama</label>
                          <input type="text" name="nama" class="form-control" id="nama" value="{{ $data->nama }}" required>
                      </div>
                      <div class="form-group">
                          <label>NIS</label>
                          <input type="number" name="nis" class="form-control" id="nis" value="{{ $data->nis }}" required>
                      </div>
                      <div class="form-group">
                          <label>Nama Kelas</label>
                          <select class="form-control" name="kelas_id">
                              <option>=== Pilih Kelas ===</option>
                              @foreach($kelas as $item)
                                <option value="{{ $item->id }}" {{ $item->id === $data->kelas_id ? 'selected' : '' }}>{{ $item->nama_kelas }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('admin/siswa') }}" class="btn btn-dark">Kembali</a>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection