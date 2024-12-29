<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\LoyaltyPoints;
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

    public function AddDiscountForm(){

        //Redirect to discount page
        return view('backend.add-discount'); 
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

    //Display Loyalty Points Page
    public function ShowLoyaltyPointsPage()
    {
        // Fetch loyalty points data
        $loyaltyPoints = LoyaltyPoints::all();
        // Redirect to loyalty points page
        return view('backend.loyalty-points', compact('loyaltyPoints'));
    }
}
