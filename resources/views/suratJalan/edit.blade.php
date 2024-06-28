@extends('layouts.main')

@section('title', 'Edit Surat Jalan')
@section('page1', 'Edit Surat Jalan')

@section('container')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Edit Surat Jalan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('suratJalan.update', $suratJalan) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group mb-4">
                    <label for="nomorSurat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control @error('nomorSurat') is-invalid @enderror" id="nomorSurat" name="nomorSurat" value="{{ $suratJalan->nomorSurat }}">
                    @error('nomorSurat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tglKirim" class="form-label">Tanggal Kirim</label>
                    <input type="date" class="form-control @error('tglKirim') is-invalid @enderror" id="tglKirim" name="tglKirim" value="{{ $suratJalan->tglKirim }}">
                    @error('tglKirim')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tujuanTempat" class="form-label">Tujuan Tempat</label>
                    <input type="text" class="form-control @error('tujuanTempat') is-invalid @enderror" id="tujuanTempat" name="tujuanTempat" value="{{ $suratJalan->tujuanTempat }}">
                    @error('tujuanTempat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div id="barang-container">
                    @foreach ($suratJalan->details as $detail)
                        <div class="form-group mb-4">
                            <label for="namaBarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control @error('namaBarang.*') is-invalid @enderror" name="namaBarang[]" value="{{ $detail->namaBarang }}">
                            @error('namaBarang.*')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control @error('jumlahBarang.*') is-invalid @enderror" name="jumlahBarang[]" value="{{ $detail->jumlahBarang }}">
                            @error('jumlahBarang.*')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
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
