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
            <h1>Order List</h1>
        </div>
</section>


    <section class="checkout">
        <div class="container-wrap">
            <div class="row-wrap">
                <div class="checkout-form" id="order-list">
                    <div class="order-listing">
                    @foreach($orders as $order)
                        <div class="col4">
                            <div class="order-boxes">
                                <div class="order-head">
                                <ul >
                                    <li><strong> Order No   </strong> <span> {{'#ORD_000'.$order->id}}</span></li>
                                    <li><strong> Order Date </strong> <span>{{ \Carbon\Carbon::parse($order->order_date)->format('j M Y') }}</span></li>
                                    
                                </ul>
                                </div>
                                <div class="order-main">

                             
                                <div class="order-status">
                                    <ul>

                                        <li><strong> Order Status :</strong><span>{{$order->order_status}}</span></li>
                                        <li><strong> Order Amount :</strong><span>£{{$order->net_amount}}</span></li>
                                    </ul>
                                </div>
                                <div class="order-btns">
                                    <button class="btns" id="edit">Order</button>
                                    <a class="btns" href="{{route('user.order-details',['order_id' => base64_encode($order->id)])}}">Order Details</a>

                                    <button class="btns" id="del">Cancel</button>
                                </div>
                                </div>

                            </div>
                        </div>
                       
                        @endforeach
                        
                    </div>
                 
                    



                </div>

            </div>
        </div>
    </section>
    @include('frontend.partials.footer')
</body>

</html>