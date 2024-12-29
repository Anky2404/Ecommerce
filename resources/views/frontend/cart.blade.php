@php
    $shipping_charge=25;
@endphp

<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    <section class="banner">
        <div class="container-wrap">
            <h1>Cart</h1>
        </div>
    </section>

    <section class="cart1">
        <div class="container-wrap">
            <div class="row-wrap">
                <div class="col6">
                    <div class="cart-left">
                        <table cellspacing="0">
                            <thead>
                                <tr>

                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-remove">Total</th>
                                    <th class="product-remove">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_items as $item)
                                <tr class="cart-item" data-id="{{ $item->id }}">
                                    <td class="product-thumbnail">
                                        <a href="product-detail.html">
                                            <img src="{{ asset('uploads/pro_img/' . $item->products->images->first()->image_url) }}" width="60" height="60">
                                        </a>
                                    </td>
                            
                                    <td class="product-name">
                                        <a href="product-detail.html">{{ $item->products->product_name }}</a>
                                    </td>
                            
                                    <td class="product-price" data-title="Price">
                                        <span class="price" data-price="{{ $item->products->base_price }}">£{{ $item->products->base_price }}</span>
                                    </td>
                            
                                    <td class="product-quantity">
                                        <div class="qty-input">
                                            <button class="qty-count qty-count--minus" data-action="minus" type="button" disabled>-</button>
                                            <input class="product-qty" type="number" value="{{$item->quantity}}" name="product-qty" min="1" max="3" value="{{ $item->quantity }}" readonly>
                                            <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                                        </div>
                                    </td>
                            
                                    <td class="product-subtotal">
                                        <span class="subtotal-price" data-subtotal="{{ $item->products->base_price * $item->quantity }}">
                                            £{{ $item->products->base_price * $item->quantity }}
                                        </span>
                                    </td>
                                    
                                    <td class="product-remove">
                                        <button onclick="removeItemFromCart(this)" data-id="{{ $item->id }}">Remove</button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col4">
                    <div class="cart-right">
                        <h2>Cart totals</h2>
                        <ul>
                            <li>
                                <h3>Subtotal</h3>
                                <h4 id="subtotal"></h4>
                            </li>

                            <li>
                                <h3>Shipping</h3>
                                <h4>£<?php echo number_format($shipping_charge, 2); ?></h4>
                            </li>

                            <li>
                                <h3><strong>Total</strong></h3>
                                <h4 id="total_amount"><strong></strong></h4>
                            </li>



                        </ul>
                        <div class="add-cart">
                            <div class="action-wrap">
                                <div class="coupon">

                                    <a href="{{route('user.checkout')}}" class="btns" type="submit">Checkout</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
    @include('frontend.partials.footer')
  <script>
  $(document).ready(function() {
    // Update button states based on quantity
    function updateButtonStates($quantityInput) {
        var currentValue = parseInt($quantityInput.val());
        var $minusButton = $quantityInput.siblings('.qty-count--minus');
        var $plusButton = $quantityInput.siblings('.qty-count--add');

        // Disable + button if quantity is 3
        if (currentValue >= 3) {
            $plusButton.prop('disabled', true);
        } else {
            $plusButton.prop('disabled', false);
        }

        // Disable - button if quantity is 1
        if (currentValue <= 1) {
            $minusButton.prop('disabled', true);
        } else {
            $minusButton.prop('disabled', false);
        }
    }

    // Update Subtotal amount on change quantity
    function updateSubtotal($productRow, quantity) {
        var price = parseFloat($productRow.find('.price').data('price'));
        var subtotal = price * quantity;
        $productRow.find('.subtotal-price').text('£' + subtotal.toFixed(2));
        $productRow.find('.subtotal-price').data('subtotal', subtotal);
    }

    // Update total amount
    function updateTotalAmount() {
        var total = 0;
        $('.cart-item').each(function() {
            total += parseFloat($(this).find('.subtotal-price').data('subtotal'));
        });
        $('#subtotal').text('£' + total.toFixed(2));

        //total amount
        $('#total_amount').text('£'+(total+{{$shipping_charge}}).toFixed(2));
    }

    // FUpdate the quantity in the database
    function updateQuantityInDatabase(cartId, newQuantity) {
        $.ajax({
            url: '/Cart/Update',  
            method: 'POST',
            data: {
                // CSRF token for security
                _token: '{{ csrf_token() }}',  
                cart_id: cartId,
                quantity: newQuantity
            },
            success: function(response) {
                    updateTotalAmount(); 
               
            },
            error: function() {
                alert('Error updating the cart quantity');
            }
        });
    }

    // On click of the plus button
    $(document).on('click', '.qty-count--add', function() {
        var $quantityInput = $(this).siblings('.product-qty');
        var currentValue = parseInt($quantityInput.val());
        if (currentValue < 3) {
            var newValue = currentValue + 1;
            $quantityInput.val(newValue);
            // Update button states
            updateButtonStates($quantityInput);  
            var $productRow = $(this).closest('.cart-item');
            // Update subtotal
            updateSubtotal($productRow, newValue); 
            //Get cart id from data
            var cartID=$productRow.data('id');
            updateQuantityInDatabase(cartID, newValue)

        }
    });

    // On click of the minus button
    $(document).on('click', '.qty-count--minus', function() {
        var $quantityInput = $(this).siblings('.product-qty');
        var currentValue = parseInt($quantityInput.val());
        if (currentValue > 1) {
            var newValue = currentValue - 1;
            $quantityInput.val(newValue);
            // Update button states
            updateButtonStates($quantityInput);  
            var $productRow = $(this).closest('.cart-item');
            // Update subtotal
            updateSubtotal($productRow, newValue);  
             //Get cart id from data
             var cartID=$productRow.data('id');
             updateQuantityInDatabase(cartID, newValue)
        }
    });
    
    $('.product-qty').each(function() {
        updateButtonStates($(this));
    });

    // Initial total amount update
    updateTotalAmount();
});


// Handle remove item button
function removeItemFromCart(button) {
    // Get the cart ID from data
    var cartID = $(button).data('id'); 
    
    // Show the confirmation dialog
    var userConfirmed = confirm('Are you sure you want to remove this item from the cart?');

    if (userConfirmed) {
        // Send AJAX request 
        $.ajax({
            url: '/remove-item/' + cartID,  
            type: 'DELETE', 
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response) {
                // Handle the successful response
                alert('Item with ID ' + cartID + ' removed successfully!');  
                location.reload();
                
            },
            error: function(xhr, status, error) {
                // Handle errors
                alert('An error occurred while removing the item: ' + error);
            }
        });
    } else {
        alert('Item not removed.');
    }
}


</script>    
</body>

</html>
