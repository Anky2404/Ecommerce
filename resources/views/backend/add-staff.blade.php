<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <h3>Add New Staff</h3>
            <div class="game-form">
                @if (session('error'))
                    <div class="alert alert-danger" id="status-message">
                        <ul>
                            @foreach (session('error') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.add-staff') }}">
                    @csrf

                    <div class="row">
                        <div class="input">
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" id="firstname" placeholder="Enter Firstname..."
                                required>
                        </div>

                        <div class="input">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Enter Lastname..."
                                required>
                        </div>

                        <div class="input">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email Address..."
                                required>
                        </div>

                        <div class="input">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number"
                                placeholder="Enter Phone Number..." required>
                        </div>

                        <div class="input">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" name="dob" id="dob" required>
                        </div>

                        <div class="input">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter Password..."
                                required>
                        </div>
                    </div>

                    <div class="signup">
                        <button type="submit">Submit</button>
                    </div>
                </form>


            </div>


        </div>

    </div>

    <script>
        $(document).ready(function() {
            // Check if the status message exists
            if ($('#status-message').length) {
                // Hide the message after 5 seconds
                setTimeout(function() {
                    $('#status-message').fadeOut();
                }, 5000);
            }
        });
    </script>
</body>

</html>
