@extends('admin.layouts.maindesign')

@section('view_orders')

@if (session('order_message'))
    <div class="alert alert-success mt-3">
        {{ session('order_message') }}
    </div>
@endif

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Orders</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Receiver Address</th>
                        <th>Receiver Phone</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $index => $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>{{ $order->receiver_address }}</td>
                            <td>{{ $order->receiver_phone }}</td>
                            <td>{{ $order->product->product_title ?? 'Deleted Product' }}</td>
                            <td>${{ number_format($order->product->product_prices ?? 0, 2) }}</td>
                            <td>
                                @php
                                    $badgeClass = match($order->status) {
                                        'approved' => 'bg-success',
                                        'cancelled' => 'bg-danger',
                                        'shipped' => 'bg-info',
                                        default => 'bg-warning text-dark'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td class="d-flex flex-column gap-2">
                                <!-- Update Status Form -->
                                <form action="{{ route('admin.orders.updateorderstatus', $order->id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </form>

                                <!-- Delete Order Form -->
                                <form action="{{ route('admin.deleteorder', $order->id) }}" method="POST" onsubmit="return confirm('Delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
