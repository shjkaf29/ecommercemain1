@extends('maindesign')
@section('index')
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{ route('product_details', $product->id) }}">
              <div class="img-box">
                <img 
                src="{{ asset('product_images/' . $product->product_image) }}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  {{ $product->product_title }}
                </h6>
                <h6>
                  Price
                  <span>
                    ${{ $product->product_prices }} 
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div>
    </div>
  @endsection