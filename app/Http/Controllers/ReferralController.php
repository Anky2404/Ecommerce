<?php

namespace App\Http\Controllers;

use App\Models\Referrals;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    //Show Referrals Lists
    public function ReferralLists(){

        //Fetch all referrals lists
        $referrals=Referrals::OrderBy('referred_at','DESC')->get();

        //Redirect to Referrals list page
        return view('backend.referrals', compact('referrals'));
    }
}
