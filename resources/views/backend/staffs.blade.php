<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <div class="wrap">
                @if (session('success'))
                <div class="alert alert-success" id="status-message">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" id="status-message">
                    {{ session('error') }}
                </div>
            @endif
                <div class="title">
                    <h3>Staff Lists</h3>
                    <a href="{{ route('admin.add-staff') }}" id="new-btns">Add New Staff</a>
                   
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($staffs as $staff)
                            <tr>
                                <td>{{ $id++ }}</td>
                                <td>{{ $staff->firstname . ' ' . $staff->lastname }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->phone }}</td>
                                <td>
    <span class="update-status" data-id="{{ $staff->id }}" data-status="{{ $staff->is_active ? 0 : 1 }}"
        style="background-color: {{ $staff->is_active ? 'green' : 'red' }}; padding:5px 15px; color: white; border-radius: 5px;">
        {{ $staff->is_active ? 'Active' : 'Inactive' }}
    </span>
</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>
    <script>
        $(document).ready(function() {

            //Hide the status message
            if ($('#status-message').length) {
                // Hide the message
                setTimeout(function() {
                    $('#status-message').fadeOut();
                }, 5000);
            }

            // Event listener for update status button
            $('.update-status').click(function() {
                var status = $(this).data('status');
                var id = $(this).data('id');

                if(status == 1){
                   var staff = 'Activate';
                   var message='Activated'; 
                }else{
                  var  staff = 'Deactivate';
                  var message='Deactivated';
                }

                // Confirm the action before proceeding
                var isConfirmed = confirm("Are you sure you want to "+staff+" this staff?");

            if (isConfirmed) {
                // Send AJAX request
                $.ajax({
                    url: "{{ route('admin.update-status') }}", 
                    type: "POST",
                    data: {
                        // CSRF token for security
                        _token: "{{ csrf_token() }}", 
                        status: status, 
                        table: 'users',
                        id: id, 
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert("Staff "+message+" Successfully");
                            // Reload the page
                            location.reload();
                        } else {
                            // Handle errors
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
            });
        });
    </script>

</body>

</html>
