@extends('layouts.main')

@section('container')
<h1 class="text-center mt-2">{{ $history->title }}</h1>
<p>{{ $history->description }}</p>
<p><small>{{ $history->date }}</small></p>

<!-- Tombol Kembali -->
<div class="text-center mt-4">
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
