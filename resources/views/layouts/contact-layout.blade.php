<!-- resources/views/layouts/contact_layout.blade.php -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us - Giftos</title>

  <!-- CSS -->
  <link rel="stylesheet" href="front_end/css/bootstrap.css" />
  <link rel="stylesheet" href="front_end/css/style.css" />
  <link rel="stylesheet" href="front_end/css/responsive.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
</head>
<body>

    <!-- resources/views/layouts/main_nav.blade.php -->
<header class="header_section">
  <nav class="navbar navbar-expand-lg custom_nav-container">
    <a class="navbar-brand" href="{{ auth()->check() ? route('dashboard') : route('index') }}">
      <span>Giftos</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
        </li>
      </ul>

      <div class="user_option">
        @if(Auth::check())
          <a href="{{ route('dashboard') }}">
              <i class="fa fa-user"></i>
              <span>{{ Auth::user()->user_type === 'admin' ? 'Admin Dashboard' : 'Dashboard' }}</span>
          </a>
        @else
          <a href="{{ route('login') }}">
              <i class="fa fa-user"></i>
              <span>Login</span>
          </a>
          <a href="{{ route('register') }}">
              <i class="fa fa-user"></i>
              <span>Sign Up</span>
          </a>
        @endif

        <a href="{{ route('cartproducts') }}">
            <i class="fa fa-shopping-bag">{{ $count ?? 0 }}</i>
        </a>

        <form class="form-inline">
            <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
      </div>
    </div>
  </nav>
</header>

  <!-- Page Content -->
  <main>
      @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer_section">
      <div class="container">
        <p>&copy; {{ date('Y') }} Giftos. All Rights Reserved</p>
      </div>
  </footer>

  <!-- JS -->
  <script src="front_end/js/jquery-3.4.1.min.js"></script>
  <script src="front_end/js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="front_end/js/custom.js"></script>
</body>
</html>
