<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Validator;
use App\Models\Query;

class RouteController extends Controller
{

    //Display the dashboard page
    public function index()
    {
        // Get the data from the database
        $customers = User::all()->where('role_type', 'Customer');
        $staffs = User::all()->where('role_type', 'Staff');
        $products = Product::all()->where('is_active', 1);
        $orders = Order::all();

       // Pass the data to the view
    return view('backend.dashboard', compact('customers', 'staffs', 'products', 'orders'));
    }  

    //Display the Home Page
    public function HomePage()
    {
        //Get the products from the database
        $latest_products = Product::orderBy('created_at', 'desc')->where('is_active', 1)->skip(5)->take(4)->get();
        $trending_products = Product::orderBy('id', 'desc')->where('is_active', 1)->skip(4)->take(3)->get();
        $best_selling_products = Product::orderBy('id', 'desc')->where('is_active', 1)->skip(7)->take(4)->get();
        //Pass the data to the view
        return view('frontend.home',compact('latest_products', 'trending_products', 'best_selling_products'));
    }

    //Display the Product Page
    public function ProductPage()
    {
        //Get the categories from the database 
        $categories=Category::all()->where('is_active', 1);  
        //Get the products from the database    
        $products = Product::all()->where('is_active', 1);
        
        //Pass the data to the view
        return view('frontend.products', compact('products','categories'));
    }

    //Display the Product Details Page
    public function ProductDetailsPage($pro_id)
    {
        //Decode the product ID
        $product_id = base64_decode($pro_id);
        //Get the product details from the database
        $product = Product::find($product_id);
        $latest_products = Product::orderBy('created_at', 'desc')->where('is_active', 1)->skip(5)->take(4)->get();


        //Pass the data to the view
        return view('frontend.product-details', compact('product', 'latest_products'));
    }

    //Sent query message to the admin
    public function SentQuery(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:15', 
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000', 
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            //Create a new query message
            $query = new Query();
            $query->sender_name = $request->name;
            $query->sender_email = $request->email;
            $query->sender_contact = $request->contact;
            $query->subject = $request->subject;
            $query->message = $request->message;
            $query->save();

            //Redirect to the home page
            return redirect()->route('user.home')->with('success', 'Query sent successfully');
        }
    }



    


}
