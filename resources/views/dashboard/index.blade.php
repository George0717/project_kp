@extends('layouts.main')

@section('container')
<div class="row">
    <!-- Total Surat Jalan and Mutasi Cards -->
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
        <div class="card shadow-sm"
            style="background-color: rgb(255, 193, 7); color: white; animation: fadeInUp 1s ease; border: 1px solid gray">
            <div class="card-header text-black">
                Total Mutasi
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $totalMutasi }}</h5>
                <p class="card-text">Total entries</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Combined Graph for Surat Jalan and Mutasi -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow-sm" style="animation: fadeInUp 1s ease;">
            <div class="card-header">
                Grafik Peningkatan Surat Jalan dan Mutasi
            </div>
            <div class="card-body">
                <canvas id="combinedChart" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('combinedChart').getContext('2d');
        var combinedChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labelsSuratJalan) !!}, // Assuming both charts have the same labels
                datasets: [
                    {
                        label: 'Jumlah Surat Jalan',
                        data: {!! json_encode($dataSuratJalan) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Jumlah Mutasi',
                        data: {!! json_encode($dataMutasi) !!},
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuad'
                }
            }
        });
    });
</script>
@endpush
