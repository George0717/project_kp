@extends('layouts.admin')

@section('container')
<div class="container">
    <h1>Riwayat</h1>
    <table class="table text-center">
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Model</th>
                <th>Model ID</th>
                <th>Detail</th> <!-- Changed this to Detail -->
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->user ? $log->user->name : 'Unknown' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->model }}</td>
                <td>{{ $log->model_id }}</td>
                <td>
                    @if($log->model === 'SuratJalan')
                    @php
                    $suratJalan = \App\Models\SuratJalan::find($log->model_id);
                    @endphp
                    {{ $suratJalan ? $suratJalan->nomorSurat : 'N/A' }}
                    @elseif($log->model === 'Mutasi')
                    @php
                    $mutasi = \App\Models\Mutasi::find($log->model_id);
                    @endphp
                    {{ $mutasi ? $mutasi->dibuat_oleh : 'N/A' }}
                    @else
                    N/A
                    @endif
                </td>
                <td><a href="{{ route('admin.logs.show', $log->id) }}">{{ $log->created_at->format('d M Y H:i') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->appends(request()->input())->links() }}
</div>
@endsection