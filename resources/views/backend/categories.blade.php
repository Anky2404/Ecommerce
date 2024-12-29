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
                    <h3>Category Lists</h3>
                    <a href="AddCategory" id="new-btns">Add New Category</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Total Products</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $id++ }}</td>
                                <td><img src="{{ asset('uploads/cat_img/' . $category->category_img) }}"
                                        alt="{{ $category->name }} Image" height="100px" width="150px"></td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_description }}</td>
                                <td>
                                    <a href="{{ route('admin.products', ['cat_id' => base64_encode($category->id)]) }}"
                                        class="view">
                                        {{ count($category->products) }} View
                                    </a>
                                </td>

                                <td> <span class="update-status" data-id="{{ $category->id }}"
                                    data-status="{{ $category->is_active ? 0 : 1 }}"
                                    style="background-color: {{ $category->is_active ? 'green' : 'red' }}; padding:5px 15px; color: white; border-radius: 5px;">
                                    
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span></td>
                                <td>
                                    <a href="{{ route('admin.update-category-page', ['cat_id' => base64_encode($category->id)]) }}"
                                        class="edit">Edit</a>
                                   
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
                   var category = 'Activate';
                   var message='Activated'; 
                }else{
                  var  category = 'Deactivate';
                  var message='Deactivated';
                }

                // Confirm the action before proceeding
                var isConfirmed = confirm("Are you sure you want to "+category+" this category?");

            if (isConfirmed) {
                // Send AJAX request
                $.ajax({
                    url: "{{ route('admin.update-status') }}", 
                    type: "POST",
                    data: {
                        // CSRF token for security
                        _token: "{{ csrf_token() }}", 
                        status: status, 
                        table: 'categories',
                        id: id, 
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert("Category "+message+" Successfully");
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
