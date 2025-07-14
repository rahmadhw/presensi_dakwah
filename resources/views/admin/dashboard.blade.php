@extends('layout.app')

@section('content')
    <h4> Grafik Absensi Siswa </h4>
    <div class="row mt-3">
    	<div class="col-md-4">
    		<canvas id="absensiChart" width="50" height="50"></canvas>
    	</div>
         
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('absensiChart').getContext('2d');
    const absensiChart = new Chart(ctx, {
        type: 'pie', // atau 'pie'
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Absensi',
                data: {!! json_encode($data) !!},
                backgroundColor: [
                    '#4CAF50', // hadir
                    '#FFC107', // izin
                    '#03A9F4', // sakit
                    '#F44336', // alpha
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>

@endpush
