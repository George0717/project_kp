@extends('layouts.admin')

@section('container')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Log Details
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Log ID: {{ $log->id }}</h5>
                    <p><strong>User :</strong> {{ $log->user->name ?? 'Unknown' }}</p>
                    <p><strong>Aksi :</strong> {{ $log->action }}</p>
                    <p><strong>Model :</strong> {{ $log->model }}</p>
                    <p><strong>Model ID :</strong> {{ $log->model_id }}</p>
                    <p><strong>Dibuat pada :</strong> {{ $log->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>

            <div class="mb-4">
                <h6>Perubahan</h6>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Data Lama</h6>
                        <div class="data-viewer">
                            @if(!empty($changes['old']))
                            @foreach($changes['old'] as $key => $value)
                            @unless(in_array($key, ['created_at', 'updated_at', 'foto', 'deleted_at', 'deleted_by',
                            'updated_by', 'created_by', 'token', 'method']))
                            <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                @if(is_array($value))
                                {{ implode(', ', $value) }}
                                @else
                                {{ $value }}
                                @endif
                            </p>
                            @endunless
                            @endforeach
                            @else
                            <p>Tidak ada data lama.</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Data Baru</h6>
                        <div class="data-viewer">
                            @if(!empty($changes['new']))
                            @foreach($changes['new'] as $key => $value)
                            @unless(in_array($key, ['_method', '_token']))
                            <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                @if(is_array($value))
                                {{ implode(', ', $value) }}
                                @else
                                {{ $value }}
                                @endif
                            </p>
                            @endunless
                            @endforeach
                            @else
                            <p>Tidak ada data baru.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($log->model === 'SuratJalan' && !empty($details))
            <div class="mb-4">
                <h6>Details</h6>
                <div class="details-list">
                    @foreach($details as $detail)
                    <div class="detail-item mb-3 p-3 border rounded">
                        <p><strong>Nama Barang :</strong> {{ $detail['namaBarang'] ?? '-' }}</p>
                        <p><strong>Jumlah :</strong> {{ $detail['jumlahBarang'] ?? '-' }}</p>
                        <p><strong>Kode :</strong> {{ $detail['kodeBarang'] ?? '-' }}</p>
                        <p><strong>Keterangan :</strong> {{ $detail['keteranganBarang'] ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @elseif($log->model === 'Mutasi' && !empty($details))
            <div class="mb-4">
                <h6>Details</h6>
                <div class="details-list">
                    @foreach($details as $detail)
                    <div class="detail-item mb-3 p-3 border rounded">
                        <p><strong>Nama Barang :</strong> {{ $detail['nama_barang'] ?? '-' }}</p>
                        <p><strong>Merk :</strong> {{ $detail['merk'] ?? '-' }}</p>
                        <p><strong>Kategori :</strong> {{ $detail['kategori'] ?? '-' }}</p>
                        <p><strong>No Inventaris :</strong> {{ $detail['no_inventaris'] ?? '-' }}</p>
                        <p><strong>Keterangan :</strong> {{ $detail['keterangan'] ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($log->action === 'Deleted')
            <form action="{{ route('admin.logs.restore', $log->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Restore</button>
            </form>
            @endif
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        border-bottom: 1px solid #dee2e6;
    }

    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }

    .data-viewer {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 0.75rem;
        margin-bottom: 1rem;
    }

    .details-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .detail-item {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }
</style>
@endsection