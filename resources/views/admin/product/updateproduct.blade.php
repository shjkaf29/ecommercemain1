@extends('admin.layouts.maindesign')

@section('update_product')
    @if (session('product_message'))
        <div class="alert alert-success mt-3">
            {{ session('product_message') }}
        </div>
    @endif

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Update Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.postupdateproduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="product_title" class="form-label">Product Name</label>
                        <input type="text" id="product_title" name="product_title" 
                               class="form-control" value="{{ $product->product_title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea id="product_description" name="product_description" 
                                  class="form-control" rows="5" required>{{ $product->product_description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="product_prices" class="form-label">Product Price</label>
                        <input type="number" id="product_prices" name="product_prices" 
                               class="form-control" value="{{ $product->product_prices }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_quantity" class="form-label">Product Quantity</label>
                        <input type="number" id="product_quantity" name="product_quantity" 
                               class="form-control" value="{{ $product->product_quantity }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_category" class="form-label">Product Category</label>
                        <select id="product_category" name="product_category" class="form-select" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ $product->product_category == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image</label><br>
                        @if ($product->product_image)
                            <img src="{{ asset('product_images/' . $product->product_image) }}" 
                                 alt="Product Image" width="100" class="mb-2 rounded">
                        @endif
                        <input type="file" id="product_image" name="product_image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
