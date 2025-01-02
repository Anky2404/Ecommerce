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
            <div class="row-wrap" >
                <div class="checkout-form" id="order-table" >
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php
                           $id = 1;
                       @endphp
                          @foreach ($order_items as $orderItem)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{ 'ORD_000'.$orderItem->order_id }}</td>
                            <td>{{ $orderItem->products->product_name }}</td>
                            <td>£{{ $orderItem->unit_price }}</td>
                            <td>{{ $orderItem->quantity }}</td>
                            <td data-column="Twitter " class="list-btns">
                                @if ($orderItem->status=='Placed')
                                <a href="#" class="btns" onclick="confirmOrder('Confirmed', {{$orderItem->id}})" id="edit">Confirmed</a>                
                                <a href="#" class="btns" style="background-color: red" onclick="confirmOrder('Cancelled', {{$orderItem->id}})" id="del">Cancelled</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    



                </div>

            </div>
        </div>
    </section>
    @include('frontend.partials.footer')

    <script>
        function confirmOrder(action, itemId) {
            // Show the confirmation dialog 
            var message = (action === 'Confirmed') 
                ? 'Are you sure you want to confirm this order?'
                : 'Are you sure you want to cancel this order?';
    
            // If the user confirms the action
            if (confirm(message)) {
                // Send AJAX request to update status
                $.ajax({
                    url: "{{ route('order-item.updateStatus') }}", 
                    method: 'POST',
                    data: {
                        item_id: itemId,
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