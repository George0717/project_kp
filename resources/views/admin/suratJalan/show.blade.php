@extends('layouts.admin')
@section('title', 'Detail Surat Jalan')
@section('page1', 'Detail Surat Jalan')

@section('container')
<div class="container mt-5">
    <div class="card animate__animated animate__fadeIn">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Detail Surat Jalan</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Nomor Surat:</strong> {{ $suratJalan->nomorSurat }}</p>
                    <p><strong>From:</strong> {{ $suratJalan->divisi_pengirim }}</p>
                    <p><strong>Tanggal Kirim:</strong> {{ $suratJalan->tglKirim }}</p>
                    <p><strong>Tujuan Tempat:</strong> {{ $suratJalan->tujuanTempat }}</p>
                    <p><strong>Dibuat Pada:</strong> {{ $suratJalan->created_at->translatedFormat('d F Y:i') }}</p>
                    <p><strong>Diperbarui Pada:</strong> {{ $suratJalan->updated_at->translatedFormat('d F Y:i') }}</p>
                </div>
                <div class="col-md-6 text-center">
                    @if ($suratJalan->foto)
                    <img src="{{ asset('storage/images/'.$suratJalan->foto) }}" class="img-fluid rounded shadow-sm"
                        alt="Foto Surat Jalan" />
                    @else
                    <p class="text-muted">Foto tidak tersedia</p>
                    @endif
                </div>
            </div>
            <h5 class="mt-4">Detail Barang</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suratJalan->details as $detail)
                        <tr>
                            <td>{{ $detail->namaBarang }}</td>
                            <td>{{ $detail->jumlahBarang }}</td>
                            <td>{{ $detail->kode_barang }}</td>
                            <td>{{ $detail->keterangan_barang }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.suratJalan.index') }}" class="btn btn-secondary mt-4">Kembali</a>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<!-- Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<!-- Custom CSS for loading overlay -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show loading overlay
        var loadingOverlay = document.getElementById('loading');
        loadingOverlay.style.display = 'flex';

        // Hide loading overlay after content is fully loaded
        window.addEventListener('load', function () {
            loadingOverlay.style.display = 'none';
        });
    });
</script>
@endsection