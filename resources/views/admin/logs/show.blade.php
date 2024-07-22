@extends('layouts.admin')

@section('container')
<div class="container">
    <h1>Detail Log</h1>

    <div class="mb-3">
        <a href="{{ route('admin.logs.index') }}" class="btn btn-primary">Kembali</a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Log Details
        </div>
        <div class="card-body" id="log-details">
            <div class="row mb-2">
                <div class="col-sm-3 font-weight-bold">User:</div>
                <div class="col-sm-9">{{ $log->user ? $log->user->name : 'Unknown' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 font-weight-bold">Action:</div>
                <div class="col-sm-9">{{ $log->action }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 font-weight-bold">Model:</div>
                <div class="col-sm-9">{{ $log->model }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 font-weight-bold">Model ID:</div>
                <div class="col-sm-9">{{ $log->model_id }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 font-weight-bold">Timestamp:</div>
                <div class="col-sm-9">{{ $log->created_at->format('d M Y H:i') }}</div>
            </div>
        </div>
    </div>

    @if(in_array($log->action, ['Created', 'Updated']))
    <div class="card mt-3">
        <div class="card-header">
            Changes
        </div>
        <div class="card-body">
            @if(isset($changes['new']))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>New Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($changes['new'] as $key => $value)
                    @if($key !== '_token' && $key !== 'method' && $key !== 'foto')
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                        <td>
                            @if(is_array($value))
                            <ul>
                                @foreach($value as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                            @else
                            {{ $value ?? 'N/A' }}
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No changes available.</p>
            @endif
        </div>
    </div>
    @elseif($log->action === 'Deleted')
    <div class="card mt-3">
        <div class="card-header">
            Deleted Data
        </div>
        <div class="card-body">
            @if(isset($changes['old']))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Old Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($changes['old'] as $key => $value)
                    @if($key !== '_token' && $key !== 'method' && $key !== 'foto')
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                        <td>
                            @if(is_array($value))
                            <ul>
                                @foreach($value as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                            @else
                            {{ $value ?? 'N/A' }}
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <form action="{{ route('admin.logs.restore', $log->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Restore</button>
            </form>
            @else
            <p>No data available to restore.</p>
            @endif
        </div>
    </div>
    @endif

    @if(isset($details) && !empty($details))
    <h5 class="mt-3">Details:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
            <tr>
                <td>Nama Barang</td>
                <td>{{ $detail['namaBarang'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Jumlah Barang</td>
                <td>{{ $detail['jumlahBarang'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td>{{ $detail['kodeBarang'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Keterangan Barang</td>
                <td>{{ $detail['keteranganBarang'] ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No details available.</p>
    @endif
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Create and display loading spinner
        const loader = document.createElement('div');
        loader.className = 'spinner-border text-primary';
        loader.style.position = 'fixed';
        loader.style.top = '50%';
        loader.style.left = '50%';
        loader.style.transform = 'translate(-50%, -50%)';
        loader.style.zIndex = '1000';
        loader.style.display = 'none'; // Initially hidden
        document.body.appendChild(loader);

        // Show loading spinner while content is loading
        loader.style.display = 'block';
        
        window.addEventListener('load', () => {
            loader.style.display = 'none';
        });

        // Fade-in animation
        const logDetails = document.getElementById('log-details');
        logDetails.style.opacity = 0;
        logDetails.style.transition = 'opacity 1s';
        logDetails.style.opacity = 1;
    });
</script>
@endsection
@endsection
