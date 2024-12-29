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
                            <td data-column="Twitter " class="list-btns">
                                <a href="# " class="edit ">Confirmed</a>
                                <a href="# " class="del ">Canceled</a>
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