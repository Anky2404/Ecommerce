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
                    <h3>Discount Lists</h3>
                    <a href="{{route('admin.add-discount-page')}}" id="new-btns">Add New Discount</a></div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id=1;
                        @endphp
                        @foreach ($discounts as $discount)
                        <tr>
                            <td>{{$id++}}</td>
                           <td>{{$discount->code}}</td>
                           <td>{{$discount->type}}</td>
                           <td>{{ \Carbon\Carbon::parse($discount->start_date)->format('j M Y') }}</td>
                           <td>{{ \Carbon\Carbon::parse($discount->end_date)->format('j M Y') }}</td>
                           <td>{{$discount->status}}</td>
                            <td data-column="Twitter " class="list-btns">
                               
                                <a href="{{route('admin.edit-discount-page',['id'=> base64_encode($discount->id)])}}" class="edit ">Edit</a>
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