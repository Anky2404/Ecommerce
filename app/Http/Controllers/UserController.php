<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\LoyaltyPoints;
use App\Models\Product;
use App\Models\Referrals;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Display the Customer Register Page
    public function CustomerRegisterPage()
    {
        //Redirect to register page
        return view('frontend.register');
    }
    // Display the Customer Profile
    public function CustomerProfile()
    {
        $customer = session('Customer');
        if ($customer) {
            $customer_id = $customer->id;

            //Get customer Loaylty point
            $totalPoints = LoyaltyPoints::where('customer_id', $customer->id)->sum('points');

            //Get Customer total Referrals
            $totalReferrals = Referrals::where('referred_by', $customer->id)->count('id');
            // Retrieve Customer details
            $customer = User::where('role_type', 'Customer')->where('id', $customer_id)->get()->first();
            return view('frontend.profile', compact('customer', 'totalPoints', 'totalReferrals'));
        }
    }

    public function UpdateCustomerProfile(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer|exists:users,id',
            'email' => 'email|unique:users,email,' . $request->customer_id,
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|in:Male,Female',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Get customer details by id
        $customer = User::find($request->customer_id);

         // Get the customer's details 
         $customer_details = UserDetails::where('user_id', $request->customer_id)->first();

       
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer_details->gender = $request->gender;

        // Handle profile image upload 
        if ($request->hasFile('profile_img')) {
            // Get the uploaded image file
            $image = $request->file('profile_img');

            // Generate a unique filename
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image in the directory
            $image->move(public_path('uploads/user_img'), $imageName);

            // Save the image path in the database
            $customer_details->profile_img = $imageName;
        }

        // Save the updated customer & details model
        $customer->save();
        $customer_details->save();

        return redirect()->route('user.profile')->with('success' ,'Profile updated successfully');
       
    }

    // Display the list of customers
    public function ShowCustomer()
    {
        // Retrieve customers with the 'Customer' role type
        $customers = User::where('role_type', 'Customer')->get();
        return view('backend.customers', compact('customers'));
    }

    // Display the list of staff
    public function ShowStaff()
    {
        // Retrieve staffs with the 'Staff' role type
        $staffs = User::where('role_type', 'Staff')->get();
        return view('backend.staffs', compact('staffs'));
    }

    //Display the add staff form
    public function AddStaffForm()
    {
        return view('backend.add-staff');
    }

    // Add a new staff
    public function AddStaff(Request $request)
    {
        //validate the request data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:255',
            'password' => 'required|min:8',
            'dob' => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }

        //Create a new staff
        $staff = new User();
        $staff->firstname = $request->firstname;
        $staff->lastname = $request->lastname;
        $staff->email = $request->email;
        $staff->phone = $request->phone_number;
        $staff->dob = $request->dob;
        $staff->is_active = 1;
        $staff->role_type = 'Staff';
        $staff->password = md5($request->password);
        $staff->save();

        //Return success response
        return redirect()->route('admin.staffs')->with('success', 'New Staff Added Successfully.');
    }

    //Inactivate a customer
    public function UpdateStatus(Request $request)
    {
        //Get request data
        $table = $request->table;
        $id = $request->id;
        $status = $request->status;

        //Update the status
        if ($table == 'users') {
            $user = User::find($id);
            $user->is_active = $status;
            $user->save();

            //Return success response
            return response()->json(['status' => 'success', 'message' => 'Status updated successfully.']);
        }

        if ($table == 'categories') {
            $category = Category::find($id);
            $category->is_active = $status;
            $category->save();
            //Return success response
            return response()->json(['status' => 'success', 'message' => 'Status updated successfully.']);
        }

        if ($table == 'products') {
            $product = Product::find($id);
            $product->is_active = $status;
            $product->save();
            //Return success response
            return response()->json(['status' => 'success', 'message' => 'Status updated successfully.']);
        }
    }


    // Admin login method
    public function admin_login(Request $request)
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
                return back()->with('status', 'User is not active');
            }

            // Check if the user has admin role
            if ($user->role_type != 'Admin') {
                return back()->with('status', 'You are not authorized to login as admin');
            }

            // Check if the user's account is verified
            if ($user->is_verified_account != 1) {
                return back()->with('status', 'Your account is not verified');
            }

            // Check if the password matches
            if ($user->password != md5($request->password)) {
                return back()->with('status', 'Incorrect password');
            }

            // Login the user
            Auth::login($user);

            // Store the user object in session
            session(['Admin' => $user]);

            // Redirect to the admin dashboard after successful login
            return redirect()->route('admin.dashboard');
        } else {
            // If the user is not found
            return back()->with('status', 'User not found');
        }
    }






    public function admin_register(Request $request)
    {
        // Validate the new user
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|min:8',
            'dob' => 'required|date',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Create the new user
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->is_active = 1;
        $user->role_type = 'Staff';
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.login')->with('status', 'User created successfully.');
    }
}
