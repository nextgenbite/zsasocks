<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCost;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Services\OrderPointService;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\SMSService;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PosController extends Controller
{
    public $title = ["Point Of Sale", 'pos'];

    protected $orderPointService;
    protected $smsService;
    public function __construct(OrderPointService $orderPointService, SMSService $smsService)
    {
        $this->orderPointService = $orderPointService;
        $this->smsService = $smsService;
    }
    private function sendSMSNotification($name, $phoneNumber, $carts, $total_price, $shipping_cost)
    {
        $setting = Setting::where('key','phone')->first();
        $message = 'আস্সালামুআলাইকুম,আপনার অর্ডারটি সম্পূর্ণ হয়েছে। প্রোডাক্টটি পাঠানোর সময় আপনাকে SMS দিয়ে কনফার্ম করা হবে। হট লাইন:'.$setting->value ;

        $this->smsService->sendSMS($phoneNumber, $message);


        // $adminText = $name . ", " . $phoneNumber . ', ';
        // foreach ($carts as $cart) {
        //     $product_name = Product::find($cart->id)->sku;
        //     $product_color = $cart->options->color ?? '';
        //     $product_size = $cart->options->size ?? '';
        
        //     $adminText .= $product_name;
        //     if ($product_color) {
        //         $adminText .= ', ' . $product_color;
        //     }
        //     if ($product_size) {
        //         $adminText .= ', ' . $product_size;
        //     }
        //     $adminText .= ', ';
        // }
        // $adminText .= $total_price + $shipping_cost;
        // $this->smsService->sendSms($setting->value, $adminText);
        
    }
    public function index(){
        $title =$this->title;
        $product = Product::latest()->get();
        $shipping_cost = DeliveryCost::where('status', true)->orderBy('cost', 'asc')->get();
        return view('admin.pos.index',compact('title','product','shipping_cost'));

    } // End Method 

    public function createInvoice(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required|digits:11|numeric',
            'customer_address' => 'required',
            'shipping_type' => 'required',
            'total' => 'required',
        ]);
        // Check for duplicate form submission
        $token = $request->session()->get('_token');
        if ($request->input('_token') !== $token) {
            $notification = [
                'messege' => 'Duplicate form submission detected.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        DB::beginTransaction();  // Start transaction
        // Initialize variables for order and total price
        $order = null;
    
        try {
            $carts = Cart::content();
            if (count($carts) > 0) {
                // Create or retrieve the user
                $user = User::firstOrNew(['phone' => $request->customer_phone], [
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'password' => Hash::make($request->customer_phone),
                ]);
    
                if (!$user->exists) {
                    $user->save();
                }
    
    
                // Create the order
                $order = Order::create([
                    'name' => $request->customer_name,
                    'user_id' => $user->id,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'notes' => $request->customera_note,
                    'delivery_type' => $request->shipping_type,
                    'coupon' => $request->discount,
                    'amount' => $request->total,
                    'order_date' => Carbon::now()->format('d F Y'),
                    'order_month' => Carbon::now()->format('F'),
                    'order_year' => Carbon::now()->format('Y'),
                    'created_at' => Carbon::now(),
                ]);
    
                // Insert order items
                foreach ($carts as $cart) {
                    OrderItem::insert([
                        'order_id' => $order->id,
                        'product_id' => $cart->id,
                        'qty' => $cart->qty,
                        'price' => $cart->price,
                        'color' => $cart->options->color ?? '',
                        'size' => $cart->options->size ?? '',
                        'created_at' => Carbon::now(),
                    ]);
                }
                DB::commit();  // Commit transaction
                if ($order) {
                    $this->sendSMSNotification($request->customer_name, $request->customer_phone, $carts, $request->total, $request->shipping_type);
                    // Clear the cart
                    Cart::destroy();
                    $title = ["Sales", 'order'];
        $notification = [
            'messege' => 'Order is completed successfully!',
            'alert-type' => 'success'
        ];
        return view('admin.orders.show', compact('title','order'))->with($notification);
    }
            } else {
                throw new \Exception('Please add some products!');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            $notification = [
                'messege' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        } 
    }

    public function addCart(Request $request){
         $id = $request->id;
        $product = Product::findOrFail($id);
        $options = [];
            // Add color and size options if available
    if ($request->has('color')) {
        $options['color'] = $request->color;
    }
    if ($request->has('size')) {
        $options['size'] = $request->size;
    }
        Cart::add([
            'id' => $request->id, 
            'name' => $request->name, 
            'qty' => $request->qty, 
            'price' => $product->discount_price ?: $product->selling_price, 
            'weight' => 20, 
            'options' => $options
        ]);


         $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method 

    public function cartUpdate(Request $request,$rowId){

        $qty = $request->qty;
        $update = Cart::update($rowId,$qty);
         
         $notification = array(
            'message' => 'Cart Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method 

    public function destroy($rowId){

        Cart::remove($rowId);

        $notification = array(
            'message' => 'Cart Remove Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method 
}
