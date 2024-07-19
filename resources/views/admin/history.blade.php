@extends('layouts.admin')

@section('title', 'Riwayat')
@section('page1', 'Riwayat')

@section('content')
<div class="container">
    <h1>User Action History</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
                <th>Model</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $history)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $history->user->name }}</td>
                <td>{{ $history->action }}</td>
                <td>{{ $history->model }}</td>
                <td>{{ $history->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $histories->links() }} <!-- Pagination links -->
</div>
@endsection
