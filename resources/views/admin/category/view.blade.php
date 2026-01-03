@extends('admin.layouts.maindesign')

@section('view_category')

@if (session('deletecategory_message'))

<div>
    {{ session('deletecategory_message') }}
</div>
    
@endif

<h3>All Categories</h3>
        <table border="1" width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
            <thead style="background-color: #f4f4f4;">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->category }}</td>
                        <td>{{ $category->created_at->format('d M, Y') }}</td>
                        <td>
                        <form action="{{ route('admin.category.categorydelete', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: red;">Delete</button>
                            </form>

                            <a href="{{ route('admin.category.categoryupdate', $category->id) }}" style="color: blue;">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection