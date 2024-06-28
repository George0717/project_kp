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
                    <input type="text" class="form-control @error('nomorSurat') is-invalid @enderror" id="nomorSurat" name="nomorSurat">
                    @error('nomorSurat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tglKirim" class="form-label">Tanggal Kirim</label>
                    <input type="date" class="form-control @error('tglKirim') is-invalid @enderror" id="tglKirim" name="tglKirim">
                    @error('tglKirim')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tujuanTempat" class="form-label">Tujuan Tempat</label>
                    <input type="text" class="form-control @error('tujuanTempat') is-invalid @enderror" id="tujuanTempat" name="tujuanTempat">
                    @error('tujuanTempat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div id="barang-container">
                    <div class="form-group mb-4">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('namaBarang.*') is-invalid @enderror" id="namaBarang" name="namaBarang[]">
                        @error('namaBarang.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                        <input type="number" class="form-control @error('jumlahBarang.*') is-invalid @enderror" id="jumlahBarang" name="jumlahBarang[]">
                        @error('jumlahBarang.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="button" class="btn btn-secondary mb-4" onclick="addBarang()">Tambah Barang</button>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addBarang() {
        var container = document.getElementById('barang-container');
        var html = `
            <div class="form-group mb-4">
                <label for="namaBarang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control @error('namaBarang.*') is-invalid @enderror" name="namaBarang[]">
                @error('namaBarang.*')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                <input type="number" class="form-control @error('jumlahBarang.*') is-invalid @enderror" name="jumlahBarang[]">
                @error('jumlahBarang.*')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }
</script>
@endsection
