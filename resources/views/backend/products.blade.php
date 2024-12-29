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
                    <h3>Product Lists</h3>
                    <a href="{{route('admin.add-product')}}" id="new-btns">Add New Product</a>
                </div>
                <div class="overflow">

                    <table>
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Color</th>
                                <th>Materials</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $id = 1;
                           @endphp  
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $id ++ }}</td>
                                    <td>
                                        @if ($product->images->isNotEmpty())
                                            <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}"
                                                alt="{{ $product->images->first()->image_url }}" height="100px" width="150px">
                                    
                                        @endif
                                    </td>
                                    <td>{{ $product->product_name }}</td> 
                                    <td>{{ $product->category->category_name}}</td> 
                                   
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->color}}</td>
                                    <td>{{$product->materials}}</td>
                                    <td> <span class="update-status" data-id="{{ $product->id }}"
                                        data-status="{{ $product->is_active ? 0 : 1 }}"
                                        style="background-color: {{ $product->is_active ? 'green' : 'red' }}; padding:5px 15px; color: white; border-radius: 5px;">
                                        
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span></td>
                                    <td>
                                        <a href="{{ route('admin.update-product-page', ['pro_id' => base64_encode($product->id)]) }}" class="edit">Edit</a>
    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>

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
                   var product = 'Activate';
                   var message='Activated'; 
                }else{
                  var  product = 'Deactivate';
                  var message='Deactivated';
                }

                // Confirm the action before proceeding
                var isConfirmed = confirm("Are you sure you want to "+product+" this product?");

            if (isConfirmed) {
                // Send AJAX request
                $.ajax({
                    url: "{{ route('admin.update-status') }}", 
                    type: "POST",
                    data: {
                        // CSRF token for security
                        _token: "{{ csrf_token() }}", 
                        status: status, 
                        table: 'products',
                        id: id, 
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert("Product "+message+" Successfully");
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
