<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Order History') }}
            </h2>


            <a href="{{ route('index') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                🏠 Home
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-800 shadow-lg sm:rounded-lg p-6">

                <h3 class="text-2xl font-bold text-white mb-6 border-b border-gray-700 pb-2 text-center">
                    Your Orders
                </h3>

                @if(session('order_message'))
                    <div class="mb-4 p-3 bg-green-600 text-white rounded shadow text-center">
                        {{ session('order_message') }}
                    </div>
                @endif

                @if($orders->isEmpty())
                    <p class="text-center text-gray-300 py-6 text-lg">You have no order history yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-white border border-gray-600 text-sm text-center">
                            <thead class="bg-gray-700 text-white uppercase text-sm tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Product</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Ordered On</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                                @foreach($orders as $index => $order)
                                    <tr class="hover:bg-gray-700 transition">
                                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3">{{ $order->product->product_title ?? 'Deleted Product' }}</td>
                                        <td class="px-4 py-3">${{ number_format($order->product->product_prices ?? 0, 2) }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                @if($order->status == 'pending') bg-yellow-400 text-gray-900
                                                @elseif($order->status == 'approved') bg-green-500 text-white
                                                @elseif($order->status == 'shipped') bg-blue-500 text-white
                                                @elseif($order->status == 'cancelled') bg-red-500 text-white
                                                @endif
                                            ">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $order->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
