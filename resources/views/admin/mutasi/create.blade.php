@extends('layouts.admin')

@section('title', 'Tambah Mutasi')
@section('page1', 'Tambah Mutasi')

@section('container')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Tambah Mutasi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.mutasi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Form fields -->
                <div class="form-group mb-4">
                    <label for="tgl_buat" class="form-label">Tanggal Buat</label>
                    <input type="date" class="form-control @error('tgl_buat') is-invalid @enderror" id="tgl_buat"
                        name="tgl_buat" value="{{ old('tgl_buat') }}">
                    @error('tgl_buat')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="penanggung_jawab" class="form-label">Penanggung Jawab / Divisi</label>
                    <select class="form-control @error('penanggung_jawab') is-invalid @enderror" id="penanggung_jawab" name="penanggung_jawab">
                        <option value="">Divisi</option>
                        <option value="IT" {{ old('penanggung_jawab')=='IT' ? 'selected' : '' }}>IT</option>
                    </select>
                    @error('penanggung_jawab')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="dibuat_oleh" class="form-label">Dibuat Oleh</label>
                    <select class="form-control @error('dibuat_oleh') is-invalid @enderror" id="dibuat_oleh" name="dibuat_oleh">
                        <option value="">Pilih dibuat oleh</option>
                        <option value="Andre" {{ old('dibuat_oleh')=='Andre' ? 'selected' : '' }}>Andre</option>
                        <option value="Rudy" {{ old('dibuat_oleh')=='Rudy' ? 'selected' : '' }}>Rudy</option>
                        <option value="Alvien" {{ old('dibuat_oleh')=='Alvien' ? 'selected' : '' }}>Alvien</option>
                    </select>
                    @error('dibuat_oleh')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="lokasi" class="form-label">Lokasi / Divisi</label>
                    <select class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi">
                        <option value="">Pilih Tujuan Tempat</option>
                        <option value="Head Office Lemabang / IT" {{ old('lokasi')=='Head Office Lemabang / IT' ? 'selected' : '' }}>Head Office Lemabang / IT</option>
                    </select>
                    @error('lokasi')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="divisi_tujuan" class="form-label">Divisi Tujuan</label>
                    <select class="form-control @error('divisi_tujuan') is-invalid @enderror" id="divisi_tujuan"
                        name="divisi_tujuan">
                        <option value="">Pilih Divisi Tujuan</option>
                        <option value="IT Support CM Sako" {{ old('divisi_tujuan')=='IT Support CM Sako' ? 'selected'
                            : '' }}>IT Support CM Sako</option>
                        <option value="IT Support JM Kenten" {{ old('divisi_tujuan')=='IT Support JM Kenten'
                            ? 'selected' : '' }}>IT Support JM Kenten</option>
                        <option value="IT Support Center Point Malang" {{
                            old('divisi_tujuan')=='IT Support Center Point Malang' ? 'selected' : '' }}>IT Support
                            Center Point Malang</option>
                        <option value="IT Support Center Point Lampung" {{
                            old('divisi_tujuan')=='IT Support Center Point Lampung' ? 'selected' : '' }}>IT Support
                            Center Point Lampung</option>
                        <option value="IT Support JM Sukarami" {{ old('divisi_tujuan')=='IT Support JM Sukarami'
                            ? 'selected' : '' }}>IT Support JM Sukarami</option>
                        <option value="IT Support JM Plaju" {{ old('divisi_tujuan')=='IT Support JM Plaju' ? 'selected'
                            : '' }}>IT Support JM Plaju</option>
                        <option value="IT Support JM Lemabang" {{ old('divisi_tujuan')=='IT Support JM Lemabang'
                            ? 'selected' : '' }}>IT Support JM Lemabang</option>
                        <option value="IT Support Gudang Bambang Utoyo" {{
                            old('divisi_tujuan')=='IT Support Gudang Bambang Utoyo' ? 'selected' : '' }}>IT Support
                            Gudang Bambang Utoyo</option>
                        <option value="IT Support Grand JM" {{ old('divisi_tujuan')=='IT Support Grand JM' ? 'selected'
                            : '' }}>IT Support Grand JM</option>
                        <option value="IT Support Central Pavilion" {{
                            old('divisi_tujuan')=='IT Support Central Pavilion' ? 'selected' : '' }}>IT Support Central
                            Pavilion</option>
                    </select>
                    @error('divisi_tujuan')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="foto_mutasi" class="form-label">Upload Foto</label>
                    <input type="file" class="form-control @error('foto_mutasi') is-invalid @enderror" id="foto_mutasi"
                        name="foto_mutasi">
                    @error('foto_mutasi')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div id="barang-container">
                    <div class="barang-item">
                        <div class="form-group mb-4">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control @error('nama_barang.*') is-invalid @enderror"
                                id="nama_barang" name="nama_barang[]">
                            @error('nama_barang.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 mb-4">
                                <label for="merk" class="form-label">Merk</label>
                                <input type="text" class="form-control @error('merk.*') is-invalid @enderror" id="merk"
                                    name="merk[]">
                                @error('merk.*')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 mb-4">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-control @error('kategori.*') is-invalid @enderror" id="kategori"
                                    name="kategori[]">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Mutasi">Mutasi</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                                @error('kategori.*')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 mb-4">
                                <label for="no_inventaris" class="form-label">No. Inventaris</label>
                                <input type="text" class="form-control @error('no_inventaris.*') is-invalid @enderror"
                                    id="no_inventaris" name="no_inventaris[]">
                                @error('no_inventaris.*')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan.*') is-invalid @enderror"
                                id="keterangan" name="keterangan[]">
                            @error('keterangan.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-barang">Hapus</button>
                        <hr>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="add-barang">Tambah Barang</button>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = 1;

        document.getElementById('add-barang').addEventListener('click', function () {
            itemIndex++;
            let newBarangItem = document.createElement('div');
            newBarangItem.classList.add('barang-item');
            newBarangItem.innerHTML = `
                <div class="form-group mb-4">
                    <label for="nama_barang_${itemIndex}" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control @error('nama_barang.*') is-invalid @enderror" id="nama_barang_${itemIndex}" name="nama_barang[]">
                    @error('nama_barang.*')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-4">
                        <label for="merk_${itemIndex}" class="form-label">Merk</label>
                        <input type="text" class="form-control @error('merk.*') is-invalid @enderror" id="merk_${itemIndex}" name="merk[]">
                        @error('merk.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 mb-4">
                        <label for="kategori_${itemIndex}" class="form-label">Kategori</label>
                        <select class="form-control @error('kategori.*') is-invalid @enderror" id="kategori_${itemIndex}" name="kategori[]">
                            <option value="">Pilih Kategori</option>
                            <option value="Baru">Baru</option>
                            <option value="Mutasi">Mutasi</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                        @error('kategori.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 mb-4">
                        <label for="no_inventaris_${itemIndex}" class="form-label">No. Inventaris</label>
                        <input type="text" class="form-control @error('no_inventaris.*') is-invalid @enderror" id="no_inventaris_${itemIndex}" name="no_inventaris[]">
                        @error('no_inventaris.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="keterangan_${itemIndex}" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan.*') is-invalid @enderror" id="keterangan_${itemIndex}" name="keterangan[]">
                    @error('keterangan.*')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-barang">Hapus</button>
                <hr>
            `;
            document.getElementById('barang-container').appendChild(newBarangItem);
        });

        document.getElementById('barang-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-barang')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endpush
@endsection
