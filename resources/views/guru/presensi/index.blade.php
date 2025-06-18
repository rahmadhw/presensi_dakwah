@extends('layout.app')

@section('content')
    <div class="container">
    <h4>Form Kehadiran Siswa</h4>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($error)
        <div class="alert alert-warning">
            {{ $error }}
        </div>
    @else

    <form action="{{ route('guru.presensi.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="kelas_id" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="mapel_id" class="form-control" required>
                    <option value="">-- Pilih Mapel --</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}" {{ request('mapel_id') == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-info" type="submit">Tampilkan</button>
            </div>
        </div>
    </form>


        @php
        $tanggal = request('tanggal') ?? now()->toDateString();
    @endphp

    @if(count($siswa))
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
        
    @endif

    
    
    
    @endif
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