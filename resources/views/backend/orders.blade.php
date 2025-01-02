<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <div class="wrap">
                <div class="title">
                    <h3>Order Lists</h3></div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Order Amount</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;    
                        @endphp
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{ $order->customer->firstname.' '.$order->customer->lastname }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('j M Y') }}</td>
                            <td>£{{$order->net_amount}}</td>
                            <td>{{$order->order_status}}</td>
                            <td>
                                <div class="all-btns">
                                <a href="{{route('admin.order-items',['order_id' => base64_encode($order->id)])}}" class="view ">View Details</a>
                                 <div class="more-btns">
                                    @if ($order->order_status=="Placed")
                                     
                                    <a href="#" onclick="confirmOrder('Confirmed', {{$order->id}})" class="edit">Confirmed</a>                
                                    <a href="#" onclick="confirmOrder('Cancelled', {{$order->id}})" class="del">Cancelled</a>
                                 @endif
                               </div>
                                </div>

                            </td>        

                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>

        </div>

    </div>

    <script>
        function confirmOrder(action, orderId) {
            // Show the confirmation dialog 
            var message = (action === 'Confirmed') 
                ? 'Are you sure you want to confirm this order?'
                : 'Are you sure you want to cancel this order?';
    
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