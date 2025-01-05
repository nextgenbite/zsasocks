<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    ProductController,
    SliderController,
    CartController,
    CouponController,
    OrderController,
    IndexController,
    PosController,
    ExpenseController,
    ReportController,
    SmsController
};
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();


Route::middleware('auth:web', 'role:admin')->group(function () {
    Route::get('config/clear', function() {

        Artisan::call('optimize:clear');
    if (request()->ajax()) {
      return response()->json(['message' => 'optimized cleared']);
    }
    $notification = array(
      'message' => 'optimized cleared',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

    })->name('optimize.clear');
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

    //category
    Route::resource('admin/category', CategoryController::class);
    Route::get('admin/category/{id}/active', [CategoryController::class, 'active']);
    Route::get('admin/category/{id}/inactive', [CategoryController::class, 'inActive']);


    //product
    Route::resource('admin/product', ProductController::class);
    Route::get('admin/product/{id}/active', [ProductController::class, 'active']);
    Route::get('admin/product/{id}/inactive', [ProductController::class, 'inActive']);
    //slider
    Route::resource('admin/slider', SliderController::class);
    Route::get('admin/slider/{id}/active', [SliderController::class, 'active']);
    Route::get('admin/slider/{id}/inactive', [SliderController::class, 'inActive']);
    // Orders
    Route::resource('admin/order', OrderController::class);
    Route::get('admin/order/{order}/confirm', [OrderController::class, 'orderConfirm']);
    Route::get('admin/order/{order}/delivered', [OrderController::class, 'delivered']);
    Route::get('admin/order/{order}/sent', [OrderController::class, 'sent']);
    Route::get('admin/order/{order}/cancel', [OrderController::class, 'cancel']);
    Route::get('admin/order/{order}/return', [OrderController::class, 'return']);
    Route::post('/admin/orders/export-selected', [OrderController::class, 'exportSelected'])->name('order.export.selected');
    Route::get('/admin/order/export-excel', [OrderController::class, 'exportExcel'])->name('order.export');
    Route::post('/admin/order/multiple/delete', [OrderController::class, 'multipleDelete'])->name('multiple.order.delete');
    Route::get('/admin/orders/print', [OrderController::class, 'multiplePdf'])->name('order.print.selected');
    Route::get('/admin/order/item/remove/{id}', [OrderController::class, 'itemRemove'])->name('order.item.remove');
    Route::post('/admin/order/excel/update', [OrderController::class, 'updateData'])->name('order.excel.update');


  // Report
  Route::controller(ReportController::class)->group(function(){

    // Route::get('admin/report/profit-loss','profitLoss');
    Route::get('admin/report/product-stock','productStock');
    Route::get('admin/report/buying-product','buyingProduct');


    Route::post('/create-invoice','createInvoice');


   });


    Route::get('change/password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change.password');
    Route::post('change/password', [App\Http\Controllers\HomeController::class, 'AdminUpdateChangePassword'])->name('change.update');


    Route::resource('/admin/user', App\Http\Controllers\UserController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');
    Route::resource('/admin/delivery-cost', App\Http\Controllers\DeliveryCostController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');
    Route::resource('/admin/setting', App\Http\Controllers\SettingController::class)->only('index', 'store');
    Route::resource('/admin/page', App\Http\Controllers\PageController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');
    Route::resource('/admin/review', App\Http\Controllers\ReviewController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');



      // Route::get('admin/pos', [PosController::class, 'index']);
      // Route::post('admin/pos/add-cart', [PosController::class, 'addCart']);
      // Route::post('admin/pos/cart-update/{$rowId}', [PosController::class, 'cartUpdate']);
      // Route::get('admin/pos/cart-remove/{$rowId}', [PosController::class, 'destroy']);

});



Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/product/{slug}', [App\Http\Controllers\IndexController::class, 'ProductDetails'])->name('Product.Details');
Route::get('/category/{slug}', [App\Http\Controllers\IndexController::class, 'categoryWiseProduct'])->name('categorWiseProduct');
Route::post('/sub-category', [App\Http\Controllers\IndexController::class, 'subCategory'])->name('subCategory');
Route::get('/page/{slug}', [App\Http\Controllers\IndexController::class, 'page'])->name('page');
//cart
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/add-to-cart', [CartController::class, 'CartStore'])->name('Cart.Store');
Route::Patch('/update-cart', [CartController::class, 'CartUpdate'])->name('Cart.update');
Route::get('/view-cart', [CartController::class, 'CartView'])->name('Cart.view');
Route::get('/delete-cart/{rowId}', [CartController::class, 'CartDelete'])->name('Cart.Delete');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity']);
Route::get('/cart-increment/{rowId}', [CartController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartController::class, 'CartDecrement']);
Route::get('/cart/nav-cart-items', [CartController::class, 'navCartItems'])->name('navCartItems');
Route::post('/cart/redeem', [CartController::class, 'redeemPoint'])->name('redeem');

Route::get('/updateQuantity/{rowId}', [CartController::class, 'updateQuantity']);


// Orders
Route::post('/placeOrder', [OrderController::class, 'placeOrder']);
// Search
Route::post('/prodcut-search', [IndexController::class, 'prodcutSearch'])->name('search');
Route::post('/ajax-search', [IndexController::class, 'ajaxSearch'])->name('ajax.search');
Route::get('/order-confirmed/{id}', [OrderController::class, 'confirmation'])->name('order.confirmed');

// Route::get('/payment', [PaymentController::class, 'store'])->name('payment');

