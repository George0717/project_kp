@extends('layouts.main')
@section('container')
{{-- awal foreach --}}
<div class="container" style="margin-top:50px;">
  <div class="col-md-4">
    <a href="{{ route('suratJalan.create')  }}"><button class="btn btn-info col-lg-5 m-2 btn-flat">Tambah Data</button>
    </a>
  </div>
  {{-- Akhir Modal --}}
  <div class="row">
    @foreach($surat_jalans as $item )
    <div class="col-lg-3">
      <div class="card card-sl" style="box-shadow: 1px 3px 3px 1px">
        <div class="card-title text-center">
          <h4>{{ $item->nomorSurat }}</h4>
          <hr style="border: 1px solid black">
        </div>
        <div class="card-text" id="formattedDate">
          <h6 class="card-subtitle text-body-secondary text-right" id="formattedDate">{{ $item->tglKirim }}</h6>
        </div>
        <div class="card-text m-1">
          Lokasi {{ $item->tujuanTempat }}
        </div>
        <hr style="border: 1px solid black">
        <div class="d-flex justify-content-between align-items-center m-3">
          <a href="{{ route('suratJalan.edit' , $item->id)  }}"><button
              class="btn btn-success col btn-flat">Edit</button>
          </a>
          <form method="POST" class="delete-form" action="{{ route('suratJalan.destroy', $item->id) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger show_confirm col mt-2 " data-toggle="tooltip"
              title='Delete'>Delete</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
{{-- Akhir foreach --}}
@endsection
@section('title', 'Surat Jalan')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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