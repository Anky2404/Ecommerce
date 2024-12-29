<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Login</h1>
        </div>
</section>
    <section class="login">
        <div class="container-wrap">


            <div class="login-form">
                @if (session('success'))
                <div class="alert alert-success" id="status-message">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" id="status-message">
                    <ul>
                       
                        <li>{{ session('error') }}</li>
                    
                </ul>
                    
                </div>
            @endif

          
                <form method="POST" action="{{ route('user.login') }}">
                    @csrf
                    <div class="input">
                        <label for="email">Email</label>
                        <input type="text" placeholder="Enter your email address.." name="email" required>
                    </div>
                    <div class="input">
                        <label for="email">Password</label>
                        <input type="password" placeholder="Enter your password..." name="password" required>
                    </div>

                    <button type="submit" class="btns">Login</button>

                    <a class="btn" href="{{ route('user.register-page') }}">Register</a>



                </form>


            </div>
    </section>
   @include('frontend.partials.footer')
</body>

</html>