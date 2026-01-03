@extends('admin.layouts.maindesign')

@section('update_category')
    @if (session('category_message'))
        <div class="alert alert-success mt-3">
            {{ session('category_message') }}
        </div>
    @endif

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Update Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.postupdatecategory', $category->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" id="category" name="category"
                               value="{{ $category->category }}"
                               class="form-control"
                               placeholder="Enter category name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
