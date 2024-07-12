@extends('layouts.main')

@section('title', 'Daftar Mutasi')
@section('page1', 'Daftar Mutasi')

@section('container')
<a href="{{ route('mutasi.create') }}" class="btn btn-primary mb-3">Tambah Mutasi</a>

<!-- Filter Form -->
<form action="{{ route('mutasi.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="date" name="tgl_buat" class="form-control" placeholder="Tanggal Buat" value="{{ request('tgl_buat') }}">
        </div>
        <div class="col-md-4">
            <input type="text" name="tujuan_tempat" id="nama_barang" class="form-control" placeholder="Cari Nama Barang" value="{{ request('tujuan_tempat') }}">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('mutasi.index') }}" class="btn btn-secondary ml-2">Reset</a>
        </div>
    </div>
</form>

@if($mutasis->isEmpty())
    <div class="alert alert-warning text-center">
        Data tidak ditemukan
    </div>
@else
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>Tanggal Buat</th>
                <th>Penanggung Jawab</th>
                <th>Divisi Tujuan</th>
                <th>Nama Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($mutasis as $mutasi)
            <tr>
                <td>{{ \Carbon\Carbon::parse($mutasi->tgl_buat)->translatedFormat('d F Y') }}</td>
                <td>{{ $mutasi->penanggung_jawab }}</td>
                <td>{{ $mutasi->divisi_tujuan }}</td>
                <td>
                    @foreach ($mutasi->details as $detail)
                    {{ $detail->nama_barang }}<br>
                    @endforeach
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton{{ $mutasi->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $mutasi->id }}">
                            <li><a class="dropdown-item detail-button" href="{{ route('mutasi.show', $mutasi) }}">Detail</a></li>
                            <li><a class="dropdown-item edit-button" href="#" data-id="{{ $mutasi->id }}">Edit</a></li>
                            <li><a class="dropdown-item delete-button" href="#" data-id="{{ $mutasi->id }}">Hapus</a></li>
                        </ul>
                        <form action="{{ route('mutasi.destroy', $mutasi) }}" method="post" class="delete-form"
                            style="display: none;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Menangani klik pada tombol edit
        $('.edit-button').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = "{{ route('mutasi.edit', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Yakin ingin mengedit item ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Edit!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

        // Menangani klik pada tombol hapus
        $('.delete-button').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var form = $(this).closest('tr').find('.delete-form');
            var url = "{{ route('mutasi.destroy', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Yakin ingin menghapus item ini?',
                text: "Aksi ini tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.attr('action', url).submit();
                }
            });
        });

         // Menangani pencarian berdasarkan tujuan tempat
         $("#nama_barang").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endpush
