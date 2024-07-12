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
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Tanggal Buat:</strong> {{ \Carbon\Carbon::parse($mutasi->tgl_buat)->translatedFormat('d F Y') }}</p>
                    <p><strong>Penanggung Jawab:</strong> {{ $mutasi->penanggung_jawab }}</p>
                    <p><strong>Dibuat Oleh:</strong> {{ $mutasi->dibuat_oleh }}</p>
                    <p><strong>Lokasi:</strong> {{ $mutasi->lokasi }}</p>
                    <p><strong>Divisi Tujuan:</strong> {{ $mutasi->divisi_tujuan }}</p>
                    <p><strong>Dibuat Pada:</strong> {{ $mutasi->created_at->translatedFormat('d F Y') }}</p>
                    <p><strong>Diperbarui Pada:</strong> {{ $mutasi->updated_at->translatedFormat('d F Y') }}</p>
                </div>
                <div class="col-md-6 text-center">
                    @if ($mutasi->foto_mutasi)
                    <img src="{{ asset('storage/images/'.$mutasi->foto_mutasi) }}" class="img-fluid" />
                    @else
                    <p class="text-muted">Foto tidak tersedia</p>
                    @endif
                </div>
            </div>
            <h5 class="mt-4">Detail Barang</h5>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Merk/Tipe</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">No. Inventaris</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($mutasi->details as $detail)
                    <tr>
                        <td>{{ $detail->nama_barang }}</td>
                        <td>{{ $detail->merk }}</td>
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