<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Referrals;

class LoginController extends Controller
{
    //Display Customer Register page
    public function CustomerRegisterPage()
    {
        // Retrieve Customer details
        $customers = User::where('role_type', 'Customer')->get();
        //Redirect to register page
        return view('frontend.register',compact('customers'));
    }

    //Handle Customer Register form
    public function CustomerRegister(Request $request)
    {
        //validate the request data
        $validator= Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|min:8',
            'dob' => 'required|date',
        ]);

        //If validator fails redirect back
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }

        // Create a new user
        $user = new User();
         $user->firstname = $request->firstname;
         $user->lastname = $request->lastname;
         $user->email = $request->email;
         $user->phone = $request->phone;
         $user->dob = $request->dob;  
         $user->is_active = 1;  
         $user->role_type = 'Customer';
         $user->password = md5($request->password);
         $user->save(); 

         //Store referrernce details
            if($request->referred_by!=""){
                $referral = new Referrals();
                $referral->referred_by = $request->referred_by;
                $referral->referred_to =  $user->id;
                $referral->referral_code = $request->referral_code;
                $referral->save();
            }

        //Return success response
        return redirect()->route('user.login-page')->with('success', 'You have been successfully registered.');

        
    }

    //Display Customer Login Page
    public function CustomerLoginPage(){

        //Redirect to register page
        return view('frontend.login');
    }

    //Handle Customer Login 
    public function CustomerLogin(Request $request)
    {
        // Validate login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Check if the user exists
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // Check if the user is active
            if ($user->is_active != 1) {
                return back()->with('error', 'User is not active');
            }
    
            // Check if the user has admin role
            if ($user->role_type != 'Customer') {
                return back()->with('error', 'You are not authorized to login as customer');
            }
    
            // Check if the user's account is verified
            if ($user->is_verified_account != 1) {
                return back()->with('error', 'Your account is not verified');
            }
    
            // Check if the password matches
            if ($user->password!=md5($request->password)) {
                return back()->with('error', 'Incorrect password');
            }
    
            // Login the user
            Auth::login($user);

            // Store the user object in session
            session(['Customer' => $user]);
    
            // Redirect to the admin dashboard after successful login
            return redirect()->route('user.home');
        } else {
            // If the user is not found
            return back()->with('error', 'User not found');
        }
    }

    public function AdminLogout()
{
    // Check if the logged-in an admin
    if (Auth::check() && session('Admin')) {
        // Log out the authenticated admin user
        Auth::logout();

        // Clear the 'Admin' session data
        Session::forget('Admin');

        // Redirect to the login page 
        return redirect()->route('admin.login'); 
    }

   
}

//Customer logout function
public function CustomerLogout()
{
    // Check if the logged-in an customer
    if (Auth::check() && session('Customer')) {
        // Log out the authenticated Customer user
        Auth::logout();

        // Clear the 'Customer' session data
        Session::forget('Customer');

        // Redirect to the login page 
        return redirect()->route('user.login-page'); 
    }
   
}



}
