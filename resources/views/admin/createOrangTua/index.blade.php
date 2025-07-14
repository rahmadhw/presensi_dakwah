@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            Create Account Orang Tua
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $k => $value)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        <a href="{{ url('admin/create-orang-tua/hapus') }}/<?php echo $value->id ?>" class="btn btn-danger btn-sm hapus" id="hapus">Hapus</a>
                                        <a href="{{ url('admin/create-orang-tua/edit') }}/<?php echo $value->id ?>" class="btn btn-success btn-sm">Edit</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.createOrangTua.store')}}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
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
                            console.log(response);
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