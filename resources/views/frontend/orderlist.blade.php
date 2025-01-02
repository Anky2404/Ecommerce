@php
    $total = 0;
    $shipping_charge = 25;
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
                        @foreach ($orders as $order)
                            <div class="col4">
                                <div class="order-boxes">
                                    <div class="order-head">
                                        <ul>
                                            <li><strong> Order No </strong> <span> {{ '#ORD_000' . $order->id }}</span>
                                            </li>
                                            <li><strong> Order Date </strong>
                                                <span>{{ \Carbon\Carbon::parse($order->order_date)->format('j M Y') }}</span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="order-main">


                                        <div class="order-status">
                                            <ul>

                                                <li><strong> Order Status
                                                        :</strong><span>{{ $order->order_status }}</span></li>
                                                <li><strong> Order Amount
                                                        :</strong><span>£{{ $order->net_amount }}</span></li>
                                            </ul>
                                        </div>
                                        <div class="order-btns">
                                            @if ($order->order_status=='Placed')
                                            <button onclick="confirmOrder('Confirmed', {{ $order->id }})"
                                                class="btns" id="edit">Confirm</button>  
                                            @endif
                                        
                                            <a class="btns"
                                                href="{{ route('user.order-details', ['order_id' => base64_encode($order->id)]) }}">Order  Details</a>
                                            
                                                @if ($order->order_status=='Placed')   
                                            <button onclick="confirmOrder('Cancelled', {{ $order->id }})"
                                                class="btns" id="del">Cancel</button>
                                                @endif

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

    <script>
        function confirmOrder(action, orderId) {
            // Show the confirmation dialog 
            var message = (action === 'Confirmed') ?
                'Are you sure you want to confirm this order?' :
                'Are you sure you want to cancel this order?';

            // If the user confirms the action
            if (confirm(message)) {
                // Send AJAX request to update status
                $.ajax({
                    url: "{{ route('order.updateStatus') }}",
                    method: 'POST',
                    data: {
                        order_id: orderId,
                        status: action,
                        // CSRF token for security
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Success response handler
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Error response handler
                        alert('An error occurred while updating the order status.');
                    }
                });
            }
        }
    </script>
</body>

</html>
