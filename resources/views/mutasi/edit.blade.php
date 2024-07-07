@extends('layouts.main')

@section('title', 'Edit Mutasi')
@section('page1', 'Edit Mutasi')

@section('container')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Edit Mutasi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('mutasi.update', $mutasi ) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group mb-4 border">
                    <label for="divisi_pengirim" class="form-label">Divisi Pengirim</label>
                    <input type="text" class="form-control @error('divisi_pengirim') is-invalid @enderror"
                        id="divisi_pengirim" name="divisi_pengirim" value="{{ $mutasi->divisi_pengirim }}">
                    @error('divisi_pengirim')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4 border">
                    <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                    <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror"
                        id="penanggung_jawab" name="penanggung_jawab" value="{{ $mutasi->penanggung_jawab }}">
                    @error('penanggung_jawab')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4 border">
                    <label for="dibuat_oleh" class="form-label">Dibuat Oleh</label>
                    <input type="text" class="form-control @error('dibuat_oleh') is-invalid @enderror" id="dibuat_oleh"
                        name="dibuat_oleh" value="{{ $mutasi->dibuat_oleh }}">
                    @error('dibuat_oleh')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4 border">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi"
                        name="lokasi" value="{{ $mutasi->lokasi }}">
                    @error('lokasi')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4 border">
                    <label for="divisi_tujuan" class="form-label">Divisi Tujuan</label>
                    <input type="text" class="form-control @error('divisi_tujuan') is-invalid @enderror"
                        id="divisi_tujuan" name="divisi_tujuan" value="{{ $mutasi->divisi_tujuan }}">
                    @error('divisi_tujuan')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <hr>

                <div id="barang-container">
                    @foreach ($mutasi->details as $detail)
                    <div class="form-group mb-4 border">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang.*') is-invalid @enderror"
                            id="nama_barang" name="nama_barang[]" value="{{ $detail->nama_barang }}">
                        @error('nama_barang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 border">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" class="form-control @error('merk.*') is-invalid @enderror" id="merk"
                                name="merk[]" value="{{ $detail->merk }}">
                            @error('merk.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 border">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model.*') is-invalid @enderror" id="model"
                                name="model[]" value="{{ $detail->model }}">
                            @error('model.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 border">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-control @error('kategori.*') is-invalid @enderror" id="kategori"
                                name="kategori[]" value="{{ $detail->kategori }}">
                                <option value="">Pilih Kategori</option>
                                <option value="Baru">Baru</option>
                                <option value="Mutasi">Mutasi</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                            @error('kategori.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 border">
                            <label for="no_inventaris" class="form-label">No. Inventaris</label>
                            <input type="text" class="form-control @error('no_inventaris.*') is-invalid @enderror"
                                id="no_inventaris" name="no_inventaris[]" value="{{ $detail->no_inventaris }}">
                            @error('no_inventaris.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 border">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan.*') is-invalid @enderror"
                                id="keterangan" name="keterangan[]" value="{{ $detail->keterangan }}">
                            @error('keterangan.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mb-4" onclick="addBarang()">Tambah Barang</button>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
                    @endforeach
                    
</div>

<script>
    function addBarang() {
        var container = document.getElementById('barang-container');
        var html = `
            <div class="form-group mb-4 border">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control @error('nama_barang.*') is-invalid @enderror" name="nama_barang[]" >
                @error('nama_barang.*')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-4 border">
                    <label for="merk" class="form-label">Merk</label>
                    <input type="text" class="form-control @error('merk.*') is-invalid @enderror" name="merk[]">
                    @error('merk.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4 border">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control @error('model.*') is-invalid @enderror" name="model[]">
                    @error('model.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4 border">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-control @error('kategori.*') is-invalid @enderror" name="kategori[]">
                        <option value="">Pilih Kategori</option>
                        <option value="Baru">Baru</option>
                        <option value="Mutasi">Mutasi</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                    @error('kategori.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 border">
                    <label for="no_inventaris" class="form-label">No. Inventaris</label>
                    <input type="text" class="form-control @error('no_inventaris.*') is-invalid @enderror" name="no_inventaris[]">
                    @error('no_inventaris.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6 border">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan.*') is-invalid @enderror" name="keterangan[]">
                    @error('keterangan.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }
</script>
@endsection