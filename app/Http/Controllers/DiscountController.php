<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\LoyaltyPoints;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //Display Discount Page
    public function ShowDiscountPage()
    {
        $discounts=Discount::orderBy('created_at', 'desc')->get();
        //Redirect to discount page
        return view('backend.discounts',compact('discounts'));
    }

    //Display Add Discount Form
    public function AddDiscountForm(){

        //Redirect to discount page
        return view('backend.add-discount'); 
    }

    //Add New Discount Offer
    public function StoreDiscount(Request $request){
        //Validate form data
        $validator = Validator::make($request->all(), [
            'discount_code' => 'required|string|max:255',
            'discount_type' => 'required|string|in:Percentage,Fixed',
            'value' => 'required|numeric|min:0',
            'min_orders' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'required|integer|min:1',
            'status' => 'required|string|in:Active,Inactive,Expired',
            'category_description' => 'required|string',
        ]);

        //Check if the validation fails
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }

        // Create new discount
        $discount = new Discount();
        $discount->code = $request->discount_code;
        $discount->type = $request->discount_type;
        $discount->value = $request->value;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->min_order_value = $request->min_orders;
        $discount->usage_limit = $request->usage_limit;
        $discount->used_count = 0; 
        $discount->status = $request->status;
        $discount->description = $request->category_description;
        $discount->save();

        // Redirect to discount page with success message
        return redirect()->route('admin.discount-page')->with('success', 'Discount added successfully.');

    }


    //Display Update Discount form
    public function UpdateDiscountForm($id)
    {
        //Decode discount id
        $discount_id=base64_decode($id);
        // Fetch the discount by id
        $discount = Discount::find($discount_id);
        // Check if discount exists
        if (!$discount) {
            return redirect()->back()->with('error', 'Discount not found.');
        }
        // Redirect to update discount form with discount data
        return view('backend.edit-discount', compact('discount'));
    }

    //Update Discount details
    public function UpdateDiscount(Request $request,)
    {
        // Validate form data
        $validator = Validator::make($request->all(), [
            'discount_id' => 'required|integer',
            'discount_code' => 'required|string|max:255',
            'discount_type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'min_orders' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'required|integer|min:1',
            'status' => 'required|string|in:Active,Inactive,Expired',
            'category_description' => 'required|string',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }

        // Fetch the discount by id
        $discount = Discount::find($request->discount_id);

        // Check if discount exists
        if (!$discount) {
            return redirect()->back()->with('error', 'Discount not found.');
        }

        // Update discount details
        $discount->code = $request->discount_code;
        $discount->type = $request->discount_type;
        $discount->value = $request->discount_value;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->min_order_value = $request->min_orders;
        $discount->usage_limit = $request->usage_limit;
        $discount->status = $request->status;
        $discount->description = $request->category_description;
        $discount->save();

        // Redirect to discount page with success message
        return redirect()->route('admin.discount-page')->with('success', 'Discount updated successfully.');
    }

    //Display Loyalty Points Page
    public function ShowLoyaltyPointsPage()
    {
        // Fetch loyalty points data
        $loyaltyPoints = LoyaltyPoints::all();
        // Redirect to loyalty points page
        return view('backend.loyalty-points', compact('loyaltyPoints'));
    }
}
