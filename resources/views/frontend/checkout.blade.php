@php
    $total = 0;
    $shipping_charge = 25;
@endphp

<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>
    @include('frontend.partials.header')
    
    <section class="banner">
        <div class="container-wrap">
            <h1>Checkout</h1>
        </div>
    </section>

    <section class="checkout">
        <div class="container-wrap">
            <div class="row-wrap">
                <div class="checkout-form" id="billing-form">
                    <h3>Billing details</h3>
                
                    <form action="{{ route('user.save-address') }}" method="POST" id="address-form" style="display: none;">
                        @csrf 
                        <!-- Close button -->
                        <strong id="close-form" style="cursor: pointer;
  font-size: 20px;
  position: absolute;
  top: 24px;
  right: 30px;
  background: #000000c4;
  padding: 10px;
  color: #fff;
  border-radius: 8px;
  font-size: 18px;">X</strong>
                
                        <div class="input-wrap">
                            <div class="field">
                                <label for="full_name">Full Name</label>
                                <input type="text" id="full_name" name="full_name" placeholder="Enter Full Name" required>
                            </div>
                            <div class="field">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Enter Email" required>
                            </div>
                        </div>
                
                        <div class="input-wrap">
                            <div class="field">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="field">
                                <label for="country">Country</label>
                                <input type="text" id="country" name="country" placeholder="Enter Country" required>
                            </div>
                        </div>
                
                        <div class="input-wrap">
                            <div class="field">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state" placeholder="Enter State" required>
                            </div>
                            <div class="field">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="Enter City" required>
                            </div>
                        </div>
                
                        <div class="input-wrap">
                            <div class="field">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code" placeholder="Enter Postal Code" required>
                            </div>
                            <div class="field">
                                <label for="location_type">Location Type</label>
                                <select id="location_type" name="location_type" required>
                                    <option value="">Select Location Type</option>
                                    <option value="Home">Home</option>
                                    <option value="Office">Office</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                
                        <div class="field">
                            <label for="landmark">Landmark</label>
                            <input type="text" id="landmark" name="landmark" placeholder="Enter Landmark" required>
                        </div>
                       
                        <div class="field">
                            <label for="suburb">Suburb</label>
                            <input type="text" id="suburb" name="suburb" placeholder="Enter Suburb" required>
                        </div>
                
                        <button type="submit" class="btns">Save Address</button>
                    </form>
                
                    {{-- Show added Address --}}
                    <div id="address-div">
                    <div class="address-btn">
                        <button class="btns" id="add-address">Add More Address</button>

                    </div>
                    <div class="main-address">
                    @foreach ($addresses as $address)
                    <div class="col6">
                    <div id="address-list">
             
                        <ul>
                            <input type="radio" name="address_id" value="{{ $address->id }}">
                           <li><strong> Full Name:</strong>{{$address->fullname .''}}</span></li>
                           <li><strong>Email: </strong><span>{{ $address->email_address }}</span></li>
                           <li><strong>Location Type: </strong><span> {{$address->location_type }}</span></li>
                           <li><strong>Landmark: </strong><span>  {{$address->landmark }}</span></li>
                           <li> <strong>Address: </strong><span>{{$address->city }}, {{ $address->state }}, {{ $address->country }}, {{ $address->postal_code }}</span></li>
                           
                         
                        </ul>
                        
                        
                    </div>
                </div>
                @endforeach
                </div>
            </div>
                </div>
                <div class="colright">
                    <div class="checkout-cart">
                        <h2>Your Orders</h2>
                        
                        <ul>
                            @foreach($cart_items as $item)
                            <li>
                                <h3>{{ $item->products->product_name }}</h3>
                                <h4>£<?php echo number_format($item->products->base_price * $item->quantity, 2); ?></h4>
                            </li> 
                            @php
                            $total += $item->products->base_price * $item->quantity;
                            @endphp
                            @endforeach
                            <li>
                                <h3>Item Total</h3>
                                <h4 id="item-total">£<?php echo number_format($total, 2); ?></h4>
                            </li>
                
                            <li>
                                <h3>Delivery Fee</h3>
                                <h4 id="delivery-fee">£<?php echo number_format($shipping_charge, 2); ?></h4>
                            </li>
                
                            <li>
                                <h3>Total</h3>
                                <h4><strong id="final-total">£<?php echo number_format($shipping_charge + $total, 2); ?></strong></h4>
                            </li>
                        </ul>
                
                        <ul class="discount">
                            <h3>Discount</h3>
                            @foreach ($discounts as $discount)
                            @if ($discount->min_order_value < ($shipping_charge + $total))
                            <li>
                                <label>
                                    <input type="radio" name="discount_code" value="{{ $discount->code }}" 
                                           data-discount-amount="{{ $discount->value }}">
                                    {{ $discount->code }} (£{{number_format($discount->value, 2) }} off)
                                </label>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                
                        <button class="btns" id="confirm-order">Confirm Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.footer')

   
    <script>
        $(document).ready(function() {
            // Get initial totals
            var itemTotal = parseFloat($('#item-total').text().replace('£', ''));
            var deliveryFee = parseFloat($('#delivery-fee').text().replace('£', ''));
            var finalTotalElement = $('#final-total');
            let discount=0;

            // Function to update the total after discount
            function updateTotal(discountAmount) {
                discount=discountAmount;
                var total = itemTotal + deliveryFee - discountAmount;
                finalTotalElement.text('£' + total.toFixed(2));
            }

           

          

            // Event listener for discount selection
            $('input[name="discount_code"]').change(function() {
                var discountAmount = parseFloat($(this).data('discount-amount'));
                updateTotal(discountAmount);
            });

            // Initialize total
            updateTotal(0);

          
            // On Confirm Order click, check if address is selected
            $('#confirm-order').click(function(e) {
                if (!$('input[name="address_id"]:checked').length) {
                    e.preventDefault();
                    // Prevent form submission
                    alert('Please select an address before confirming your order.'); 

                }else{
                   // Get the selected address ID
                    var selectedAddressId = $('input[name="address_id"]:checked').val();
                     //Sent Ajax request to placed the order
            $.ajax({
                url: '{{route('user.place-order')}}', 
                type: 'POST', 
                data: {
                    _token: '{{ csrf_token() }}',  
                    address_id: selectedAddressId,
                    total_amount: itemTotal + deliveryFee,
                    discount_amount: discount
                },
                success: function(response) {
                    // Handle the response is successful
                    alert('Order confirmed with Address ID: ' + selectedAddressId);
<<<<<<< HEAD
                     // Redirect to the user orders page
                     window.location.href = '{{route('user.orders')}}';
=======
                    console.log(response);  
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144
                },
                error: function(xhr, status, error) {
                    // Handle error if the request fails
                    alert('There was an error with your request. Please try again.');
                    console.log(error);  
                }
            });
                }
            });

            // Toggle form and address list visibility
    document.getElementById('add-address').addEventListener('click', function() {
        var addressForm = document.getElementById('address-form');
        var addressDiv = document.getElementById('address-div');
        
        // Show the form and hide the address list
        addressForm.style.display = 'block';
        addressDiv.style.display = 'none';
    });

    // Hide form and show address
    document.getElementById('close-form').addEventListener('click', function() {
        var addressForm = document.getElementById('address-form');
        var addressDiv = document.getElementById('address-div');
        
        // Hide the form and show 
        addressForm.style.display = 'none';
        addressDiv.style.display = 'block';
    });


   

          
        });
       
    

    </script>
</body>

</html>
