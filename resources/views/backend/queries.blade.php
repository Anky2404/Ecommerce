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
                    <h3>Query Lists</h3></div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Sender Name</th>
                            <th>Sender Email</th>
                            <th>Sender Contact</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Sent At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id=1;
                        @endphp
                        @foreach ($queries as $query)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{$query->sender_name}}</td>
                            <td>{{$query->sender_email}}</td>
                            <td>{{$query->sender_contact}}</td>
                            <td>{{$query->subject}}</td>
                            <td>{{$query->message}}</td>
                            <td>{{ \Carbon\Carbon::parse($query->sent_at)->format('j M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>

        </div>

    </div>

    
</body>

</html>