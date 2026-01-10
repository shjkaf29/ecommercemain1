@extends('admin.layouts.maindesign')
@section('panel')

<div class="container-fluid">
    <div class="row">
        <!-- Total Users -->
        <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                        <div class="icon"><i class="icon-user-1"></i></div><strong>Total Users</strong>
                    </div>
                    <div class="number dashtext-1">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                        <div class="icon"><i class="icon-contract"></i></div><strong>Total Products</strong>
                    </div>
                    <div class="number dashtext-2">{{ $totalProducts }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
