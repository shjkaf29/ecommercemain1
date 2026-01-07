@extends('maindesign')

@section('viewCart_products')
<div style="max-width: 900px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

    <h2 style="text-align:center; margin-bottom: 25px; color:#333;">🛒 My Cart</h2>

    @php
        // Check if $cart is an array (guest) or collection (logged-in)
        $isEmpty = is_array($cart) ? empty($cart) : $cart->isEmpty();
        $price = 0;
    @endphp

    @if ($isEmpty)
        <div style="text-align: center; color: #777; padding: 40px 0;">
            <p>No products found in your cart.</p>
            <a href="{{ route('index') }}" style="display:inline-block; margin-top:10px; padding:10px 20px; background:#007bff; color:#fff; text-decoration:none; border-radius:5px;">
                Browse Products
            </a>
        </div>
    @else
        <form action="{{ route('confirm_order') }}" method="POST">
            @csrf

            <!-- Receiver Info -->
            <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                <input type="text" name="receiver_address" placeholder="Enter your address" required
                    style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <input type="text" name="receiver_number" placeholder="Enter your phone number" required
                    style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <!-- Cart Table -->
            <table width="100%" cellpadding="12" cellspacing="0" style="border-collapse: collapse; width:100%;">
                <thead>
                    <tr style="background-color: #007bff; color: white; text-align:left;">
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $cart_product)
                        @php
                            // Calculate total price
                            if(is_array($cart_product)) {
                                $price += $cart_product['product_price'] * $cart_product['quantity'];
                            } else {
                                $price += $cart_product->product->product_prices;
                            }
                        @endphp
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;">
                                {{ is_array($cart_product) ? $cart_product['product_title'] : $cart_product->product->product_title }}
                            </td>
                            <td style="padding: 10px;">
                                ${{ is_array($cart_product) ? number_format($cart_product['product_price'], 2) : number_format($cart_product->product->product_prices, 2) }}
                            </td>
                            <td style="padding: 10px;">
                                {{ is_array($cart_product) ? 'N/A' : $cart_product->product->product_category }}
                            </td>
                            <td style="padding: 10px;">
                                @if(is_array($cart_product))
                                    <a href="{{ url('/removecartproducts/'.$cart_product['product_id']) }}"
                                       onclick="return confirm('Remove this item?')"
                                       style="background-color:red; color:white; padding:6px 12px; border-radius:5px; text-decoration:none;">
                                       Remove
                                    </a>
                                @else
                                    <a href="{{ route('removecartproducts', $cart_product->id) }}"
                                       onclick="return confirm('Remove this item?')"
                                       style="background-color:red; color:white; padding:6px 12px; border-radius:5px; text-decoration:none;">
                                       Remove
                                    </a>
                                @endif
                            </td>
                        </tr>

                        <!-- Hidden fields for order -->
                        <input type="hidden" name="product_ids[]" value="{{ is_array($cart_product) ? $cart_product['product_id'] : $cart_product->product->id }}">
                        <input type="hidden" name="quantities[]" value="{{ is_array($cart_product) ? $cart_product['quantity'] : 1 }}">
                    @endforeach
                </tbody>
            </table>

            <!-- Total & Confirm -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px;">
                <div style="font-size: 18px; font-weight: bold; color:#333;">
                    Total Price: <span style="color: #007bff;">${{ number_format($price, 2) }}</span>
                    <input type="hidden" name="total_price" value="{{ $price }}">
                </div>

                <button type="submit"
                        style="background-color: #28a745; color: white; border: none; padding: 10px 20px;
                               border-radius: 5px; cursor: pointer; font-size: 16px;">
                    ✅ Confirm Order
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
