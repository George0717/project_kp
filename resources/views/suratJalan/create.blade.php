@extends('layouts.main')

@section('title', 'Tambah Surat Jalan')
@section('page1', 'Tambah Surat Jalan')

@section('container')
    <form action="{{ route('suratJalan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="nomorSurat" class="block text-gray-700 text-sm font-bold mb-2">Nomor Surat</label>
            <input type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="nomorSurat" name="nomorSurat">
            @error('nomorSurat')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="tglKirim" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kirim</label>
            <input type="date"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="tglKirim" name="tglKirim">
            @error('tglKirim')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="tujuanTempat" class="block text-gray-700 text-sm font-bold mb-2">Tujuan Tempat</label>
            <input type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="tujuanTempat" name="tujuanTempat">
            @error('tujuanTempat')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <div id="barang-container" class="mb-4">
            <div class="mb-4">
                <label for="namaBarang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="namaBarang" name="namaBarang[]">
                @error('namaBarang.*')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="jumlahBarang" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Barang</label>
                <input type="number"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="jumlahBarang" name="jumlahBarang[]">
                @error('jumlahBarang.*')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="button"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            onclick="addBarang()">Tambah Barang</button>
        <div class="mt-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
        </div>
    </form>

    <script>
        function addBarang() {
            var container = document.getElementById('barang-container');
            var html = `
            <div class="mb-4">
                <label for="namaBarang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="namaBarang[]">
                @error('namaBarang.*')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="jumlahBarang" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Barang</label>
                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="jumlahBarang[]">
                @error('jumlahBarang.*')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
        `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection
