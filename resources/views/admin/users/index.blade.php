@extends('layouts.admin')

@section('container')
<div class="container">
    <h1>Daftar Pengguna</h1>
    @if($users->isEmpty())
        <p>No users found.</p>
    @else
        <p>Found {{ $users->count() }} users.</p>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->active ? 'Aktif' : 'Tidak Aktif' }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $user->id }}">
                            <li><a class="dropdown-item edit-button" href="#" data-id="{{ $user->id }}">Edit</a></li>
                            <li><a class="dropdown-item delete-button" href="#" data-id="{{ $user->id }}">Hapus</a></li>
                        </ul>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form" style="display:none;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Animasi saat halaman dimuat
        $('.container').addClass('animate__animated animate__fadeIn');

        // Menangani klik pada tombol edit
        $('.edit-button').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = "{{ route('admin.users.edit', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Yakin ingin mengedit pengguna ini?',
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
            var form = $(this).closest('td').find('.delete-form');
            var url = "{{ route('admin.users.destroy', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Yakin ingin menghapus pengguna ini?',
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
