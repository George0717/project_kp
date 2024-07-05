<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Home')</title>
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <link id="pagestyle" href="{{ asset('assets/assets/css/material-dashboard.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="icon" href="{{ asset('assets/image/JM.png') }}" type="image">
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

  /* Card Slick */
  .history-slider {
    width: 100%;
    overflow: hidden;
    margin-top: 20px;
  }

  .history-card {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 10px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 200px;
  }

  .history-card h3 {
    font-size: 1.2em;
    margin-bottom: 10px;
    text-align: center;
  }

  .history-card p {
    font-size: 0.9em;
    line-height: 1.2;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }

  .history-card small {
    font-size: 0.8em;
    color: #888;
  }

  .history-card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
  }

  /* Gaya untuk slick slider */
  .slick-slider {
    width: 100%;
    overflow: hidden;
  }

  .slick-slide {
    padding: 0 10px;
  }

  .slick-arrow {
    background-color: #ddd;
    border-radius: 50%;
    padding: 10px;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000;
  }

  .slick-prev {
    left: 0;
  }

  .slick-next {
    right: 0;
  }

  /* End Card Slick */
</style>

<body>
  @include('partials.navbar')
  <div class="container">
    @yield('container')
    @yield('page1')
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.history-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              infinite: true,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
            }
          }
        ]
      });
    });
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('scripts')


</body>

</html>