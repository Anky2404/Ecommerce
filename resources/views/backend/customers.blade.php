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
                    <h3>Customer Lists</h3>

                </div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total Orders</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $id++ }}</td>
                                <td>{{ $customer->firstname . ' ' . $customer->lastname }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                    @if (count($customer->orders) > 0)
                                        <a href="{{ route('admin.orders', ['cus_id' => base64_encode($customer->id)]) }}"
                                            class="view">
                                            {{ count($customer->orders) }} View
                                        </a>
                                    @else
                                        {{ 'No Orders' }}
                                    @endif
                                </td>
                                <td> <span class="update-status" data-id="{{ $customer->id }}"
                                        data-status="{{ $customer->is_active ? 0 : 1 }}"
                                        style="background-color: {{ $customer->is_active ? 'green' : 'red' }}; padding:5px 15px; color: white; border-radius: 5px;">
                                        
                                        
                                        {{ $customer->is_active ? 'Active' : 'Inactive' }}
                                    </span></td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <script>
                $(document).ready(function() {
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
                var isConfirmed = confirm("Are you sure you want to "+staff+" this customer?");

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
                                    alert("Customer "+message+" Successfully");
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

        </div>

    </div>


</body>

</html>
