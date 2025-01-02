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
use App\Http\Middleware\Authenticate;
use Illuminate\Container\Attributes\Auth;

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

    Route::post('/SaveAddress', [OrderController::class, 'SaveAddress'])->name('user.save-address');

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

    Route::post('/Discount/Store', [DiscountController::class, 'StoreDiscount'])->name('admin.store-discount');

    Route::get('/Update/Discounts/{id}', [DiscountController::class, 'UpdateDiscountForm'])->name('admin.edit-discount-page');

    Route::post('/Update/Discounts', [DiscountController::class, 'UpdateDiscount'])->name('admin.update-discount');





    Route::get('/LoyaltyPoints', [DiscountController::class, 'ShowLoyaltyPointsPage'])->name('admin.loyalty-points-page');

    Route::get('/Referrals', [ReferralController::class, 'ReferralLists'])->name('admin.referrals');

    Route::get('/Payments', [PaymentController::class, 'PaymentLists'])->name('admin.payments');

    Route::get('/Queries', [QueryController::class, 'QueryListPage'])->name('admin.queries');



    Route::post('/orderItem/updateStatus', [OrderController::class, 'updateOrderItemStatus'])->name('order-item.updateStatus');
    Route::post('/order/updateStatus', [OrderController::class, 'updateOrderStatus'])->name('order.updateStatus');





    Route::get('/Login', function () {
        return view('backend.login');
    })->name('admin.login');

    Route::post('/Login/Admin', [UserController::class, 'admin_login'])->name('admin.login');
    Route::get('/Register', function () {
        return view('backend.register');
    })->name('admin.register');
    Route::get('/Logout', [LoginController::class, 'AdminLogout'])->name('admin.logout');
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

// Route for category filter
Route::get('/product/filter', [ProductController::class, 'filter'])->name('category.filter');

//Route to cart page
Route::get('/Profile', [UserController::class, 'CustomerProfile'])->name('user.profile');

//Route to cart page
Route::post('/Profile/Update', [UserController::class, 'UpdateCustomerProfile'])->name('user.update-profile');

//Route to placed order
Route::post('/PlaceOrder', [OrderController::class, 'PlacedOrder'])->name('user.place-order');


Route::get('/Customer/Orders', [OrderController::class, 'CustomerOrders'])->name('user.orders')->middleware(Authenticate::class);

Route::get('/OrderDetails/{order_id}', [OrderController::class, 'CustomerOrderDetails'])->name('user.order-details')->middleware(Authenticate::class);

//Route to cart page
Route::get('/Cart', [CartController::class, 'ShowCartList'])->name('user.cart')->middleware(Authenticate::class);

//Route to update cart
Route::post('/Cart/Add', [CartController::class, 'AddCart'])->name('user.add-cart')->middleware(Authenticate::class);


//Route to update cart
Route::post('/Cart/Update', [CartController::class, 'UpdateCart'])->name('user.cart-update')->middleware(Authenticate::class);

//Route to remove item from cart
Route::delete('/remove-item/{id}', [CartController::class, 'RemoveItem'])->middleware(Authenticate::class);


//Route to checkout page
Route::get('/Checkout', [CartController::class, 'CheckoutPage'])->name('user.checkout')->middleware(Authenticate::class);

//Route to login page
Route::get('/Login', [LoginController::class, 'CustomerLoginPage'])->name('user.login-page');

Route::post('/LoginCustomer', [LoginController::class, 'CustomerLogin'])->name('user.login');

Route::post('/Sent/Query', [RouteController::class, 'SentQuery'])->name('user.sent-queries');

//Route to register page
Route::get('/CustomerRegister', [LoginController::class, 'CustomerRegisterPage'])->name('user.register-page');

//Route to register page
Route::post('/Register', [LoginController::class, 'CustomerRegister'])->name('user.register');

Route::get('/Logout', [LoginController::class, 'CustomerLogout'])->name('user.logout');