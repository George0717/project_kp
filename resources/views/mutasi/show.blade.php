@extends('layouts.main')

@section('title', 'Detail Mutasi')
@section('page1', 'Detail Mutasi')

@section('container')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Detail Mutasi</h4>
        </div>
        <div class="card-body">
            <p><strong>Divisi Pengirim:</strong> {{ $mutasi->divisi_pengirim }}</p>
            <p><strong>Penanggung Jawab:</strong> {{ $mutasi->penanggung_jawab }}</p>
            <p><strong>Dibuat Oleh:</strong> {{ $mutasi->dibuat_oleh }}</p>
            <p><strong>Lokasi:</strong> {{ $mutasi->lokasi }}</p>
            <p><strong>Divisi Tujuan:</strong> {{ $mutasi->divisi_tujuan }}</p>

            <h5 class="mt-4">Detail Barang</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Model</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">No. Inventaris</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutasi->details as $detail)
                        <tr>
                            <td>{{ $detail->nama_barang }}</td>
                            <td>{{ $detail->merk }}</td>
                            <td>{{ $detail->model }}</td>
                            <td>{{ $detail->kategori }}</td>
                            <td>{{ $detail->no_inventaris }}</td>
                            <td>{{ $detail->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('mutasi.index') }}" class="btn btn-secondary mt-4">Kembali</a>
        </div>
    </div>
</div>
@endsection
