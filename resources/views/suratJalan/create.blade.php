@extends('layouts.main')
@section('container')
@section('title', 'Surat Jalan')
@section('page1','Surat Jalan')

<form action="{{ route('suratJalan.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <button type="button" class="btn bg-gradient-info btn-block col-3" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp">
        Tambah Data Barang
    </button>
    @extends('suratJalan.modal')
    <div class="table-wrapper">
        <table class="table table-striped table-bordered mb-4 text-center">
            <thead>
                <tr>
                    <th scope="col-lg-2">Nama Barang</th>
                    <th scope="col-lg-2">Jumlah Barang</th>
                    <th scope="col-3">Delete</th>
                </tr>
            </thead>
            <tbody class="scrollable-tbody">
                @foreach ($surat_jalans as $item)
                <tr id="row-{{ $item->id }}">
                    <td>{{ $item->namaBarang }}</td>
                    <td>{{ $item->jumlahBarang }}</td>
                    <td>
                        <button type="button" class="btn btn-danger delete-button col-6" data-id="{{ $item->id }}" data-toggle="tooltip" title="Delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Tujuan --}}
    <div class="tujuan">
        <h3 class="mt-2">Tujuan</h3>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" placeholder="Nomor Surat" id="nomorSurat" name="nomorSurat">
            @error('nomorSurat')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" placeholder="Lokasi" id="tujuanTempat" name="tujuanTempat">
        </div>
        <div class="input-group input-group-outline my-3">
            <label class="form-label mt-3" style="display: block"></label>
            <input type="date" class="form-control" id="tglKirim" name="tglKirim" class="form-control" placeholder="Tanggal Kirim" value="{{ old('tglKirim') }}">
        </div>
    </div>
    {{-- Akhir Tujuan --}}
    {{-- Data Mutasi --}}
    {{-- Akhir Data Mutasi --}}
    <div class="text-center tombol col-md-12">
        <button type="submit" class="btn bg-gradient-primary btn-lg w-100 mt-1 mb-0">Submit</button>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function(event) {
            event.preventDefault(); // Prevent the default form submission
            let id = $(this).data('id');
            let url = '{{ route("suratJalan.delete", ":id") }}';
            url = url.replace(':id', id);

            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response); // Log response for debugging
                        $('#row-' + id).remove();
                        alert('Item deleted successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log full error response
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            }
        });
    });
</script>


@endsection
