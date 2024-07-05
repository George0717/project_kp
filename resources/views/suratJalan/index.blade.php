@extends('layouts.main')
@section('title', 'Daftar Surat Jalan')
@section('page1', 'Daftar Surat Jalan')
@section('container')
<a href="{{ route('suratJalan.create') }}" class="btn btn-primary mb-3">Tambah Surat Jalan</a>
<table class="table table-striped text-center">
    <thead>
        <tr>
            <th>Nomor Surat</th>
            <th>Tanggal Kirim</th>
            <th>Tujuan Tempat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suratJalans as $suratJalan)
        <tr>
            <td>{{ $suratJalan->nomorSurat }}</td>
            <td>{{ $suratJalan->tglKirim }}</td>
            <td>{{ $suratJalan->tujuanTempat }}</td>
            <td>
                <a href="{{ route('suratJalan.show', $suratJalan) }}" class="btn btn-info">Lihat</a>
                <button class="btn btn-warning edit-button" data-id="{{ $suratJalan->id }}">Edit</button>
                <button class="btn btn-danger delete-button" data-id="{{ $suratJalan->id }}">Hapus</button>
                <form action="{{ route('suratJalan.destroy', $suratJalan) }}" method="post" class="delete-form"
                    style="display: none;">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
            var url = "{{ route('suratJalan.edit', ':id') }}";
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
            var form = $(this).closest('tr').find('.delete-form');
            var url = "{{ route('suratJalan.destroy', ':id') }}";
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