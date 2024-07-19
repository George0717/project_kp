@extends('layouts.admin')
@section('container')
<div class="container">
    <h1>Detail Log</h1>
    <div>
        <p>User: {{ $log->user ? $log->user->name : 'Unknown' }}</p>
        <p>Action: {{ $log->action }}</p>
        <p>Model: {{ $log->model }}</p>
        <p>Model ID: {{ $log->model_id }}</p>
        <p>Changes: <pre>{{ json_encode(json_decode($log->changes), JSON_PRETTY_PRINT) }}</pre></p>
        <p>Timestamp: {{ $log->created_at->format('d M Y H:i') }}</p>
    </div>
    @if($log->action === 'Deleted')
        <form action="{{ route('admin.logs.restore', $log->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Restore</button>
        </form>
    @endif
    <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary mt-4">Kembali</a>
</div>
@endsection
