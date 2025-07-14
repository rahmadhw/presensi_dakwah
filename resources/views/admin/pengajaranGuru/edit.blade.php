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
                	<form action="{{ url('admin/jadwal-pengajaran/update') }}/<?= $data->id; ?>" method="POST">
                		@csrf
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="form-control">
                                <option value="">=== Pilih Option ===</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}" {{ $item->id === $data->kelas->id ? 'selected' : '' }}>{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mapel_id">Nama Mapel</label>
                            <select name="mapel_id" id="mapel_id" class="form-control">
                                <option value="">=== Pilih Mata Pelajaran</option>
                                @foreach ($mataPelajaran as $item)
                                    <option value="{{ $item->id }}" {{ $item->id === $data->mapel->id ? 'selected' : '' }}>{{ $item->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="guru_id">Nama Guru</label>
                            <select name="guru_id" id="guru_id" class="form-control">
                                <option value="">=== Pilih Guru</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}" {{ $item->id === $data->guru->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tahun_ajaran_id">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control">
                                <option value="">=== Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $item)
                                    <option value="{{ $item->id }}" {{ $item->id === $data->tahunAjaran->id ? 'selected' : '' }}>{{ $item->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <input type="text" name="hari" class="form-control" id="hari" value="{{ $data->hari }}">
                        </div>

                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ $data->jam_mulai }}">
                        </div>

                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ $data->jam_selesai }}">
                        </div>
                        <div class="form-group">
                			<button type="submit" class="btn btn-primary">Simpan</button>
                			<a href="{{ url('admin/pengajaranGuru') }}" class="btn btn-dark">Kembali</a>
                		</div>
                        
                	</form>
                </div>
            </div>
        </div>
</div>


@endsection