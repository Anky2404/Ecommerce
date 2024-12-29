<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Register</h1>
        </div>
</section>

    <section class="login register" id="register-page">  
        <div class="container-wrap">

            <div class="login-form">
                <form method="POST" action="{{route('user.register')}}">
                    @csrf
                    <div class="input-group">
                        <div class="input-wrap">
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname" placeholder="Enter Firstname" required>
                        </div>
                        <div class="input-wrap">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname" placeholder="Enter Lastname" required>
                        </div>
                    </div>
                
                    <div class="input-group">
                        <div class="input-wrap">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="input-wrap">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter Phone" required>
                        </div>
                    </div>
                
                    <div class="input-group">
                        <div class="input-wrap">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                        <div class="input-wrap">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                    </div>
                
                    <button type="submit" class="btns">Register</button>
                    <a class="btn" href="{{route('user.login-page')}}">Login</a>
                </form>
            </div>
        </div>

    </section>
    @include('frontend.partials.footer')
</body>

</html>