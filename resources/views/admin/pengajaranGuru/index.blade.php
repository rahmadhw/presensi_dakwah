@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-11">
                        Data Guru yang mengajar
                    </div>
                    <div class="col-md">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                          Add
                      </button>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>Nama Mapel</th>
                        <th>Nama Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $item)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $item->nama_guru }}</td>
                        <td>{{ $item->nama_mapel }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>{{ $item->tahun_ajaran }}</td>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai }}</td>
                        <td>
                            <a href="{{ url('admin/jadwal-pengajaran/hapus') }}/<?php echo $item->id ?>" class="btn btn-danger btn-sm hapus" id="hapus">Hapus</a>
                            <a href="{{ url('admin/jadwal-pengajaran/edit') }}/<?php echo $item->id ?>" class="btn btn-success btn-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <form action="{{route('admin.pengajaranGuru.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="guru_id">Nama Guru</label>
            <select name="guru_id" id="guru_id" class="form-control">
                @foreach ($users as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Nama Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control">
                <option value="">=== Pilih Option ===</option>
                @foreach ($kelas as $item)
                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="mapel_id">Nama Mapel</label>
            <select name="mapel_id" id="mapel_id" class="form-control">
                <option value="">=== Pilih Mata Pelajaran</option>
                @foreach ($mataPelajaran as $item)
                <option value="{{ $item->id }}">{{ $item->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

            {{-- <div class="form-group">
                <label for="guru_id">Nama Guru</label>
                <select name="guru_id" id="guru_id" class="form-control">
                    <option value="">=== Pilih Guru</option>
                    @foreach ($guru as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div> --}}

            <div class="form-group">
                <label for="tahun_ajaran_id">Tahun Ajaran</label>
                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control">
                    <option value="">=== Pilih Tahun Ajaran</option>
                    @foreach ($tahunAjaran as $item)
                    <option value="{{ $item->id }}">{{ $item->tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="form-group">
                <label for="hari">Hari</label>
                <input type="text" name="hari" class="form-control" id="hari">
            </div> --}}
            <div class="form-group">
                <label for="hari">Hari</label>
                <select class="form-control" name="hari" id="hari">
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control">
            </div>

            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control">
            </div>
            
            <div class="form-group mt-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>
@endsection



@push('js')

<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>


<script>
    $(document).ready(function () {

        
        

        $(".hapus").click(function (e) {
            e.preventDefault();

            const button = $(this);
            const url = this.href;

            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#aaa",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success'
                            }).then(() => {
                            location.reload(); // atau hapus row dari DOM jika ingin tanpa reload
                        });
                        },
                        error: function () {
                            Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus data.", "error");
                        }
                    });
                }
            });
        });

    });
</script>


@if(session('success'))
<script>



    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
</script>
@endif



@endpush