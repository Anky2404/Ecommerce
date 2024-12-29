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
                                <a href="# " class="edit ">Confirm</a>
                                <a href="# " class="del ">Cancel</a>
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
</body>

</html>