@extends('layouts.main')
@section('container')
@section('title', 'Edit Surat Jalan')
@section('page1','Surat Jalan')
<div class="p-4">

    <h1 class="text-center mb-3">Surat Jalan {{ $suratJalan->nomorSurat }}</h1>

    <form form class="forms-sample" action="{{ route('suratJalan.update', $suratJalan->id) }}" method="POST"
        enctype="multipart/form-data" >
        @csrf
        @method('patch')
        <div class="input-group input-group-static">
            <input type="number" class="form-control" id="nomorSurat" placeholder="Nomor Surat"
                value="{{ $suratJalan->nomorSurat }}" name="nomorSurat">
            <input type="date" class="form-control" type="date" class="form-control" id="tglKirim" name="tglKirim"
                class="form-control" placeholder="Tanggal Kirim" value="{{ $suratJalan->tglKirim }}">
            <input type="Text" class="form-control" id="namaBarang" placeholder="Nama Barang"
                value="{{ old('namaBarang') }}" value="{{ $suratJalan->namaBarang }}" name="namaBarang">
            <input ttype="number" class="form-control" id="jumlahBarang" placeholder="Jumlah Barang"
                value="{{ old('jumlahBarang') }}" name="jumlahBarang" value="{{ $suratJalan->jumlahBarang }}">
            <input type="text" class="form-control" id="tujuanTempat" placeholder="Tujuan Pengiriman"
                value="{{ old('tujuanTempat') }}" name="tujuanTempat" value="{{ $suratJalan->tujuanTempat}}">
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center">
                <button type="submit" class="btn bg-gradient-info btn-lg btn-rounded w-100 mt-4 mb-0 ">Submit</button>
            </div>
        </div>
</div>
</form>
<div class="row justify-content-center">
    <div class="col-12 col-md-6 text-center">
        <a href="{{ route('suratJalan.index') }}">
            <button class="btn bg-gradient-danger btn-lg btn-rounded w-100 mt-4 mb-0">Cancel</button>
        </a>
    </div>
</div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</script>