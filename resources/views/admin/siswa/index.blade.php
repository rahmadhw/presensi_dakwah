@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                   <div class="row align-items-center">
                        <div class="col-md-11">
                            Data Siswa
                        </div>
                       
                        <div class="col-md">
                            
                            <form id="importForm" action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" style="display: inline-block" >
                                @csrf
                                <input type="file" name="file" id="fileInput" accept=".xlsx,.xls,.csv" required style="display: none">
                            </form>
                            <button class="btn btn-success btn-sm" onclick="document.getElementById('fileInput').click()">Import</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nis</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $k => $value)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->nis }}</td>
                                    <td>{{ $value->kelas->nama_kelas }}</td>
                                    <td>
                                        <a href="{{ url('admin/siswa/hapus') }}/<?php echo $value->id ?>" class="btn btn-danger btn-sm hapus" id="hapus">Hapus</a>
                                        <a href="{{ url('admin/siswa/edit') }}/<?php echo $value->id ?>" class="btn btn-success btn-sm">Edit</a>
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

    
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('fileInput');
        fileInput.addEventListener('change', function () {
            if (this.files.length > 0) {
             
                document.getElementById('importForm').submit();
            }
        });
    });

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
       
        {{-- <script>
            document.getElementById('fileInput').addEventListener('change', function () {
                if (this.files.length > 0) {
                    // document.getElementById('importForm').submit();
                    console.info("test");
                }
            });
        </script> --}}

   
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