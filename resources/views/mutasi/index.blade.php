@extends('layouts.main')

@section('title', 'Daftar Mutasi')
@section('page1', 'Daftar Mutasi')

@section('container')
    <a href="{{ route('mutasi.create') }}" class="btn btn-primary mb-3">Tambah Mutasi</a>
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>Divisi Pengirim</th>
                <th>Penanggung Jawab</th>
                <th>Dibuat Oleh</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mutasis as $mutasi)
                <tr>
                    <td>{{ $mutasi->divisi_pengirim }}</td>
                    <td>{{ $mutasi->penanggung_jawab }}</td>
                    <td>{{ $mutasi->dibuat_oleh }}</td>
                    <td>{{ $mutasi->lokasi }}</td>
                    <td>
                        <a href="{{ route('mutasi.show', $mutasi) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('mutasi.edit', $mutasi) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('mutasi.destroy', $mutasi) }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
