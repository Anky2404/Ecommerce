@php
    $customer_id = 8;
@endphp
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

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Shop</h1>
        </div>
    </section>

    <section class="product-list">
        <div class="container-wrap" id="shop-list">
            <div class="col3">
            <strong class="head">Categories</strong>
                <div class="select-list">
                    
                    <ul>
                        <li class="active">All Categories</li>
                        @foreach ($categories as $category)
                        <li>{{$category->category_name}}</li>
                        @endforeach
                        

                    </ul>

                </div>

            </div>
            <div class="col9">
            <div class="row-wrap">
                @foreach($products as $product)
                <div class="col4">
                    <div class="shop-box">
                        <a href="{{route('user.product-details', ['pro_id' => base64_encode($product->id)]) }}">
                            <div class="image">
                                <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}"
                                            alt="{{ $product->images->first()->image_url }}"  title="{{$product->product_name}}" width="330" height="330">

                            </div>
                            <div class="info">
                                    <h4>{{ $product->product_name }}</h4>
                                    <p>Price : £{{ $product->base_price }}</p>
                                </div>
                        </a>


                        <div class="add">
                            <form action="{{route('user.add-cart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                <input type="hidden" name="quantity" value="1" required>
                                <input type="hidden" name="customer_id" value="{{ $customer_id }}" required>
                                <button type="submit"> <i class="fa-solid fa-cart-shopping"></i> <span>Add to
                                Cart</span></button>

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
</body>

</html>