@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    Data Tahun Ajaran Aktif
                </div>
                <div class="card-body">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $k => $value)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $value->tahun_ajaran }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>
                                        @if ($value->status === 'nonaktif')
                                            <a href="{{ url('admin/tahun-ajaran-aktif/aktif') }}/<?php echo $value->id ?>" class="btn btn-success btn-sm aktif">Aktifkan</a>
                                        @else 
                                            <a href="{{ url('admin/tahun-ajaran-aktif/nonaktif') }}/<?php echo $value->id ?>" class="btn btn-danger btn-sm nonaktif">Non Aktif</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>

                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>


<script>
    $(document).ready(function () {


    

    $(".aktif").click(function (e) {
        e.preventDefault();

        const button = $(this);
        const url = this.href;

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
                    error: function (err) {
                        Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus data.", "error");
                        console.log(err);
                    }
                });
    });



    $(".nonaktif").click(function (e) {
        e.preventDefault();

        const button = $(this);
        const url = this.href;

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
                    error: function (err) {
                        Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus data.", "error");
                        console.log(err);
                    }
                });
    });

});
</script>






@endpush