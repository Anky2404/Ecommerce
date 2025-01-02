@php
    $customer_id = session('Customer')->id;
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
    <section class="product-detail1">
        <div class="container-wrap">
            <div class="row-wrap">
                <div class="col6">
                    <div class="product-left">
                        <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}"
                            alt="{{ $product->images->first()->image_url }}" title="{{ $product->product_name }}"
                            width="100%" height="600px">
                    </div>
                </div>


                <div class="col4">
                    <div class="product-right">
                        <div class="product-description">
                            <h2>{{ $product->product_name }}</h2>
                        </div>

                        <div class="price-info">
                            <span class="price"><strong>Price :</strong> £{{ $product->base_price }}</span>
                        </div>

                        <div class="color">
                            <span><strong>Color :</strong> {{ $product->color }}</span>
                            <ul>
                              
                                    <li style="background-color: {{ $product->color }};border:2px solid black;"></li>
                                
                            </ul>
                        </div>


                        <div class="size">
                            <span><strong>Materials :</strong> {{ $product->materials }}</span>
                           
                        </div>
                        <div class="qty-cart">
                            <form action="{{route('user.add-cart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                                <input type="hidden" name="quantity" value="1" required>
                                <input type="hidden" name="customer_id" value="{{ $customer_id }}" required>
                                <button type="submit" class="btns"> <i class="fa-solid fa-cart-shopping"></i><span>Add to
                                Cart</span> </button>

                            </form>
                            
                        </div>
                        <div class="accordion">
                            <div class="accordion__item">
                                <!-- <div class="accordion__header" data-toggle="#productdesp"></div> -->
                                <div class="pro-des">
                                    <span>Product Description</span>
                                    <p>{{ $product->product_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-list">
        <div class="container-wrap">
            <div class="heading">
                <h2>Related Products</h2>
            </div>

            <div class="row-wrap">
                @foreach ($latest_products as $related_product)
                    <div class="col3">
                        <div class="shop-box">
                            <a
                                href="{{ route('user.product-details', ['pro_id' => base64_encode($related_product->id)]) }}">
                                <div class="image">
                                    <img src="{{ asset('uploads/pro_img/' . $related_product->images->first()->image_url) }}"
                                        alt="{{ $related_product->images->first()->image_url }}"
                                        title="{{ $related_product->product_name }}" width="330" height="330">
                                </div>
                                <div class="info">
                                    <h4>{{ $related_product->product_name }}</h4>
                                    <p>Price : £{{ $related_product->base_price }}</p>
                                </div>
                            </a>

                            <div class="add">
                                
                                <form action="{{route('user.add-cart')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $related_product->id }}" required>
                                    <input type="hidden" name="quantity" value="1" required>
                                    <input type="hidden" name="customer_id" value="{{ $customer_id }}" required>
                                    <button type="submit" class="btns"> <i class="fa-solid fa-cart-shopping"></i><span>Add to
                                    Cart</span> </button>
    
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>

    @include('frontend.partials.footer')

    <script>
        $(document).ready(function() {
          
    
               
    
            // Handle the Toggle functionality
            $('[data-toggle]').each(function() {
                $(this).click(function() {
                    var selector = $(this).data('toggle');
                    var $block = $(selector);
    
                    // Toggle max-height based on the class
                    if ($(this).hasClass('active')) {
                        $block.css('max-height', '');
                    } else {
                        $block.css('max-height', $block[0].scrollHeight + 'px');
                    }
    
                    // Toggle the 'active' class
                    $(this).toggleClass('active');
                });
            });
        });
    </script>
</body>

</html>
