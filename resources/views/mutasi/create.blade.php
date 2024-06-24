@extends('layouts.main')
@section('container')
@section('title', 'Mutasi')
@section('page1','Mutasi')


<form action="{{ route('mutasi.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <button type="button" class="btn bg-gradient-info btn-block col-3" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp">
    Tambah Data Mutasi
  </button>
  @extends('mutasi.modal')
   <table class="table mb-4">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Merk</th>
        <th scope="col">Model</th>
        <th scope="col">Kategori</th>
        <th scope="col">Nomor Inventaris</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($mutasis as $item )
      <tr>
        <th scope="row">{{ $item->id }}</th>
        <td>{{ $item->nama_barang }}/td>
        <td>{{ $item->merk }}</td>
        <td>{{ $item->model }}</td>
        <td>{{ $item->kategori }}</td>
        <td>{{ $item->no_inventaris }}</td>
        <td>{{ $item->keterangan }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{-- Pengirim --}}
  <div class="pengirim">
    <h3 class="mt-2">Pengirim</h3>
    <div class="input-group input-group-outline my-3">
      <input type="text" class="form-control" placeholder="Penanggung Jawab">
    </div>
    <div class="input-group input-group-outline my-3">
      <input type="text" class="form-control" placeholder="Divisi" id="divisi_pengirim" name="divisi_pengirim">
    </div>
    <div class="input-group input-group-outline my-3">
      <input type="text" class="form-control" placeholder="Dibuat Oleh" id="dibuat_oleh" name="dibuat_oleh">
    </div>
  </div>
  {{-- Akhir Pengirim --}}
  {{-- Tujuan --}}
  <div class="tujuan">
    <h3 class="mt-2">Tujuan</h3>
    <div class="input-group input-group-outline my-3">
      <input type="text" class="form-control" placeholder="Lokasi" id="lokasi" name="lokasi">
    </div>
    <div class="input-group input-group-outline my-3">
      <input type="text" class="form-control" placeholder="Divisi" id="divisi_tujuan" name="divisi_tujuan">
    </div>
  </div>
 {{-- Akhir Tujuan --}}
 {{-- Data Mutasi --}}
 {{-- Akhir Data Mutasi --}}
 <div class="text-center tombol col-md-12">
  <button type="submit" class="btn bg-gradient-primary btn-lg w-100 mt-1 mb-0 ">Submit</button>
</div>
</form>

@endsection
