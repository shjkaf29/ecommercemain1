<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ __('Dashboard') }}
            </h2>

            <!-- Frontend Home Button -->
            <a href="{{ route('index') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md
                      hover:bg-blue-700 transition">
                🏠 Go to Homepage
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Greeting -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('order_message'))
                        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
                            {{ session('order_message') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-4">Your Orders</h3>

                    <table class="min-w-full border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">Order ID</th>
                                <th class="px-4 py-2 border">Product</th>
                                <th class="px-4 py-2 border">Price</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Ordered On</th>
                                <th class="px-4 py-2 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($orders as $order)
                            <tr class="text-center border-t border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-2">{{ $order->id }}</td>
                                <td class="px-4 py-2">
                                    {{ $order->product->product_title ?? 'Deleted Product' }}
                                </td>
                                <td class="px-4 py-2">
                                    ${{ number_format($order->product->product_prices ?? 0, 2) }}
                                </td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded
                                        @if($order->status == 'pending') bg-yellow-200 text-yellow-800
                                        @elseif($order->status == 'approved') bg-green-200 text-green-800
                                        @elseif($order->status == 'shipped') bg-blue-200 text-blue-800
                                        @elseif($order->status == 'cancelled') bg-red-200 text-red-800
                                        @endif
                                    ">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-2">
                                    @if($order->status == 'pending')
                                        <a href="{{ route('user.cancelorder', $order->id) }}"
                                           class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            Cancel
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
