<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'Admin'], function () {
    // Route to dashboard page
    Route::get('/Dashboard', [RouteController::class, 'index'])->name('admin.dashboard');

    // Redirect to the dashboard page
    Route::get('/', function () {
        return redirect('Admin/Dashboard');
    });


    // Route to category list page
    Route::get('/Categories', [CategoryController::class, 'categoryPage'])->name('admin.categories');

    Route::get('/AddCategory', function () {
        return view('backend.add-category');
    })->name('admin.add-category');

    Route::post('/AddCategory', [CategoryController::class, 'addCategory'])->name('admin.add-category');

    Route::get('/EditCategory/{cat_id}', [CategoryController::class, 'updateCategoryPage'])->name('admin.update-category-page');

    Route::post('/EditCategory', [CategoryController::class, 'updateCategory'])->name('admin.update-category');




    // Route to product list page
    Route::get('/admin/products/{cat_id?}', function ($cat_id = null) {
        return redirect()->route('admin.products', ['cat_id' => $cat_id]);
    });

    Route::get('/Products/{cat_id?}', [ProductController::class, 'showProducts'])->name('admin.products');

    Route::get('/AddProduct', [ProductController::class, 'AddProductForm'])->name('admin.add-product');

    Route::post('/AddProduct', [ProductController::class, 'AddProduct'])->name('admin.add-product');

    Route::get('/EditProduct/{pro_id}', [ProductController::class, 'UpdateProductForm'])->name('admin.update-product-page');

    Route::post('/EditProduct', [ProductController::class, 'UpdateProduct'])->name('admin.update-product');


    //Route to Product Variant Page
    Route::get('/ProductVariants/{pro_id}', [ProductController::class, 'ProductVariantPage'])->name('admin.product-variants');








    // Route to customer list page
    Route::get('/Customers', [UserController::class, 'ShowCustomer'])->name('admin.customers');

    Route::post('/UpdateStatus', [UserController::class, 'UpdateStatus'])->name('admin.update-status');

    Route::get('/AddStaff', [UserController::class, 'AddStaffForm'])->name('admin.add-staff');

    Route::post('/AddStaff', [UserController::class, 'AddStaff'])->name('admin.add-staff');

    Route::get('/Staffs', [UserController::class, 'ShowStaff'])->name('admin.staffs');




    Route::get('/Orders', [OrderController::class, 'ShowOrders'])->name('admin.orders');

    Route::get('/OrderItems/{order_id}', [OrderController::class, 'showOrderDetails'])->name('admin.order-items');

    Route::get('/Discounts', [DiscountController::class, 'ShowDiscountPage'])->name('admin.discount-page');

    Route::get('/AddDiscounts', [DiscountController::class, 'AddDiscountForm'])->name('admin.add-discount-page');

    Route::post('/Discount/Store', [DiscountController::class, 'AddDiscountForm'])->name('admin.store-discount');

    Route::get('/Update/Discounts/{id}', [DiscountController::class, 'UpdateDiscountForm'])->name('admin.edit-discount-page');





    Route::get('/LoyaltyPoints', [DiscountController::class, 'ShowLoyaltyPointsPage'])->name('admin.loyalty-points-page');

    Route::get('/Referrals', [ReferralController::class, 'ReferralLists'])->name('admin.referrals');

    Route::get('/Payments', [PaymentController::class, 'PaymentLists'])->name('admin.payments');

    Route::get('/Queries', [QueryController::class, 'QueryListPage'])->name('admin.queries');









    Route::get('/Login', function () {
        return view('backend.login');
    })->name('admin.login');

    Route::post('/Login', [UserController::class, 'admin_login'])->name('admin.login');
    Route::get('/Register', function () {
        return view('backend.register');
    })->name('admin.register');
    Route::post('/Register', [UserController::class, 'admin_register'])->name('admin.register');
});



//Frontend Routes
Route::get('/', [RouteController::class, 'HomePage'])->name('user.home');

//Route to about page
Route::get('/About', function () {
    return view('frontend.about');
})->name('user.about');

//Route to contact page                                     
Route::get('/Contact', function () {
    return view('frontend.contact');
})->name('user.contact');

//Route to product page
Route::get('/Shop', [RouteController::class, 'ProductPage'])->name('user.shop');

//Route to product details page
Route::get('/ProductDetails/{pro_id}', [RouteController::class, 'ProductDetailsPage'])->name('user.product-details');



//Route to cart page
Route::get('/Profile', [UserController::class, 'CustomerProfile'])->name('user.profile');

Route::get('/Customer/Orders', [OrderController::class, 'CustomerOrders'])->name('user.orders');

Route::get('/OrderDetails/{order_id}', [OrderController::class, 'CustomerOrderDetails'])->name('user.order-details');









//Route to cart page
Route::get('/Cart', [CartController::class, 'ShowCartList'])->name('user.cart');

//Route to update cart
Route::post('/Cart/Add', [CartController::class, 'AddCart'])->name('user.add-cart');


//Route to update cart
Route::post('/Cart/Update', [CartController::class, 'UpdateCart'])->name('user.cart-update');

//Route to remove item from cart
Route::delete('/remove-item/{id}', [CartController::class, 'RemoveItem']);


//Route to checkout page
Route::get('/Checkout', [CartController::class, 'CheckoutPage'])->name('user.checkout');

//Route to login page
Route::get('/CustomerLogin', [LoginController::class, 'CustomerLoginPage'])->name('user.login-page');

Route::post('/Login', [LoginController::class, 'CustomerLogin'])->name('user.login');


//Route to register page
Route::get('/CustomerRegister', [LoginController::class, 'CustomerRegisterPage'])->name('user.register-page');

//Route to register page
Route::post('/Register', [LoginController::class, 'CustomerRegister'])->name('user.register');
