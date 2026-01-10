<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dark Bootstrap Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
  <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
</head>

<body>
  <!-- Header -->
  <header class="header">   
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">
          <a href="{{ route('dashboard') }}" class="navbar-brand">
            <div class="brand-text brand-big visible text-uppercase">
              <strong class="text-primary">Dark</strong><strong>Admin</strong>
            </div>
            <div class="brand-text brand-sm">
              <strong class="text-primary">D</strong><strong>A</strong>
            </div>
          </a>
          <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
        </div>

        <div class="right-menu list-inline no-margin-bottom">    
          <div class="list-inline-item">
            <a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a>
          </div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link">Log Out</button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation -->
    <nav id="sidebar">
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
          <img src="{{ asset('img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle">
        </div>
        <div class="title">
          <h1 class="h5">Admin</h1>
          <p>E-Commerce</p>
        </div>
      </div>

      <span class="heading">Main</span>
      <ul class="list-unstyled">
        <li class="active">
          <a href="{{ route('dashboard') }}"><i class="icon-home"></i>Dashboard</a>
        </li>
        <li>
          <a href="{{ route('admin.category.addcategory') }}"><i class="icon-grid"></i>Add Category</a>
        </li>
        <li>
          <a href="{{ route('admin.category.viewcategory') }}"><i class="icon-list"></i>View Categories</a>
        </li>
        <li>
          <a href="{{ route('admin.product.addproduct') }}"><i class="icon-plus"></i>Add Product</a>
        </li>
        <li>
          <a href="{{ route('admin.product.viewproduct') }}"><i class="icon-layers"></i>View Products</a>
        </li>
        <li>
          <a href="{{ route('admin.orders.vieworders') }}"><i class="icon-bag"></i>View Orders</a>
        </li>
        <li>
          <a href="{{ route('admin.users') }}"><i class="icon-user"></i>View Users</a>
        </li>
      </ul>
    </nav>
    <!-- Sidebar Navigation end -->

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
      </div>

      <section class="no-padding-top no-padding-bottom">
        {{-- @yield('dashboard')
        @yield('add_category')
        @yield('view_category')
        @yield('update_category')
        @yield('add_product')
        @yield('view_product')
        @yield('update_product')
        @yield('view_orders')
        @yield('view_users')
        @yield('edit_user') --}}
         @yield('panel')
      </section>

      <footer class="footer">
        <div class="footer__block block no-margin-bottom">
          <div class="container-fluid text-center">
            <p class="no-margin-bottom">
              &copy; 2025 Your Company. Template from 
              <a target="_blank" href="https://templateshub.net">Templates Hub</a>.
            </p>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- JavaScript files -->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
  <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('admin/js/charts-home.js') }}"></script>
  <script src="{{ asset('admin/js/front.js') }}"></script>
</body>
</html>
