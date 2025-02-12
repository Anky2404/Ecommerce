<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use App\Models\Basket;
use App\Models\LoyaltyPoints;

class OrderController extends Controller
{

    //Placed the order
    public function PlacedOrder(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        // Find the customer cart items 
        $customer = session('Customer');
        if ($customer) {
            $customer_id = $customer->id;
            $cart_items = Basket::where('customer_id', $customer_id)->get();

<<<<<<< HEAD

=======
           
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144

            // Create a new order
            $order = new Order();
            $order->user_id = $customer_id;
            $order->address_id = $request->address_id;
            $order->order_status = 'Placed';
            $order->total_amount = $request->total_amount;
            $order->discount_amount = $request->discount_amount;
            $order->net_amount = ($request->total_amount - $request->discount_amount);
            $order->save();

            //Get the order ID  
            $order_id = $order->id;

            // Create order items
            foreach ($cart_items as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order_id;
                $orderItem->product_id = $item->product_id;
                $orderItem->quantity = $item->quantity;
                $orderItem->unit_price =  $item->products->base_price;
                $orderItem->status = 'Placed';
                $orderItem->total_amount = ($item->products->base_price * $item->quantity);
                $orderItem->save();

                // Delete the cart item
                $item->delete();
            }

<<<<<<< HEAD
            // Create a new loyalty point
            $loyaltyPoint = new LoyaltyPoints();
            $loyaltyPoint->customer_id = $customer_id;
            $loyaltyPoint->purchase_id = $order_id;
            $loyaltyPoint->points = 5;
            $loyaltyPoint->type = 'Earned';
            $loyaltyPoint->save();
=======
           // Create a new loyalty point
              $loyaltyPoint = new LoyaltyPoints();
                $loyaltyPoint->customer_id = $customer_id;
                $loyaltyPoint->purchase_id = $order_id;
                $loyaltyPoint->points = 5;
                $loyaltyPoint->type = 'Earned';
                $loyaltyPoint->save();
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144





            // Redirect with success message
            return redirect()->route('user.orders')->with('success', 'Orders placed successfully!');
        }
    }

    //Show Order List                                   
    public function CustomerOrders()
    {
        $customer = session('Customer');
        if ($customer) {
            $customer_id = $customer->id;
            $orders = Order::where('user_id', $customer_id)->get();

            return view('frontend.orderlist', compact('orders'));
        }
    }


    //Show Order List                                   
    public function CustomerOrderDetails($order_id)
    { //Decode the order ID
        $order_id = base64_decode($order_id);

        //Get the order details
        $order_items = OrderItem::where('order_id', $order_id)->get();


        return view('frontend.order-details', compact('order_items'));
    }


    //Show Order List                                   
    public function showOrders($cus_id = null)
    {
        if ($cus_id != null) {
            //Decode the customer ID
            $customer_id = base64_decode($cus_id);
            $orders = Order::where('user_id', $customer_id)->get();
        } else {
            $orders = Order::all();
        }
        return view('backend.orders', compact('orders'));
    }

    //Show Order Details
    public function showOrderDetails($order_id)
    {
        //Decode the order ID
        $order_id = base64_decode($order_id);

        //Get the order details
        $order_items = OrderItem::where('order_id', $order_id)->get();


        return view('backend.order-items', compact('order_items'));
    }

    //Update order item status
    public function updateOrderItemStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'item_id' => 'required|exists:order_items,id',
<<<<<<< HEAD
            'status' => 'required|in:Confirmed,Canceled',
=======
            'status' => 'required|in:Confirmed,Cancelled',
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144
        ]);

        // Find the order item  by ID
        $orderItem = OrderItem::find($request->item_id);

        $order = Order::find($orderItem->order_id);

        // Update the order status
        $orderItem->status = $request->status;
        $orderItem->save();

        //update order status in mark in progress
        if ($order->order_status == 'Placed') {
            $order->order_status = 'Mark In Progress';
            $order->save();
        }


        // Return a success response
        return response()->json(['message' => 'Order status updated successfully']);
    }


    public function updateOrderStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'order_id' => 'required|exists:orders,id',
<<<<<<< HEAD
            'status' => 'required|in:Confirmed,Canceled',
=======
            'status' => 'required|in:Confirmed,Cancelled',
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144
        ]);

        // Find the order by ID
        $order = Order::find($request->order_id);

        // Update the order status 
<<<<<<< HEAD
        $order->order_status = $request->status;
=======
        $order->order_status = 'Mark In Progress';
>>>>>>> beb821e223467b1f4c47b9db76bd5f665a13a144
        $order->save();

        // Find all related order items by order_id
        $orderItems = OrderItem::where('order_id', $request->order_id)->get();

        // Update each order item's status
        foreach ($orderItems as $item) {
            $item->status = $request->status;
            $item->save();
        }

        // Return a success response
        return response()->json(['message' => 'Order status updated successfully']);
    }

    //Save Address
    public function SaveAddress(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'location_type' => 'required|string|max:50',
            'landmark' => 'required|string|max:255',
            'suburb' => 'required|string',
        ]);

        // Create and save the address (this assumes you have a model called Address)
        $address = new Address();
        $address->user_id = session('Customer')->id;
        $address->fullname = $request->full_name;
        $address->email_address = $request->email;
        $address->phone_number = $request->phone;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->location_type = $request->location_type;
        $address->landmark = $request->landmark;
        $address->address_type = 'customer_address';
        $address->suburb = $request->suburb;
        $address->save();

        // Redirect with success message
        return redirect()->route('user.orders')->with('success', 'Address saved successfully!');
    }
}
