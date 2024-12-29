<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <h3>Dashboard</h3>
            <div class="dashboard-wrap">
                <div class="box-wrap">
                    <div class="game-box">
                        <div class="item">
                            <div class="gb-icons">
                                <i class="fa-solid fa-user"></i>
                                <h4>Total Customers</h4>
                            </div>

                            <span>{{ $customers->count() }}</span>
                        </div>

                    </div>
                    <div class="game-box">
                        <div class="item">
                            <div class="gb-icons">
                                <i class="fa-solid fa-users"></i>
                                <h4>Total Staffs</h4>
                            </div>
                            <span>{{ $staffs->count() }}</span>
                        </div>

                    </div>
                    <div class="game-box">


                        <div class="item">
                            <div class="gb-icons">
                                <i class="fa-solid fa-sitemap"></i>
                                <h4>Total Products</h4>
                            </div>
                            <span>{{ $products->count() }}</span>
                        </div>

                    </div>
                    <div class="game-box">


                        <div class="item">
                            <div class="gb-icons">
                                <i class="fa-solid fa-layer-group"></i>
                                <h4>Total Orders</h4>
                            </div>
                            <span>{{ $orders->count() }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <h3>Placed Orders</h3>
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
                    @if ($order->order_status=='Placed')
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $order->customer->firstname . ' ' . $order->customer->lastname }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('j M Y') }}</td>
                            <td>£{{ $order->net_amount }}</td>
                            <td>{{ $order->order_status }}</td>
                            <td>
                                <div class="all-btns">
                                    <a href="{{ route('admin.order-items', ['order_id' => base64_encode($order->id)]) }}"
                                        class="view ">View Details</a>
                                    <div class="more-btns">
                                        <a href="# " class="edit ">Comfirmed</a>
                                        <a href="# " class="del ">Cancelled</a>
                                    </div>
                                </div>

                            </td>

                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


</body>

</html>
