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
                <th>Detail</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->user ? $log->user->name : 'Unknown' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->model }}</td>
                <td>
                    @if($log->action === 'Deleted')
                    @php
                    $modelClass = $log->model === 'SuratJalan' ? \App\Models\SuratJalan::class :
                    \App\Models\Mutasi::class;
                    $model = $modelClass::onlyTrashed()->find($log->model_id);
                    @endphp
                    {{ $model ? ($log->model === 'SuratJalan' ? $model->nomorSurat : $model->dibuat_oleh) : 'N/A' }}
                    @else
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