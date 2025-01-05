<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\DeliveryCost;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Setting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CartController extends Controller
{
    public function checkout()
    {
        $data = [
            'content' => Cart::content(),
            'shipping_cost' => DeliveryCost::where('status', true)->orderBy('cost', 'asc')->get(),
            'count' => Cart::count(),
            'subtotal' => Cart::subtotal(),
            'discount' => Session::get('redeem') ? decrypt(Session::get('redeem')) : 0,
            'total' => Cart::total(),
        ];
        return view('frontend.checkout', compact('data'));
    }
    
public function CartStore(Request $request)
{
    $id = $request->id;
    $product = Product::findOrFail($id);

    $options = [
        'image' => $product->product_image
    ];

    // Add color and size options if available
    if ($request->has('color')) {
        $options['color'] = $request->color;
    }
    if ($request->has('size')) {
        $options['size'] = $request->size;
    }

    // Add the product to the cart with options
          $cart = Cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'qty' => $request->quantity,
            'price' => $product->discount_price ?: $product->selling_price,
            'weight' => 1,
            'options' => $options
        ]);

    // Fire AddToCart event to Facebook Pixel
    $fbq_script= "<script>
           fbq('track', 'AddToCart', {
               content_ids: ['" . $id . "'],
               content_type: 'product',
               value: " . round(($product->discount_price ?? $product->selling_price) * $request->quantity) . ", // Use discounted price if available
               currency: 'BDT'
           });
         </script> ";


    // Prepare the JSON response
$response_data = ['cart' => $cart, 'count' => Cart::count(), "fbq_script" => $fbq_script];

// Send JSON response
return response()->json($response_data);
}

    public function navCartItems()
    {
        
        $data = [
            'content' => Cart::content(),
            'count' => Cart::count(),
            'total' => Cart::total(),
        ];

        return view('frontend.partials.nav_cart_item', compact('data'))->render();

    }
    public function CartView()
    {
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total(60);
        $count =Cart::count();

    	return response()->json([
    		'count' => $count,
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal),

    	]);
    }
    public function CartDelete($rowId)
    {
        Cart::remove($rowId);
        $data = [
            'content' => Cart::content(),
            'shipping_cost' => DeliveryCost::where('status', true)->orderBy('cost', 'asc')->get(),
            'count' => Cart::count(),
            'subtotal' => Cart::subtotal(),
            'discount' => Session::get('redeem') ? decrypt(Session::get('redeem')) : 0,
            'total' => Cart::total(),
        ];
        $html = view('frontend.partials.checkout', compact('data'))->render();
        return response()->json($html);

    }
    // Cart updateQuantity
    public function updateQuantity(Request $request){
       
        Cart::update($request->key, $request->quantity);

        $data = [
            'content' => Cart::content(),
            'shipping_cost' => DeliveryCost::where('status', true)->orderBy('cost', 'asc')->get(),
            'count' => Cart::count(),
            'subtotal' => Cart::subtotal(),
            'discount' => Session::get('redeem') ? decrypt(Session::get('redeem')) : 0,
            'total' => Cart::total(),
        ];
        $html = view('frontend.partials.checkout', compact('data'))->render();
        return response()->json($html);

    } // end mehtod
    // Cart Increment
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);


        return response()->json('increment');

    } // end mehtod


   // Cart Decrement
    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        if($row->qty != 1){

            Cart::update($rowId, $row->qty - 1);
        }
        return response()->json('Decrement');

    }// end mehtod

    public function redeemPoint(Request $request){

        if (auth()->check()) {
            $setting = Setting::where('key', 'point')->first();
                   Session::put('redeem',encrypt($request->point / isset($setting->value) ? $setting->value: 0 ));
                   $notification = array(
                    'messege' => 'Redeem point added to your cart.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
        }
     

    } // end method
    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {

            Session::put('coupon',[
                'coupon_name' => encrypt($coupon->coupon_name),
                'coupon_discount' => encrypt($coupon->coupon_discount),
                'discount_amount' => encrypt(round(Cart::total() - $coupon->coupon_discount)),
                'total_amount' => encrypt(round(Cart::total() - $coupon->coupon_discount))
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));

        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    } // end method


    public function CouponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => decrypt(session()->get('coupon')['coupon_name']) ,
                'coupon_discount' => decrypt(session()->get('coupon')['coupon_discount']),
                'discount_amount' => decrypt(session()->get('coupon')['discount_amount']),
                'total_amount' => decrypt(session()->get('coupon')['total_amount']),
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));

        }
    } // end method


 // Remove Coupon
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }


}
