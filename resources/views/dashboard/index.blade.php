@extends('layouts.main')

@section('container')
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <h4>Selamat datang, {{ Auth::user()->name }}</h4>
            </div>
        </div>
        <form id="filterForm" class="form-inline">
            <div class="form-group mr-3">
                <label for="year" class="mr-2">Tahun:</label>
                <select id="year" name="year" class="form-control">
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-3">
                <label for="month" class="mr-2">Bulan:</label>
                <select id="month" name="month" class="form-control">
                    <option value="all">Semua</option>
                    @foreach($months as $key => $month)
                        <option value="{{ $key }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
            <button type="button" id="resetButton" class="btn btn-secondary ml-2">Reset</button>
        </form>
    </div>
</div>

<div class="row">
    <!-- Total Surat Jalan and Mutasi Cards -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm"
            style="background-color: rgb(21, 136, 67); color: white; animation: fadeInUp 1s ease; border: 1px solid gray">
            <div class="card-header text-black">
                Total Surat Jalan
            </div>
            <div class="card-body">
                <h5 class="card-title" id="totalSuratJalan">{{ $totalSuratJalan }}</h5>
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
                <h5 class="card-title" id="totalMutasi">{{ $totalMutasi }}</h5>
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
                <canvas id="combinedChart" style="width: 100%; height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let combinedChart;

        function renderChart(labels, dataSuratJalan, dataMutasi) {
            const ctx = document.getElementById('combinedChart').getContext('2d');
            if (combinedChart) {
                combinedChart.destroy();
            }
            combinedChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Jumlah Surat Jalan',
                            data: dataSuratJalan,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Jumlah Mutasi',
                            data: dataMutasi,
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
        }

        renderChart({!! json_encode($labelsSuratJalan) !!}, {!! json_encode($dataSuratJalan) !!}, {!! json_encode($dataMutasi) !!});

        document.getElementById('filterButton').addEventListener('click', function () {
            const year = document.getElementById('year').value;
            const month = document.getElementById('month').value;

            fetch(`{{ route('dashboard.filter') }}?year=${year}&month=${month}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalSuratJalan').innerText = data.totalSuratJalan;
                    document.getElementById('totalMutasi').innerText = data.totalMutasi;
                    renderChart(data.labels, data.dataSuratJalan, data.dataMutasi);
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('resetButton').addEventListener('click', function () {
            document.getElementById('year').value = '{{ date("Y") }}';
            document.getElementById('month').value = 'all';

            fetch(`{{ route('dashboard.filter') }}?year={{ date("Y") }}&month=all`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalSuratJalan').innerText = data.totalSuratJalan;
                    document.getElementById('totalMutasi').innerText = data.totalMutasi;
                    renderChart(data.labels, data.dataSuratJalan, data.dataMutasi);
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
@endpush
