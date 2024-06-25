@extends('layouts.main')

@section('title', 'Edit Surat Jalan')
@section('page1', 'Edit Surat Jalan')

@section('container')
    <form action="{{ route('suratJalan.update', $suratJalan) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="nomorSurat">Nomor Surat</label>
            <input type="text" class="form-control" id="nomorSurat" name="nomorSurat" value="{{ $suratJalan->nomorSurat }}">
            @error('nomorSurat')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tglKirim">Tanggal Kirim</label>
            <input type="date" class="form-control" id="tglKirim" name="tglKirim" value="{{ $suratJalan->tglKirim }}">
            @error('tglKirim')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tujuanTempat">Tujuan Tempat</label>
            <input type="text" class="form-control" id="tujuanTempat" name="tujuanTempat"
                value="{{ $suratJalan->tujuanTempat }}">
            @error('tujuanTempat')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div id="barang-container">
            @foreach ($suratJalan->details as $detail)
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" class="form-control" name="namaBarang[]" value="{{ $detail->namaBarang }}">
                    @error('namaBarang.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jumlahBarang">Jumlah Barang</label>
                    <input type="number" class="form-control" name="jumlahBarang[]" value="{{ $detail->jumlahBarang }}">
                    @error('jumlahBarang.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary" onclick="addBarang()">Tambah Barang</button>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script>
        function addBarang() {
            var container = document.getElementById('barang-container');
            var html = `
            <div class="form-group">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" class="form-control" name="namaBarang[]">
                @error('namaBarang.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlahBarang">Jumlah Barang</label>
                <input type="number" class="form-control" name="jumlahBarang[]">
                @error('jumlahBarang.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection
