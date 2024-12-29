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
            <h1>User Profile</h1>
        </div>
</section>


    <section class="checkout">
        <div class="container-wrap" >
            <div class="row-wrap" id="user-info">
                <div class="checkout-form">
                    <div class="user-information">
                    <div class="user-profile">
                        <div class="user-img">
                            <img src="{{ asset('uploads/user_img/'.$customer->details->first()->profile_img) }}" alt="{{$customer->details->first()}}">
                            <strong>{{$customer->firstname.' '.$customer->lastname}}</strong>
                        </div>
                        <div class="user-details">
                            <ul>
                                
                                <li><strong>Email: </strong> <span>{{$customer->email}}</span></li>
                                <li><strong>Phone: </strong> <span>{{$customer->phone}}</span></li>
                                <li><strong>Date Of Birth: </strong> <span>{{ \Carbon\Carbon::parse($customer->dob)->format('j M Y') }}</span></li>
                                <li><strong>Gender: </strong> <span>{{$customer->details->first()->gender}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="loyal-points">
                        <ul>
                            <li><strong>Loyalty Points: </strong><span>25</span></li>
                            <li><strong> Referals: </strong><span>1</span></li>
                        </ul>
                    </div>
                    </div>
</div>
                    <div class="user-update" >
                        <div class="login" id="update">
                    <div class="login-form">
                    <form>
                    <div class="input-wrap">
                        <label for="Email">Upload Image</label>
                        <input type="file" placeholder="upload Image">
                    </div>
                    <div class="input-wrap">
                        <label for="dob">Date Of Birth</label>
                        <input type="text" placeholder="D O B">
                    </div>
                    <div class="input-wrap">
                        <label for="dob">Gender</label>
                        <select name="" id="">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <Option value="Female">Female</Option>
                        </select>
                    </div>
                    <div class="input-wrap">
                        <label for="dob">Password</label>
                        <input type="password" placeholder="password">
                    </div>
                    <button class="btns">Update</button>

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