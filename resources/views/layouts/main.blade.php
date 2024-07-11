<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Home')</title>
  <link rel="stylesheet" type="text/css"href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css"href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <link id="pagestyle" href="{{ asset('assets/assets/css/material-dashboard.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
  <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="icon" href="{{ asset('assets/image/JM.png') }}" type="image">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<style>
  .formatted-date {
    margin-top: 10px;
    font-weight: bold;
  }

  .tombol {
    /* Tambahkan styling tombol di sini */
    padding-left: 320px;
    padding-right: 320px;
    font-size: 16px;
  }

  .table-wrapper {
    width: 100%;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
  }

  .action-buttons {
        display: none;
        white-space: nowrap;
    }
    #myTable tr.selected .action-buttons {
        display: inline-block;
    }
  .table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
    display: block;
  }

  .table thead,
  .table tbody {
    display: table;
    width: 100%;
    table-layout: fixed;
  }

  .table thead {
    width: calc(100% - 1em);
  }

  .table tbody {
    height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
    display: block;
  }

  .table tbody tr {
    display: table;
    table-layout: fixed;
    width: 100%;
  }

  .table th,
  .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
  }

  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
  }  

  .animated {
        animation-duration: 10s;
        animation-fill-mode: both;
    }
</style>

<body>
  @include('partials.navbar')
  <div class="container">
    @yield('container')
    @yield('page1')
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('scripts')


</body>

</html>