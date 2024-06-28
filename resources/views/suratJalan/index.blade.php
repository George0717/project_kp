@extends('layouts.main')

@section('title', 'Daftar Surat Jalan')
@section('page1', 'Daftar Surat Jalan')

@section('container')
    <a href="{{ route('suratJalan.create') }}" class="btn btn-primary mb-3">Tambah Surat Jalan</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nomor Surat</th>
                <th>Tanggal Kirim</th>
                <th>Tujuan Tempat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratJalans as $suratJalan)
                <tr>
                    <td>{{ $suratJalan->nomorSurat }}</td>
                    <td>{{ $suratJalan->tglKirim }}</td>
                    <td>{{ $suratJalan->tujuanTempat }}</td>
                    <td>
                        <a href="{{ route('suratJalan.show', $suratJalan) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('suratJalan.edit', $suratJalan) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('suratJalan.destroy', $suratJalan) }}" method="post"
                            style="display:inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
