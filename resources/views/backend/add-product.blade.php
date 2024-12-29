<!DOCTYPE html>
<html lang="en">

@include('backend.partials.head')

<body>

    <div class="admin">

        @include('backend.partials.sidebar')

        <div class="dashboard-info">
            @include('backend.partials.nav')
            <h3>Add New Product</h3>
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
                <form method="POST" action="{{ route('admin.add-product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="input">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" placeholder="Enter Product Name..." required>
                        </div>
                
                        <div class="input">
                            <label for="product_quantity">Product Quantity</label>
                            <input type="number" name="product_quantity" id="product_quantity" placeholder="Enter Product Quantity..."
                                required>
                        </div>
                
                        <div class="input">
                            <label for="product_image">Product Image URL</label>
                            <input type="file" name="product_image" id="product_image" placeholder="Enter Product Image URL..." required>
                        </div>
                        <div class="input">
                            <label for="product_color">Product Color</label>
                            <input type="text" name="product_color" id="product_color" placeholder="Enter Product Quantity..."
                                required>
                        </div>
                
                        <div class="input">
                            <label for="product_materials">Product Materials</label>
                            <input type="text" name="product_materials" id="product_materials" placeholder="Enter Product Image URL..." required>
                        </div>
                    </div>
                
                    <div class="input">
                        <label for="base_price">Base Price</label>
                        <input type="text" name="base_price" id="base_price" placeholder="Enter Base Price..." required>
                    </div>
                
                    <div class="input">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="7" style="width: 100%" placeholder="Enter Description..." required></textarea>
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
