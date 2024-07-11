@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm"
            style="background-color: rgb(21, 136, 67); color: white; animation: fadeInUp 1s ease; border: 1px solid gray">
            <div class="card-header text-black">
                Total Surat Jalan
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $totalSuratJalan }}</h5>
                <p class="card-text">Total entries</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm" style="animation: fadeInUp 1s ease;">
            <div class="card-header">
                Grafik Peningkatan Surat Jalan
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Jumlah Surat Jalan',
                    data: {!! json_encode($data) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        ticks: {
                            stepSize: 1 // Langkah antar label sumbu y
                        }
                    }
                },
                animation: {
                    duration: 1000, // Durasi animasi dalam milidetik
                    easing: 'easeInOutQuad' // Easing function untuk animasi
                }
            }
        });
    });
</script>
@endpush