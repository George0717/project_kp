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
                    <input type="text" class="form-control @error('nomorSurat') is-invalid @enderror" id="nomorSurat"
                        name="nomorSurat" value="{{ $suratJalan->nomorSurat }}">
                    @error('nomorSurat')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="divisi_pengirim" class="form-label">From</label>
                    <input type="text" class="form-control @error('divisi_pengirim') is-invalid @enderror" id="divisi_pengirim"
                        name="divisi_pengirim" value="{{ $suratJalan->divisi_pengirim }}" placeholder="Contoh : Andre (IT/Lemabang)">
                    @error('divisi_pengirim')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tglKirim" class="form-label">Tanggal Kirim</label>
                    <input type="date" class="form-control @error('tglKirim') is-invalid @enderror" id="tglKirim"
                        name="tglKirim" value="{{ $suratJalan->tglKirim }}">
                    @error('tglKirim')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tujuanTempat" class="form-label">Tujuan Tempat</label>
                    <select class="form-control @error('tujuanTempat') is-invalid @enderror" id="tujuanTempat"
                        name="tujuanTempat">
                        <option value="">Pilih Tujuan Tempat</option>
                        <option value="Grand JM" {{ $suratJalan->tujuanTempat=='Grand JM' ? 'selected' : '' }}>Grand JM
                        </option>
                        <option value="JM Lemabang" {{ $suratJalan->tujuanTempat=='JM Lemabang' ? 'selected' : '' }}>JM
                            Lemabang</option>
                        <option value="Gudang Bambang Utoyo" {{ $suratJalan->tujuanTempat=='Gudang Bambang Utoyo' ?
                            'selected' : '' }}>Gudang Bambang Utoyo</option>
                        <option value="CM Sako" {{ $suratJalan->tujuanTempat=='CM Sako' ? 'selected' : '' }}>CM Sako
                        </option>
                        <option value="Center Point Malang" {{ $suratJalan->tujuanTempat=='Center Point Malang' ?
                            'selected' : '' }}>Center Point Malang</option>
                        <option value="Center Point Lampung" {{ $suratJalan->tujuanTempat=='Center Point Lampung' ?
                            'selected' : '' }}>Center Point Lampung</option>
                        <option value="JM Kenten" {{ $suratJalan->tujuanTempat=='JM Kenten' ? 'selected' : '' }}>JM
                            Kenten</option>
                        <option value="JM Sukarami" {{ $suratJalan->tujuanTempat=='JM Sukarami' ? 'selected' : '' }}>JM
                            Sukarami</option>
                        <option value="JM Plaju" {{ $suratJalan->tujuanTempat=='JM Plaju' ? 'selected' : '' }}>JM Plaju
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
                    @foreach ($suratJalan->details as $detail)
                    <div class="form-group mb-4">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('namaBarang.*') is-invalid @enderror"
                            name="namaBarang[]" value="{{ $detail->namaBarang }}">
                        @error('namaBarang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                        <input type="number" class="form-control @error('jumlahBarang.*') is-invalid @enderror"
                            name="jumlahBarang[]" value="{{ $detail->jumlahBarang }}">
                        @error('jumlahBarang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control @error('kode_barang.*') is-invalid @enderror"
                            name="kode_barang[]" value="{{ $detail->kode_barang }}">
                        @error('kode_barang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="keterangan_barang" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan_barang.*') is-invalid @enderror"
                            name="keterangan_barang[]" value="{{ $detail->keterangan_barang }}">
                        @error('keterangan_barang.*')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mb-4" onclick="addBarang()">Tambah Barang</button>
                <button type="submit" class="btn btn-primary">Submit</button>
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
            <div class="form-group mb-4">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control @error('kode_barang.*') is-invalid @enderror" name="kode_barang[]" value="{{ $detail->kode_barang }}">
                            @error('kode_barang.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="keterangan_barang" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan_barang.*') is-invalid @enderror" name="keterangan_barang[]" value="{{ $detail->keterangan_barang }}">
                            @error('keterangan_barang.*')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }
</script>
@endsection