<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product->product_title }} - Giftos</title>
  <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('front_end/css/responsive.css') }}">
  <link rel="shortcut icon" href="{{ asset('front_end/images/favicon.png') }}" type="image/x-icon">
  <style>
    .product-details {
      margin-top: 80px;
    }
    .product-image img {
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .product-info h2 {
      font-weight: 600;
    }
    .price {
      font-size: 22px;
      font-weight: 700;
      color: #e83e8c;
    }
    .btn-add-cart {
      background: #e83e8c;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 25px;
      font-weight: 500;
    }
    .btn-add-cart:hover {
      background: #d63384;
    }
  </style>
</head>
<body>

  {{-- @include('front_end.header') optional if you extracted your header to a partial --}}

  <div class="container product-details">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="product-image">
          <img src="{{ asset('product_images/' . $product->product_image) }}" alt="{{ $product->product_title }}">
        </div>
      </div>
      <div class="col-md-6">
        <div class="product-info">
          <h2>{{ $product->product_title }}</h2>
          <p class="price">${{ $product->product_prices }}</p>
          <p>{{ $product->product_description }}</p>
          <p><strong>Category:</strong> {{ $product->product_category }}</p>
          <p><strong>Available Quantity:</strong> {{ $product->product_quantity }}</p>

          <form action="{{ route('addtocart', $product->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
              <label for="quantity">Quantity:</label>
              <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->product_quantity }}" class="form-control w-25">
            </div>
            <button type="submit" class="btn-add-cart">Add to Cart</button>
          </form>

          <div class="mt-4">
            <a href="{{ route('index') }}" class="btn btn-outline-secondary">← Back to Shop</a>
          </div>
        </div>
      </div>
    </div>

    <hr class="my-5">

    <div class="related-products">
      <h4>Related Products</h4>
      <p>Coming soon...</p>
    </div>
  </div>

  <script src="{{ asset('front_end/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('front_end/js/bootstrap.js') }}"></script>
  <script src="{{ asset('front_end/js/custom.js') }}"></script>

</body>
</html>
