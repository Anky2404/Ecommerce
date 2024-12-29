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
                    <h3>Payment Lists</h3></div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Paid Amount</th>
                            <th>Payment Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id=1;
                        @endphp
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{'ORD_000'.$payment->order_id}}</td>
                            <td>{{$payment->order->Customer->firstname.' '.$payment->order->Customer->lastname}}</td>
                            <td>£ {{$payment->payment_amount}}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('j M Y') }}</td>
                            <td>{{$payment->payment_status}}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
               
            </div>

        </div>

    </div>

    
</body>

</html>