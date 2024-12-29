<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;

class PaymentController extends Controller
{
    //Display Payment Lists
    public function PaymentLists()
    {
        // Logic to display payment lists
        $payments = Payments::all();
        return view('backend.payments', compact('payments'));
    }
}
