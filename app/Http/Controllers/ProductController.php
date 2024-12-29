<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    // Show products by category
    public function showProducts($cat_id = null)
    {
        //Check if the category exists
        if ($cat_id != null) {
            //Decode the category ID
            $category_id = base64_decode($cat_id);

            //Retrieve the products for the category
            $products = Category::find($category_id)->products;
            //Return the products to the view
            return view('backend.products', compact('products'));
        } else {
            //Retrieve all products
            $products = Product::all();
            //Return the products to the view
            return view('backend.products', compact('products'));
        }
    }

    // Add product form
    public function AddProductForm()
    {
        //Retrieve all categories
        $categories = Category::all();
        //Return the categories to the view
        return view('backend.add-product', compact('categories'));
    }


    // Add product
    public function AddProduct(Request $request)
    {
        //Validate the request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'product_quantity' => 'required',
            'product_color' => 'required',
            'product_materials' => 'required',
            'base_price' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        //Check if the validation fails
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }

        //Handle uploaded image
        if ($request->hasFile('product_image')) {
            // Get the image file
            $image = $request->file('product_image');

            // Generate a unique filename
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image in the folder
            $image->move(public_path('uploads/pro_img'), $imageName);
        }

        //Create a new product
        $product = new Product();
        //Assign the product details
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_description = $request->description;
        $product->quantity = $request->product_quantity;
        $product->color = $request->product_color;
        $product->materials = $request->product_materials;
        $product->base_price = $request->base_price;
        //Save the product
        $product->save();

        //Get the product ID
        $product_id = $product->id;
        //Create a new product image
        $product_image = new ProductImage();
        $product_image->product_id = $product_id;
        $product_image->image_url = $imageName;
        $product_image->is_main = 1;
        $product_image->is_active = 1;
        //Save the product image
        $product_image->save();

        //Redirect to the product list page
        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

     //Update product form
     public function UpdateProductForm($pro_id)
     {
         //Decode the product ID
         $product_id = base64_decode($pro_id);
         //Retrieve the product
         $product = Product::find($product_id);
         //Retrieve all categories
         $categories = Category::all();
         //Return the product and categories to the view
         return view('backend.edit-product', compact('product', 'categories'));
     }


    //update product
    public function UpdateProduct(Request $request){
        //Validate the request
        $validator = Validator::make($request->all(), [
           'category_id' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'product_quantity' => 'required',
            'product_color' => 'required',
            'product_materials' => 'required',
            'base_price' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Check if the validation fails
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }

        //Handle uploaded image
        if ($request->hasFile('product_image')) {
            // Get the image file
            $image = $request->file('product_image');

            // Generate a unique filename
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image in the folder
            $image->move(public_path('uploads/pro_img'), $imageName);
        }

        //Create a new product
        $product = Product::find($request->product_id);
        //Assign the product details
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_description = $request->description;
        $product->quantity = $request->product_quantity;
        $product->color = $request->product_color;
        $product->materials = $request->product_materials;
        $product->base_price = $request->base_price;
        //Save the product
        $product->save();

        if($request->hasFile('product_image')){
            //Create a new product image
            $product_image = new ProductImage();
            $product_image->product_id = $request->product_id;
            $product_image->image_url = $imageName;
            $product_image->is_main = 1;
            $product_image->is_active = 1;
            //Save the product image
            $product_image->save();
        }
       
        //Redirect to the product list page
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');   
    }

  





}
