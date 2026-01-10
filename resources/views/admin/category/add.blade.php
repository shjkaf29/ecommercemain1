@extends('admin.layouts.maindesign')

@section('panel')
    <div class="container my-5">
        @if(session('category_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('category_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add New Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.postaddcategory') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" placeholder="Enter category name" required>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus-circle"></i> Add Category
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Custom card shadow */
        .card.shadow-sm {
            border-radius: 12px;
            transition: all 0.3s ease-in-out;
        }
        .card.shadow-sm:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        /* Input hover effect */
        input.form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }

        /* Submit button styling */
        button.btn-success {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }
    </style>

    <script>
        // Bootstrap 5 form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
