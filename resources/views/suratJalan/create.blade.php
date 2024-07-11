@extends('layouts.main')
@section('title', 'Tambah Surat Jalan')
@section('page1', 'Tambah Surat Jalan')

@section('container')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Tambah Surat Jalan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('suratJalan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label for="nomorSurat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control @error('nomorSurat') is-invalid @enderror" id="nomorSurat"
                        name="nomorSurat" value="{{ old('nomorSurat') }}">
                    @error('nomorSurat')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tglKirim" class="form-label">Tanggal Kirim</label>
                    <input type="date" class="form-control @error('tglKirim') is-invalid @enderror" id="tglKirim"
                        name="tglKirim" value="{{ old('tglKirim') }}">
                    @error('tglKirim')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tujuanTempat" class="form-label">Tujuan Tempat</label>
                    <select class="form-control @error('tujuanTempat') is-invalid @enderror" id="tujuanTempat"
                        name="tujuanTempat">
                        <option value="">Pilih Tujuan Tempat</option>
                        <option value="Grand JM" {{ old('tujuanTempat')=='Grand JM' ? 'selected' : '' }}>Grand JM
                        </option>
                        <option value="JM Lemabang" {{ old('tujuanTempat')=='JM Lemabang' ? 'selected' : '' }}>JM
                            Lemabang</option>
                        <option value="Gudang Bambang Utoyo" {{ old('tujuanTempat')=='Gudang Bambang Utoyo' ? 'selected'
                            : '' }}>Gudang Bambang Utoyo</option>
                        <option value="CM Sako" {{ old('tujuanTempat')=='CM Sako' ? 'selected' : '' }}>CM Sako</option>
                        <option value="Center Point Malang" {{ old('tujuanTempat')=='Center Point Malang' ? 'selected'
                            : '' }}>Center Point Malang</option>
                        <option value="Center Point Lampung" {{ old('tujuanTempat')=='Center Point Lampung' ? 'selected'
                            : '' }}>Center Point Lampung</option>
                        <option value="JM Kenten" {{ old('tujuanTempat')=='JM Kenten' ? 'selected' : '' }}>JM Kenten
                        </option>
                        <option value="JM Sukarami" {{ old('tujuanTempat')=='JM Sukarami' ? 'selected' : '' }}>JM
                            Sukarami</option>
                        <option value="JM Plaju" {{ old('tujuanTempat')=='JM Plaju' ? 'selected' : '' }}>JM Plaju
                        </option>
                    </select>
                    @error('tujuanTempat')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4 m-2">
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                    @error('foto')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div id="barang-container">
                    <div class="form-group mb-4">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('namaBarang.*') is-invalid @enderror"
                            id="namaBarang" name="namaBarang[]">
                        @error('namaBarang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                        <input type="number" class="form-control @error('jumlahBarang.*') is-invalid @enderror"
                            id="jumlahBarang" name="jumlahBarang[]">
                        @error('jumlahBarang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="kode_barang" class="form-label">Kode</label>
                        <input type="text" class="form-control @error('kode_barang.*') is-invalid @enderror"
                            id="kode_barang" name="kode_barang[]">
                        @error('kode_barang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="keterangan_barang" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan_barang.*') is-invalid @enderror"
                            id="keterangan_barang" name="keterangan_barang[]">
                        @error('keterangan_barang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="button" id="tambah-barang" class="btn btn-primary mb-4">Tambah Barang</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('tambah-barang').addEventListener('click', function () {
    var barangContainer = document.getElementById('barang-container');
    var barangHTML = `
        <div class="form-group mb-4">
            <label for="namaBarang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="namaBarang" name="namaBarang[]">
        </div>
        <div class="form-group mb-4">
            <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang[]">
        </div>
        <div class="form-group mb-4">
          <label for="kode_barang" class="form-label">Kode</label>
                <input type="text" class="form-control @error('kode_barang.*') is-invalid @enderror"
                id="kode_barang" name="kode_barang[]">
                        @error('kode_barang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="keterangan_barang" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan_barang.*') is-invalid @enderror"
                            id="keterangan_barang" name="keterangan_barang[]">
                        @error('keterangan_barang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
    `;
    barangContainer.insertAdjacentHTML('beforeend', barangHTML);
});
</script>
@endsection