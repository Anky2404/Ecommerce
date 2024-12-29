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
                                 <a href="# " class="edit ">Comfirmed</a>
                                 <a href="# " class="del ">Cancelled</a>
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

    
</body>

</html>