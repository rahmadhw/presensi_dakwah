@extends('layout.app')

@section('content')
    <div class="container">
    <h4>Form Kehadiran Siswa</h4>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

        @php
        $tanggal = request('tanggal') ?? now()->toDateString();
    @endphp

    <form action="{{route('guru.presensi.store')}}" method="POST">
        @csrf
        <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">
        <input type="hidden" name="mapel_id" value="{{ request('mapel_id') }}">
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}" required>
        </div>

        <table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Hadir</th>
                    <th>Izin</th> 
                    <th>Sakit</th>
                    <th>Alpha</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $s)
                @php
                    $absen = $absensiTersimpan[$s->id] ?? null;
                @endphp
                    <tr>
                        <td>{{ $s->nama }}</td>
                        <td><input type="radio" name="absensi[{{ $s->id }}]" value="hadir" {{ $absen && $absen->status === 'hadir' ? 'checked' : '' }} required></td>
                        <td><input type="radio" class="izin-radio" name="absensi[{{ $s->id }}]" value="izin" {{ $absen && $absen->status === 'izin' ? 'checked' : '' }}></td>
                        
                        <td><input type="radio" name="absensi[{{ $s->id }}]" value="sakit" {{ $absen && $absen->status === 'sakit' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="absensi[{{ $s->id }}]" value="alpha" {{ $absen && $absen->status === 'alpha' ? 'checked' : '' }}></td>
                         <!-- <td>
                            <input type="text" name="catatan[{{ $s->id }}]" class="form-control catatan-izin" id="catatan-{{ $s->id }}" placeholder="Catatan izin (wajib jika izin)" disabled>
                        </td> -->

                        <td>
                            <input type="text" name="catatan[{{ $s->id }}]" class="form-control catatan-izin"
                                id="catatan-{{ $s->id }}" placeholder="Catatan izin (wajib jika izin)"
                                value="{{ $absen && $absen->status === 'izin' ? $absen->catatan : '' }}"
                                {{ $absen && $absen->status === 'izin' ? '' : 'disabled' }}>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
    </form>
        

</div>
@endsection


@push('js')

<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>

<script>
    // alert('ok')
    
     document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[type=radio]').forEach(radio => {
            radio.addEventListener('change', function () {
                const name = this.name;
                const idMatch = name.match(/\d+/);
                if (!idMatch) return;

                const id = idMatch[0];
                const catatanInput = document.getElementById('catatan-' + id);
                if (!catatanInput) return;

                if (this.value === 'izin') {
                    catatanInput.disabled = false;
                    catatanInput.focus();
                } else {
                    catatanInput.disabled = true;
                    catatanInput.value = '';
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