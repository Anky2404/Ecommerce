@php
    $total=0;
    $shipping_charge=25;
@endphp

<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Checkout</h1>
        </div>
</section>


    <section class="checkout">
        <div class="container-wrap">
            <div class="row-wrap">
                <div class="checkout-form">
                    <h3>Billing details</h3>

                    <form>
                        <div class="input-wrap">
                            <div class="field">
                                <label>Name</label>
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="field">
                                <label>Phone</label>
                                <input type="text" placeholder="Phone">
                            </div>
                        </div>
                        <div class="field">
                            <label>Email</label>
                            <input type="text" placeholder="Email">
                        </div>
                        <div class="input-wrap">
                            <div class="field">
                                <label>Alternate Number</label>
                                <input type="text" placeholder="Phone">
                            </div>
                            <div class="field">
                                <label>Landmark</label>
                                <input type="text" placeholder="Landmark">
                            </div>
                        </div>

                        <div class="field">
                            <label>Street Address</label>
                            <input type="text" placeholder="Street Address">
                        </div>
                        <div class="field">
                            <label>City</label>
                            <input type="text" placeholder="City">
                        </div>
                        <div class="field">
                            <label>Pincode</label>
                            <input type="number" placeholder="Pincode">
                        </div>
                        <div class="field">
                            <label>State</label>
                            <input type="text" placeholder="State">
                        </div>

            
                    </form>
                </div>
                <div class="colright">
                    <div class="checkout-cart">
                        <h2>Your orders</h2>
                        <ul>
                            @foreach($cart_items as $item)
                            <li>
                                <h3>{{ $item->products->product_name }}</h3>
                                <h4>£<?php echo number_format($item->products->base_price* $item->quantity, 2); ?></h4>
                            </li> 
                            @php
                            $total +=$item->products->base_price* $item->quantity;
                        @endphp
                            @endforeach
                            <li>
                                <h3>Item Total </h3>
                                <h4>£<?php echo number_format($total, 2); ?></h4>
                            </li>

                            <li>
                                <h3>Delivery Fee</h3>
                                <h4>£<?php echo number_format($shipping_charge, 2); ?></h4>
                            </li>

                            <li>
                                <h3>Total</h3>
                                <h4><strong>£<?php echo number_format($shipping_charge+$total, 2); ?></strong></h4>
                            </li>
                        </ul>
                        <ul class="discount">
                        <h3>Discount</h3>
                                {{-- <li> <label><input type="checkbox">Direct bank transfer </label> </li>
                                <li> <label><input type="checkbox">Check payments </label> </li>
                                <li> <label><input type="checkbox">Cash on delivery </label> </li> --}}
                        </ul>


                        <button class="btns">Confirm Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.footer')
</body>

</html>