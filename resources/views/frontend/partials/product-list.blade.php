<<<<<<< HEAD
=======

>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144
@if ($products->isEmpty())
    <p>No products found for this category.</p>
@else
    @foreach($products as $product)
    <div class="col4">
        <div class="shop-box">
            <a href="{{ route('user.product-details', ['pro_id' => base64_encode($product->id)]) }}">
                <div class="image">
                    <img src="{{ asset('uploads/pro_img/' . $product->images->first()->image_url) }}" 
                         alt="{{ $product->product_name }}" title="{{ $product->product_name }}" width="330" height="330">
                </div>
                <div class="info">
                    <h4>{{ $product->product_name }}</h4>
                    <p>Price: £{{ $product->base_price }}</p>
                </div>
            </a>

            <div class="add">
                <form action="{{ route('user.add-cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" required>
                    <input type="hidden" name="quantity" value="1" required>
                    <button type="submit"><i class="fa-solid fa-cart-shopping"></i> <span>Add to Cart</span></button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endif
