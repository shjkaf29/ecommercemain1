<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>@yield('title', 'Giftos')</title>

  <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('front_end/css/responsive.css') }}" />
</head>

<body>

<div class="hero_area">

  <!-- Header -->
  @include('layouts.header')

  @hasSection('slider')
      @include('layouts.slider')
  @endif

</div>

<!-- Main Content -->
<section class="shop_section layout_padding">
    @yield('content')
</section>

<!-- Footer -->
@include('layouts.footer')

<!-- JS -->
<script src="{{ asset('front_end/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('front_end/js/bootstrap.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('front_end/js/custom.js') }}"></script>

</body>
</html>
