<<<<<<< HEAD
=======
@php
    $customer_id = session('Customer')->id;
@endphp
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144
@if ($errors->any())
<script>
    // Collect all error messages into a single string
    var errorMessages = '';
    @foreach ($errors->all() as $error)
        errorMessages += '{{ $error }}\n'; 
    @endforeach
    
    alert(errorMessages);
</script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.partials.head')
</head>
<body>
    @include('frontend.partials.header')
    
    <!-- Banner Section -->
    <section class="banner">
        <div class="container-wrap">
            <h1>Shop</h1>
        </div>
    </section>

    <!-- Product List Section -->
    <section class="product-list">
        <div class="container-wrap" id="shop-list">
            <div class="col3">
                <strong class="head">Categories</strong>
                <div class="select-list">
                    <ul>
                        <li id="allCategories">All Categories</li>
                        @foreach ($categories as $category)
                            <li class="category-item" data-category-id="{{ $category->id }}">{{ $category->category_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Products Display Section -->
            <div class="col9">
                <div class="row-wrap" id="product-list">
                    @foreach($products as $product)
                    <div class="col4">
                        <div class="shop-box">
                            <a href="{{route('user.product-details', ['pro_id' => base64_encode($product->id)]) }}">
                                <div class="image">
                                    <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}"
                                         alt="{{ $product->images->first()->image_url }}" title="{{$product->product_name}}" width="330" height="330">
                                </div>
                                <div class="info">
                                    <h4>{{ $product->product_name }}</h4>
                                    <p>Price: £{{ $product->base_price }}</p>
                                </div>
                            </a>

                            <!-- Add to Cart Form -->
                            <div class="add">
                                <form action="{{ route('user.add-cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                    <input type="hidden" name="quantity" value="1" required>
<<<<<<< HEAD
=======
                                    <input type="hidden" name="customer_id" value="{{ $customer_id }}" required>
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144
                                    <button type="submit"><i class="fa-solid fa-cart-shopping"></i> <span>Add to Cart</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.footer')

    
    <script>
        $(document).ready(function() {
            // When a category is clicked
            $('.category-item').on('click', function() {
                // Get the selected category ID
                var categoryId = $(this).data('category-id');  
                // Highlight the selected category
                $('.category-item').removeClass('active');
                $(this).addClass('active');

                // Send an AJAX request 
                $.ajax({
                    url: "{{ route('category.filter') }}",  
                    type: "GET",
                    data: {
                        category_id: categoryId 
                    },
                    success: function(response) {
                        // Update the product list
                        $('#product-list').html(response);  
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred while filtering the categories.");
                    }
                });
            });

            // All Categories" is clicked
            $('#allCategories').on('click', function() {
                // Highlight the "All Categories" as active
                $('.category-item').removeClass('active');
                $(this).addClass('active');

                // Send AJAX request to show all products
                $.ajax({
                    url: "{{ route('category.filter') }}",
                    type: "GET",
                    data: {
                        category_id: null  
                    },
                    success: function(response) {
                        $('#product-list').html(response);  
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred while loading all products.");
                    }
                });
            });
        });
    </script>
</body>
</html>
