@extends('layouts.main')

@section('title', 'Detail Surat Jalan')
@section('page1', 'Detail Surat Jalan')

@section('container')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Detail Surat Jalan</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Nomor Surat:</strong> {{ $suratJalan->nomorSurat }}</p>
                    <p><strong>Tanggal Kirim:</strong> {{ $suratJalan->tglKirim }}</p>
                    <p><strong>Tujuan Tempat:</strong> {{ $suratJalan->tujuanTempat }}</p>
                    <p><strong>Dibuat Pada:</strong> {{ $suratJalan->created_at->translatedFormat('d F Y') }}</p>
                </div>
                <div class="col-md-6 text-center">
                    @if ($suratJalan->foto)
                    <img src="{{ asset('storage/images/'.$suratJalan->foto) }}" class="img-fluid" />             
                    @else
                    <p class="text-muted">Foto tidak tersedia</p>
                    @endif
                </div>
            </div>
            <h5 class="mt-4">Detail Barang</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah Barang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratJalan->details as $detail)
                    <tr>
                        <td>{{ $detail->namaBarang }}</td>
                        <td>{{ $detail->jumlahBarang }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('suratJalan.index') }}" class="btn btn-secondary mt-4">Kembali</a>
        </div>
    </div>
</div>
@endsection