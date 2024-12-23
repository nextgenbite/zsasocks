<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\User;
use App\Exports\OrderExport;
use App\Imports\OrderUpdateImport;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\OrderPointService;
use App\Services\SMSService;
use Illuminate\Support\Facades\DB;

// use Xenon\LaravelBDSms\Facades\SMS;;

// use Xenon\LaravelBDSms\Provider\BulkSmsBD;
// use Xenon\LaravelBDSms\Sender;


class OrderController extends Controller
{
    public $title = ["Sales", 'order'];


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


        $adminText = $name . ", " . $phoneNumber . ', ';
        foreach ($carts as $cart) {
            $product_name = Product::find($cart->id)->sku;
            $product_color = $cart->options->color ?? '';
            $product_size = $cart->options->size ?? '';

            $adminText .= $product_name;
            if ($product_color) {
                $adminText .= ', ' . $product_color;
            }
            if ($product_size) {
                $adminText .= ', ' . $product_size;
            }
            $adminText .= ', ';
        }
        $adminText .= $total_price + $shipping_cost;
        $this->smsService->sendSms($setting->value, $adminText);

    }
    public function placeOrder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required|digits:11|numeric',
            'customer_address' => 'required',
            'shipping_type' => 'required',
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
        $total_price = 0;

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

                // Calculate total price
                $total_price = round(Cart::total() - $request->coupon);

                // Create the order
                $order = Order::create([
                    'name' => $request->customer_name,
                    'user_id' => $user->id,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'notes' => $request->customera_note,
                    'delivery_type' => $request->shipping_type,
                    'coupon' => $request->coupon,
                    'amount' => $total_price,
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
                    $this->sendSMSNotification($request->customer_name, $request->customer_phone, $carts, $total_price, $request->shipping_type);
                    // Clear the cart
                    Cart::destroy();

        $notification = [
            'messege' => 'Order is completed successfully!',
            'alert-type' => 'success'
        ];
        return view('frontend.order_confirmation', compact('order'))->with([
            'notification' => $notification,
            'fbq_purchase_value' => $order->amount - $order->coupon, // Pass value for FB Pixel
            'currency' => 'BDT'
        ]);
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


    public function index(Request $request)
    {
        $title = $this->title;

        if ($request->ajax()) {
            $data = Order::latest()->with('orderitem.product')->select('*');

            return datatables()->of($data)
                ->editColumn('created_at', function ($data) {
                    if ($data->created_at->isToday()) {
                        $formattedDate = $data->created_at->format('h:ia');
                    } else {
                        $formattedDate = $data->created_at->format('d/m/y');
                    }
                    return $formattedDate;
                })
                ->toJson();
        }

        return view('admin.orders.index', compact('title'));
    }

    public function show(Order $order)
    {

        $title = $this->title;
        return view('admin.orders.show', compact('title', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $title = $this->title;
        return view('admin.orders.edit', compact('order', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $subtotal = 0;
        foreach ($request->itemids as $key => $itemid) {
            $item = OrderItem::findOrFail($itemid);
            $item->update(['qty' => $request->quantity[$key], 'color' => $request->color[$key]]);
            $subtotal += $request->quantity[$key] *  $item->price;
        }
        $total = $order->delivery_type + $subtotal;
        $discount = $total - $request->total;
        $order->update(['amount' =>  $subtotal, 'coupon' => $discount]);
        $notification = array(
            'messege' => 'Data is updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function destroy(Order $order)
    {
        $order->delete();

        $notification = array(
            'messege' => 'Data is Deleted!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function sent(Order $order)
    {
        $order->update(['status' => 3]);
        //return response()->json($active);
        $title = $this->title;
        foreach ($order->orderitem as $key => $item) {
            $item->product->decrement('product_qty', $item->qty);
        }
        // Render the HTML using the order_rows_ssr view
        $html = view('admin.pertials.order_rows_ssr', ['item' => $order, 'title' => $title])->render();

        // Return the rendered HTML
        return response()->json(['html' => $html,'msg'=> 'Order is sent']);
    }
    public function return(Order $order)
    {
        $order->update(['status' => 4]);
        //return response()->json($active);
        $title = $this->title;
        foreach ($order->orderitem as $key => $item) {
            $item->product->increment('product_qty', $item->qty);
        }
        // Render the HTML using the order_rows_ssr view
        $html = view('admin.pertials.order_rows_ssr', ['item' => $order, 'title' => $title])->render();

        // Return the rendered HTML
        return response()->json(['html' => $html,'msg'=> 'Order is returned successfully']);
    }
    public function cancel(Order $order)
    {
        $order->update(['status' => 5]);
        //return response()->json($active);
        $title = $this->title;
        // Render the HTML using the order_rows_ssr view
        $html = view('admin.pertials.order_rows_ssr', ['item' => $order, 'title' => $title])->render();

        // Return the rendered HTML
        return response()->json(['html' => $html,'msg'=> 'Order is canceled successfully']);
    }
    public function delivered(Order $order)
    {
        $order->update(['status' => 2]);
        //return response()->json($active);
        $title = $this->title;
        // Award purchase points to the user
        $this->orderPointService->giveOrderPoints($order->user, $order);
        // Render the HTML using the order_rows_ssr view
        $html = view('admin.pertials.order_rows_ssr', ['item' => $order, 'title' => $title])->render();

        // Return the rendered HTML
        return response()->json(['html' => $html,'msg'=> 'Order is delivered successfully']);
    }
    public function orderConfirm(Request $request, Order $order)
    {
        if ($request->ajax()) {
            // Return a JSON response
            $order->update(['status' => 1]);

            $text = 'www.qbdbox.com থেকে অর্ডার করার জন্য আপনাকে ধন্যবাদ। আপনার অর্ডারটি কনফার্ম করা হয়েছে।';

            $this->smsService->sendSms($order->phone, $text);

            $title = $this->title;
            // Render the HTML using the order_rows_ssr view
            $html = view('admin.pertials.order_rows_ssr', ['item' => $order, 'title' => $title])->render();

            // Return the rendered HTML
            return response()->json(['html' => $html,'msg'=> 'Order is confirmed successfully']);
        } else {
            $order->update(['status' => 1]);
            // Redirect or return a regular response
            return redirect()->back()->with('success', 'Order confirmed successfully');
        }


        // $text ='আস্সালামুআলাইকুম
        // Quick BD Box এ আপনার অর্ডারকৃত পণ্যটি মাত্র আমাদের অফিস থেকে বের হয়েছে আপনার গন্তব্যের উদেশ্য।
        // আপনার পণ্যটি ট্র্যাকিং করতে নিচের লিংকটিতে ক্লিক করুন https://paperfly.com.bd
        // এন্ড আপনার অর্ডার ID টি পেস্ট করে Track Now তে ক্লিক করুন।
        // আপনার অর্ডার ID '.$request->order_id.'
        // ধন্যবাদ';
        //  $text ='
        //  আস্সালামুআলাইকুম,
        //  Quick BD Box এ আপনার অর্ডারটি কনফার্ম করা হয়েছে।
        //  ধন্যবাদ';
        // $text ='আস্সালামুআলাইকুম
        // Quick BD Box এ আপনার অর্ডারকৃত পণ্যটি মাত্র আমাদের অফিস থেকে বের হয়েছে আপনার গন্তব্যের উদেশ্য।
        // আপনার পণ্যটি ট্র্যাকিং করতে নিচের লিংকটিতে ক্লিক করুন https://paperfly.com.bd
        // এন্ড আপনার অর্ডার ID টি পেস্ট করে Track Now তে ক্লিক করুন।
        // আপনার অর্ডার ID '.$request->order_id.'
        // ধন্যবাদ';
        //  $text ='
        //  আস্সালামুআলাইকুম,
        //  Quick BD Box এ আপনার অর্ডারটি কনফার্ম করা হয়েছে।
        //  ধন্যবাদ';

        // $this->sendSms($order->phone,$text);
        //  if ($confirm) {
        //     $notification=array(
        //         'messege'=>'Order is Confirm!',
        //         'alert-type'=>'error'
        //         );
        //     };
        //     return  Redirect()->back()->with($notification);

    }
    // private function sendSms($number, $message)
    // {

    //     $url = "http://bulksmsbd.net/api/smsapi";
    //     $api_key = "uBY6ll0SEBBeU8P6EMTk";
    //     $senderid = "8809617611758";

    //     $data = [
    //         "api_key" => $api_key,
    //         "senderid" => $senderid,
    //         "number" => $number,
    //         "message" => $message
    //     ];

    //     $response = Http::post($url, $data);

    //     return $response->body();

    // }
    public function confirmation($id)
    {
        // return decrypt($request->order);
        try {

            $order = Order::findOrFail($id);
            // return view('order-confirmed', compact('order'));
            return view('frontend.order_confirmation', compact('order'));
        } catch (\Exception $e) {

            return response()->json(['error' => 'An error occurred while placing the order.'], 500);
        }
    }


    public function multipleDelete(Request $request)
    {
        //    return  dd($request->selected_ids);
        $selectedItems = $request->input('selected_ids', []);

        // Delete selected items
        Order::whereIn('id', $selectedItems)->delete();

        return response()->json(['message' => 'Selected items deleted successfully']);
    }


    public function exportSelected(Request $request)
    {
        $name = now() . '-selected_items.xlsx';
        $selectedIds = $request->input('selected_ids', []);
        return Excel::download(new OrderExport($selectedIds), $name);
    }

    public function itemRemove($id)
    {
        $data =  OrderItem::findOrFail($id);
        $data->order->amount = ($data->price *  $data->qty) - $data->order->amount;
        $data->order->save();
        $data->delete();
        $notification = array(
            'messege' => 'data is delete successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    //excel import with update


    public function updateData(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import(new OrderUpdateImport, $file);

        return redirect()->back()->with('success', 'Data updated successfully');
    }
// public function updateData(Request $request)
// {
//     $file = $request->file('excel_file');

//    return $data = Excel::toArray([], 'xlsx', $file); // Assuming the file is in XLSX format

//     foreach ($data[0] as $row) {
//         $user = User::where('email', $row['email'])->first();

//         if ($user) {
//             $user->update([
//                 'name' => $row['name'],
//                 // Add other fields to update as needed
//             ]);
//         }
//     }

//     return redirect()->back()->with('success', 'Data updated successfully');
// }
public function multiplePdf(Request $request)
{
    $title = $this->title;
    $selectedIds = $request->input('selected_ids', ''); // This will get the comma-separated string
    $data = Order::whereIn('id', explode(',', $selectedIds))->get(); // Split the string and fetch corresponding orders

    return view('admin.orders.print', compact('title', 'data'));
}
}
