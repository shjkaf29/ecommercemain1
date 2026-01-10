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
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('index') }}">Home </span></a>
            </li><li class="nav-item ">
              <a class="nav-link" href="{{ route('frontend.shop') }}">Shop </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('frontend.contact') }}">Contact Us</a>
            </li>
          </ul>

          <div class="user_option">
            @if(Auth::check())
              <a href="{{ route('dashboard') }}">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>{{ Auth::user()->user_type === 'admin' ? 'Admin Dashboard' : 'Dashboard' }}</span>
              </a>
            @else
              <a href="{{ route('login') }}">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>Login</span>
              </a>
              <a href="{{ route('register') }}">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>Sign Up</span>
              </a>
            @endif

            <a href="{{ route('cartproducts') }}">
                <i class="fa fa-shopping-bag" aria-hidden="true">{{ $count ?? 0 }}</i>
            </a>

            <form class="form-inline">
                <button class="btn nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
          </div>
        </div>
      </nav>
    </header>