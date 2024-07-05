@extends('layouts.main')

@section('container')
<h1 class="text-center mt-2">Jaya Masamawan</h1>
<h2>About</h2>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut ipsam corporis cupiditate iste minima quod est ut distinctio. Iure tempora mollitia, quaerat hic nesciunt architecto maiores veniam sint? Velit, aperiam?</p>

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
