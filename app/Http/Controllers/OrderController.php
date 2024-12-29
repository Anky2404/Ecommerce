<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{

     //Show Order List                                   
     public function CustomerOrders()
     {
         
             $customer_id = 8;
             $orders = Order::where('user_id', $customer_id)->get();
         
         return view('frontend.orderlist', compact('orders'));
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

    
}
