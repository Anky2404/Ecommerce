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
                    <h3>Loyalty Point Lists</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Customer Name</th>
                            <th>Order ID</th>
                            <th>Points</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($loyaltyPoints as $point)
                            <tr>
                                <td>{{ $id++ }}</td>
                                <td>{{ $point->customers->firstname . ' ' . $point->customers->lastname }}</td>
                                <td>{{ 'ORD_000' . $point->purchase_id }}</td>
                                <td>{{ $point->points . ' Points' }}</td>
                                <td>{{ $point->type }}</td>
                                <td>{{ \Carbon\Carbon::parse($point->created_at)->format('j M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>


</body>

</html>
