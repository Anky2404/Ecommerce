<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>
    <header>
        <div class="register-wrap">
            <div class="row">
                <div class="colleft">
                    <div class="headlogo">
                        <div class="logo">
                            <h2>FashionCraze</h2>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="login_wrap">

        <div class="colright">

            <h2>Login into your account</h2>
            @if (session('status'))
                <div class="alert alert-danger" id="status-message">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="input">
                    <label for="Email" style="color: black">email</label>
                    <input type="text" placeholder="Enter your email address.." name="email" required>
                </div>
                <div class="input">
                    <label for="Password" style="color: black">Password</label>
                    <input type="password" placeholder="Enter your password..." name="password" required>
                </div>
                <div class="signup">
                    <button>Login</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>@Copyright 2023 | All Right Reserved</p>
    </footer>

    <script>
        $(document).ready(function() {
            // Check if the status message exists
            if ($('#status-message').length) {
                // Hide the message after 5 seconds
                setTimeout(function() {
                    $('#status-message').fadeOut();
                }, 3000);
            }
        });
    </script>
</body>

</html>
