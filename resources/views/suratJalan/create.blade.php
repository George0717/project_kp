@extends('layouts.main')
@section('title', 'Tambah Surat Jalan')
@section('page1', 'Tambah Surat Jalan')

@section('container')
<div class="container mt-5">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="spinner"></div>
    </div>

    <div class="card shadow-lg rounded">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Surat Jalan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('suratJalan.store') }}" method="post" enctype="multipart/form-data"
                id="surat-jalan-form">
                @csrf
                <div class="form-group mb-4">
                    <label for="nomorSurat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control @error('nomorSurat') is-invalid @enderror" id="nomorSurat"
                        name="nomorSurat" value="{{ old('nomorSurat') }}" placeholder="Masukkan Nomor Surat">
                    @error('nomorSurat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="divisi_pengirim" class="form-label">From</label>
                    <input type="text" class="form-control @error('divisi_pengirim') is-invalid @enderror"
                        id="divisi_pengirim" name="divisi_pengirim" value="{{ old('divisi_pengirim') }}"
                        placeholder="Contoh : Andre (IT/Lemabang)">
                    @error('divisi_pengirim')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tglKirim" class="form-label">Tanggal Kirim</label>
                    <input type="date" class="form-control @error('tglKirim') is-invalid @enderror" id="tglKirim"
                        name="tglKirim" value="{{ old('tglKirim') }}">
                    @error('tglKirim')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="tujuanTempat" class="form-label">Tujuan Tempat</label>
                    <select class="form-control @error('tujuanTempat') is-invalid @enderror" id="tujuanTempat"
                        name="tujuanTempat">
                        <option value="">Pilih Tujuan Tempat</option>
                        @foreach(['Grand JM', 'JM Lemabang', 'Gudang Bambang Utoyo', 'CM Sako', 'Center Point Malang',
                        'Center Point Lampung', 'JM Kenten', 'JM Sukarami', 'JM Plaju'] as $tempat)
                        <option value="{{ $tempat }}" {{ old('tujuanTempat')==$tempat ? 'selected' : '' }}>{{ $tempat }}
                        </option>
                        @endforeach
                    </select>
                    @error('tujuanTempat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                    @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div id="barang-container">
                    <div class="form-group mb-4">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('namaBarang.*') is-invalid @enderror"
                            id="namaBarang" name="namaBarang[]" placeholder="Masukkan Nama Barang">
                        @error('namaBarang.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                        <input type="number" class="form-control @error('jumlahBarang.*') is-invalid @enderror"
                            id="jumlahBarang" name="jumlahBarang[]" placeholder="Masukkan Jumlah Barang">
                        @error('jumlahBarang.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="kode_barang" class="form-label">Kode</label>
                        <input type="text" class="form-control @error('kode_barang.*') is-invalid @enderror"
                            id="kode_barang" name="kode_barang[]" placeholder="Masukkan Kode Barang">
                        @error('kode_barang.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="keterangan_barang" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan_barang.*') is-invalid @enderror"
                            id="keterangan_barang" name="keterangan_barang[]" placeholder="Masukkan Keterangan Barang">
                        @error('keterangan_barang.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="button" id="tambah-barang" class="btn btn-primary mb-4">Tambah Barang</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

<!-- CSS for Modern Styling and Loading Overlay -->
<style>
    .card {
        border-radius: 0.75rem;
    }

    .card-header {
        border-radius: 0.75rem 0.75rem 0 0;
        font-size: 1.25rem;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
    }

    .btn {
        border-radius: 0.5rem;
        padding: 0.75rem 1.25rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        border-radius: 0.75rem;
    }

    .loading-overlay.active {
        display: flex;
    }

    .spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        border-top: 4px solid #28a745;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<!-- JavaScript for Form Handling -->
<script>
    document.getElementById('tambah-barang').addEventListener('click', function () {
        var barangContainer = document.getElementById('barang-container');
        var barangHTML = `
            <div class="form-group mb-4 item-container">
                <label for="namaBarang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="namaBarang[]" placeholder="Masukkan Nama Barang">
                <label for="jumlahBarang" class="form-label">Jumlah Barang</label>
                <input type="number" class="form-control" name="jumlahBarang[]" placeholder="Masukkan Jumlah Barang">
                <label for="kode_barang" class="form-label">Kode</label>
                <input type="text" class="form-control" name="kode_barang[]" placeholder="Masukkan Kode Barang">
                <label for="keterangan_barang" class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="keterangan_barang[]" placeholder="Masukkan Keterangan Barang">
                <button type="button" class="btn btn-danger remove-item mt-2">Hapus</button>
            </div>
        `;
        barangContainer.insertAdjacentHTML('beforeend', barangHTML);
    });

    document.getElementById('barang-container').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            e.target.closest('.item-container').remove();
        }
    });

    document.getElementById('surat-jalan-form').addEventListener('submit', function () {
        document.getElementById('loading-overlay').classList.add('active');
    });
</script>
@endsection