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
                                <th>Nama Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k => $value)

                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$value->nama_kelas}}</td>
                                <td>
                                    <a href="{{ url('admin/kelas/hapus') }}/<?php echo $value->id ?>" class="btn btn-danger btn-sm hapus">Hapus</a>
                                    <a href="{{ url('admin/kelas/edit') }}/<?php echo $value->id ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ url('admin/kelas/detail') }}/<?php echo $value->id ?>" class="btn btn-info btn-sm">Detail</a>
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
        <form action="{{route('admin.kelas.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Nama Sub Kelas</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Guru</label>
                <select name="guru_id" id="guru_id" class="form-control">
                    <option value="">=== Pilih Option ===</option>
                    @foreach ($guru as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Tahun Ajaran</label>
                <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control">
                    <option value="">=== Pilih Option ===</option>
                    @foreach ($tahunAjaran as $item)
                         <option value="{{ $item->id }}">{{ $item->tahun_ajaran }}</option>
                    @endforeach
                </select>
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