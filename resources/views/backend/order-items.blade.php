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
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Status</th>
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
                            <td>{{ $orderItem->order_id }}</td>
                            <td>{{ $orderItem->products->product_name }}</td>
                            <td>£{{ $orderItem->unit_price }}</td>
                            <td>{{ $orderItem->quantity }}</td>
                            <td>£{{ $orderItem->total_amount }}</td>
                            <td>{{ $orderItem->status }}</td>
                            <td data-column="Twitter" class="list-btns">
                                @if ($orderItem->status=='Placed')
                                <a href="#" onclick="confirmOrder('Confirmed', {{$orderItem->id}})" class="edit">Confirmed</a>                
                                <a href="#" onclick="confirmOrder('Cancelled', {{$orderItem->id}})" class="del">Cancelled</a>
                                @endif
                            
                            </td>                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>

        </div>

    </div>
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