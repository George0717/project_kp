@extends('layouts.main')

@section('container')
<h1 class="text-center mt-2">Jaya Masamawan Putra Sejahtera</h1>
<h2>About</h2>
<p>PT. Jaya Masawan Putra Sejahtera merupakan salah satu perusahaan Retail
    yang berkembang di provinsi Sumatera Selatan. Perusahaan retail ini didirikan oleh
    Bapak Yusuf Masawan beserta istri, Ibu Junlia Susanti yang diawali dengan usaha
    di bidang konveksi. Berkat kerja keras dan kegigihan mereka toko konveksiberubah
    menjadi perusahaan retail yang berkembang</p>

<h2 class="text-center mt-4">Sejarah Perusahaan</h2>
<div class="history-slider">
    @foreach($histories as $history)
    <div class="history-card">
        <h3 class="mt-2">{{ $history->title }}</h3>
        <p>{{ $history->description }}</p>
        <p><small>{{ $history->date }}</small></p>
        <a href="{{ route('sejarah', ['id' => $history->id]) }}" class="btn btn-primary">Lihat Detail</a>
    </div>
    @endforeach
</div>
@endsection
