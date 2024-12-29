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
                    <h3>Referral Lists</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Referred By</th>
                            <th>Referred To</th>
                            <th>Code</th>
                            <th>Earned Rewards</th>
                            <th>Referred Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id=1;
                        @endphp
                        @foreach ($referrals as $list)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{$list->RefferBy->firstname.' '.$list->RefferBy->lastname}}</td>
                            <td>{{$list->RefferTo->firstname.' '.$list->RefferTo->lastname}}</td>
                            <td>{{$list->referral_code}}</td>
                            <td>£ {{$list->reward_earned}}</td>
                            <td>{{ \Carbon\Carbon::parse($list->referred_at)->format('j M Y') }}</td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>

        </div>

    </div>

    
</body>

</html>