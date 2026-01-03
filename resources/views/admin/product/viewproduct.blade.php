@extends('admin.layouts.maindesign')

@section('view_product')

@if (session('deleteproduct_message'))

<div>
    {{ session('deleteproduct_message') }}
</div>
    
@endif

<h3>All Categories</h3>
        <table border="1" width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
            <thead style="background-color: #f4f4f4;">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_title }}</td>
                        <td>{{ $product->product_prices }}</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>{{ $product->product_category }}</td>
                        <td>
                        <form action="{{ route('admin.deleteproduct',$product->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')


                                
                                <button type="submit" style="color: red;">Delete</button>
                            </form>

                            <a href="{{ route('admin.updateproduct',$product->id) }}" style="color: blue;">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No Product found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection