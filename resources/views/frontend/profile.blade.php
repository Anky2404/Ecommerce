@php
    $total = 0;
    $shipping_charge = 25;
@endphp

<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Customer Profile</h1>
        </div>
    </section>


    <section class="checkout">
        <div class="container-wrap">
            <div class="row-wrap" id="user-info">
                <div class="checkout-form">
                    <div class="user-information">
                        <div class="user-profile">
                            <div class="user-img">
                                <img src="{{ asset('uploads/user_img/' . $customer->details->first()->profile_img) }}"
                                    alt="{{ $customer->details->first() }}">
                                <strong>{{ $customer->firstname . ' ' . $customer->lastname }}</strong>
                            </div>
                            <div class="user-details">
                                <ul>

                                    <li><strong>Email: </strong> <span>{{ $customer->email }}</span></li>
                                    <li><strong>Phone: </strong> <span>{{ $customer->phone }}</span></li>
                                    <li><strong>Date Of Birth: </strong>
                                        <span>{{ \Carbon\Carbon::parse($customer->dob)->format('j M Y') }}</span></li>
                                    <li><strong>Gender: </strong> <span>{{ $customer->details->first()->gender }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="loyal-points">
                            <ul>
                                <li><strong>Loyalty Points: </strong><span>{{ $totalPoints }}</span></li>
                                <li><strong> Referals: </strong><span>{{ $totalReferrals }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="user-update">
                    <div class="login" id="update">
                        <div class="login-form">
                            <h3 style="text-align: center">Update Profile</h3>
                            <form method="POST" action="{{ route('user.update-profile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="input-wrap">
                                    <label for="Email">Upload Image</label>
                                    <input type="file" placeholder="upload Image" name="profile_img">
                                </div>
                                <div class="input-wrap">
                                    <label for="email">Email</label>
                                    <input type="text" placeholder="Enter Your Email..." name="email" value="{{ $customer->email}}">
                                </div>
                                <div class="input-wrap">
                                    <label for="phone">Phone</label>
                                    <input type="text" placeholder="Ente Your Contact..." name="phone" value="{{$customer->phone}}">
                                </div>
                                <div class="input-wrap">
                                    <label for="gender">Gender</label>
                                    <select name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" @if($customer->details->first()->gender == 'Male') selected @endif>Male</option>
                                        <option value="Female" @if($customer->details->first()->gender == 'Female') selected @endif>Female</option>
                                    </select>
                                </div>
                               
                                <input type="hidden" name="customer_id" value="{{$customer->id}}" placeholder="password">
                                <button type="submit" class="btns">Update</button>

                            </form>
                        </div>
                    </div>
                </div>



            </div>

        </div>
        </div>
    </section>
    @include('frontend.partials.footer')
</body>

</html>
