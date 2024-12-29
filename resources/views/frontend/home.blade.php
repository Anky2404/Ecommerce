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
   
    <section class="home-1">
        <div class="container-wrap">


            <div class="home-heading">
                <h1>Style Redefined, Just for You</h1>
                <p>Discover the perfect blend of trendy and timeless fashion. Shop our exclusive collections and elevate
                    your wardrobe with styles that make a statement.</p>
                <a class="btns" href="{{ route('user.shop') }}">Shop Now</a>
            </div>

        </div>
    </section>
    <section class="product-list latest">
        <div class="container-wrap">
            <div class="heading">
                <h2>Explore Our Latest Collection</h2>
            </div>

            <div class="row-wrap">
                @foreach ($latest_products as $product)
                    <div class="col3">
                        <div class="shop-box">
                            <a href="{{ route('user.product-details', ['pro_id' => base64_encode($product->id)]) }}">
                                <div class="image">
                                    <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}"
                                        alt="{{ $product->images->first()->image_url }}"
                                        title="{{ $product->product_name }}" width="330" height="330">

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
                                    <button type="submit"> <i class="fa-solid fa-cart-shopping"></i><span>Add to
                                    Cart</span> </button>

                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>




    </section>

    <section class="product-list trending">
        <div class="container-wrap">
            <div class="heading">
                <h2>Trending Outfits</h2>
            </div>

            <div class="row-wrap">
                @foreach ($trending_products as $product)
                    <div class="col4">
                        <div class="shop-box">
                            <a href="{{ route('user.product-details', ['pro_id' => base64_encode($product->id)]) }}">
                                <div class="image">
                                    <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}"
                                        alt="{{ $product->images->first()->image_url }}"
                                        title="{{ $product->product_name }}" width="400" height="400">

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
                                    <button type="submit"> <i class="fa-solid fa-cart-shopping"></i><span> Add to
                                    Cart</span></button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>




    </section>
    <section class="product-list latest">
        <div class="container-wrap">
            <div class="heading">
                <h2>Best Selling</h2>
            </div>

            <div class="row-wrap">
                @foreach ($best_selling_products as $product)
                    <div class="col3">
                        <div class="shop-box">
                            <a href="{{ route('user.product-details', ['pro_id' => base64_encode($product->id)]) }}">
                                <div class="image">
                                    <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}"
                                        alt="{{ $product->images->first()->image_url }}"
                                        title="{{ $product->product_name }}" width="330" height="330">

                                </div>
                                <div class="info">
                                    <h4>{{ $product->product_name }}</h4>
                                    <p>Price : £{{ $product->base_price }}</p>
                                </div>
                            </a>


                            <div class="add">
                                <form action="user.add-cart" method="POST">
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




    </section>
    <section class="cta">
        <div class="container-wrap">
            <div class="cta-banner">
                <div class="cta-content">
                    <h2>Your Style, Your Statement</h2>
                    <p>Don't just follow trends—set them. Explore our curated collections and find pieces that reflect
                        your unique style. FashionCraze is here to help you stand out and shine.</p>
                    <a class="btn" href="{{ route('user.shop') }}">Shop the Look</a>
                </div>
            </div>

        </div>
    </section>
    <section class="vintage">
        <div class="container-wrap">
            <div class="row-wrap">
                <div class="col6">
                    <div class="vintage-left">
                        <h2>Timeless Elegance: Vintage Vibes</h2>
                        <p>Step into the charm of yesteryears with our exclusive vintage-style collection, where classic
                            elegance meets modern sophistication. Celebrate the beauty of timeless fashion with
                            carefully curated pieces that bring the past to life. From delicate lace dresses that exude
                            romance and grace to retro-inspired accessories that add a playful yet refined touch, each
                            item in our collection is designed to make a statement. </p>
                    </div>
                </div>
                <div class="col6">
                    <div class="vintage-images">
                        <div class="row-wrap">
                            <div class="col4">
                                <img src="{{ asset('frontend_assets/images/vintage1.jpg') }}"alt="Vintage Vibes"
                                    title="Vintage Vibes">
                            </div>
                            <div class="col4">
                                <img src="{{ asset('frontend_assets/images/vintage2.jpg') }}"alt="Vintage Vibes"
                                    title="Vintage Vibes">
                            </div>
                            <div class="col4">
                                <img src="{{ asset('frontend_assets/images/vintage3.jpg') }}"alt="Vintage Vibes"
                                    title="Vintage Vibes">
                            </div>
                            <div class="col4">
                                <img src="{{ asset('frontend_assets/images/vintage4.jpg') }}"alt="Vintage Vibes"
                                    title="Vintage Vibes">
                            </div>
                            <div class="col4">
                                <img src="{{ asset('frontend_assets/images/vintage5.jpg') }}"alt="Vintage Vibes"
                                    title="Vintage Vibes">
                            </div>
                            <div class="col4">
                                <img src="{{ asset('frontend_assets/images/vintage6.jpg') }}"alt="Vintage Vibes"
                                    title="Vintage Vibes">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.footer')
</body>

</html>
