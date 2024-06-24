@extends('layouts.main')
@section('container')
{{-- awal foreach --}}
<div class="container" style="margin-top:50px;">
  {{-- Button add --}}
  {{-- Akhir Button add --}}
  {{-- Modal --}}

<!-- Modal -->
<div class="col-md-4">
  <a href="{{ route('mutasi.create')  }}"><button
    class="btn btn-info col-lg-5 m-2 btn-flat">Tambah Data</button> 
  </a>
</div>
{{-- Akhir Modal --}}
    @foreach($mutasis as $item )
    <div class="col-lg-3">
      {{-- Menampilkan hasil --}}
      <div class="card card-frame">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              {{ $item->divisi_pengirim }}
              {{ $item->penanggung_jawab }}
              {{ $item->dibuat_oleh }}
            </div>
            <div class="col-md-6">
              {{ $item->lokasi }}
              {{ $item->divisi_tujuan }}
            </div>
          </div>
          {{-- Table --}}


          <div class="card">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Merk</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Model</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Inventaris</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->nama_barang }}</p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->merk }}</p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->model }}</p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->kategori }}</p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->no_inventaris }}</p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $item->keterangan }}</p>
                    </td>
                    
          {{-- Akhir table --}}
          
        </div>
      </div>
      {{-- Akhir Menampilkan hasil --}}
      <div class="card card-sl" style="box-shadow: 1px 3px 3px 1px">
        <hr>
        <a href="{{ route('suratJalan.edit' , $item->id)  }}"><button
            class="btn btn-success col-lg-4 m-2 btn-flat">Edit</button> 
          </a>
        <form method="POST" class="delete-form" action="{{ route('suratJalan.destroy', $item->id) }}">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger btn-flat show_confirm col-lg-5 m-2" data-toggle="tooltip"
            title='Delete'>Delete</button>
        </form>
      </div>
    </div>
    @endforeach
    
  </div>
</div>
{{-- Akhir foreach --}}
@endsection
@section('title', 'Mutasi')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
  $('.show_confirm').click(function(event) {
         var form =  $(this).closest("form");
         var name = $(this).data("name");
         event.preventDefault();
         swal({
             title: `Are you sure you want to delete this record?`,
             text: "If you delete this, it will be gone forever.",
             icon: "warning",
             buttons: true,
             dangerMode: true,
         })
         .then((willDelete) => {
           if (willDelete) {
             form.submit();
           }
         });
     });
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('tglKirim');
            const formattedDateDiv = document.getElementById('formattedDate');

            function formatDate(date) {
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                return date.toLocaleDateString('id-ID', options);
            }

            dateInput.addEventListener('change', function() {
                const dateValue = new Date(this.value);
                if (!isNaN(dateValue)) {
                    formattedDateDiv.textContent = formatDate(dateValue);
                } else {
                    formattedDateDiv.textContent = '';
                }
            });

            // Trigger change event if there's an initial value
            if (dateInput.value) {
                const initialDate = new Date(dateInput.value);
                if (!isNaN(initialDate)) {
                    formattedDateDiv.textContent = formatDate(initialDate);
                }
            }
        });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</script>
</body>

</html>