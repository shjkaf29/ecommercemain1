@extends('admin.layouts.maindesign')

@section('add_product')
    @if (session('product_message'))
        <div class="alert alert-success mt-3">
            {{ session('product_message') }}
        </div>
    @endif

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Add New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.postaddproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="product_title" class="form-label">Product Name</label>
                        <input type="text" id="product_title" name="product_title" 
                               class="form-control" placeholder="Enter the product name" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea id="product_description" name="product_description" 
                                  class="form-control" rows="5" placeholder="Enter product description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="product_prices" class="form-label">Product Price</label>
                        <input type="number" id="product_prices" name="product_prices" 
                               class="form-control" placeholder="Enter product price" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_quantity" class="form-label">Product Quantity</label>
                        <input type="number" id="product_quantity" name="product_quantity" 
                               class="form-control" placeholder="Enter product quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="product_category" class="form-label">Product Category</label>
                        <select id="product_category" name="product_category" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" id="product_image" name="product_image" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
