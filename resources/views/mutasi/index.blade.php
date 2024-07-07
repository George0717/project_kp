@extends('layouts.main')

@section('title', 'Daftar Mutasi')
@section('page1', 'Daftar Mutasi')

@section('container')
<a href="{{ route('mutasi.create') }}" class="btn btn-primary mb-3">Tambah Mutasi</a>
<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>Divisi Pengirim</th>
            <th>Penanggung Jawab</th>
            <th>Dibuat Oleh</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mutasis as $mutasi)
        <tr>
            <td>{{ $mutasi->divisi_pengirim }}</td>
            <td>{{ $mutasi->penanggung_jawab }}</td>
            <td>{{ $mutasi->dibuat_oleh }}</td>
            <td>{{ $mutasi->lokasi }}</td>
            <td>
                <a href="{{ route('mutasi.show', $mutasi) }}" class="btn btn-info btn-sm">Detail</a>
                <button class="btn btn-warning btn-sm edit-button" data-id="{{ $mutasi->id }}">Edit</button>
                <button class="btn btn-danger btn-sm delete-button" data-id="{{ $mutasi->id }}">Hapus</button>
                <form action="{{ route('mutasi.destroy', $mutasi) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm" style="display: none;">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
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

        $('.delete-button').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var form = $(this).next('form');
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
    });
</script>
@endpush