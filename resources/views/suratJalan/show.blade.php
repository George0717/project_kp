@extends('layouts.main')

@section('title', 'Detail Surat Jalan')
@section('page1', 'Detail Surat Jalan')

@section('container')
    <h1>Detail Surat Jalan</h1>
    <p><strong>Nomor Surat:</strong> {{ $suratJalan->nomorSurat }}</p>
    <p><strong>Tanggal Kirim:</strong> {{ $suratJalan->tglKirim }}</p>
    <p><strong>Tujuan Tempat:</strong> {{ $suratJalan->tujuanTempat }}</p>
    <h3>Detail Barang</h3>
    <ul>
        @foreach ($suratJalan->details as $detail)
            <li>{{ $detail->namaBarang }} - {{ $detail->jumlahBarang }}</li>
        @endforeach
    </ul>
    <a href="{{ route('suratJalan.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
