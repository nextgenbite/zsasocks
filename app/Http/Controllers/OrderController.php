<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Exports\OrderExport;
use App\Imports\OrderUpdateImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// use Xenon\LaravelBDSms\Facades\SMS;;

// use Xenon\LaravelBDSms\Provider\BulkSmsBD;
// use Xenon\LaravelBDSms\Sender;


class OrderController extends Controller
{
    public $title = ["Sales", 'order'];



    public function placeOrder(Request $request)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|digits:11|numeric',
            'customer_address' => 'required|string|max:255',
            'shipping_type' => 'required|string|max:50',
            'coupon' => 'nullable|numeric|min:0', // Coupon validation
            'customera_note' => 'nullable|string|max:500', // Optional note
        ]);
    
        // Check for duplicate form submission using CSRF token
        if (!$request->session()->token() || $request->input('_token') !== $request->session()->token()) {
            return redirect()->back()->withInput()->withErrors([
                'messege' => 'Duplicate form submission detected.',
                'alert-type' => 'error'
            ]);
        }
    
        DB::beginTransaction(); // Start database transaction
    
        try {
            // Retrieve cart content
            $carts = Cart::content();
            if ($carts->isEmpty()) {
                return redirect()->back()->withInput()->withErrors([
                    'messege' => 'Please add some products to your cart!',
                    'alert-type' => 'error'
                ]);
            }
    
            // Create or update user
            $user = Customer::firstOrNew(['phone' => $request->customer_phone], [
                'name' => $request->customer_name,
                'phone' => $request->customer_phone,
                'address' => $request->customer_address,
                'email' => $request->customer_email,
            ]);
    
            if (!$user->exists) {
                $user->save();
            }
    
            // Calculate total price after applying coupon
            $cartTotal = Cart::total();
            $couponDiscount = $request->coupon ?? 0;
            $totalPrice = max(0, round($cartTotal - $couponDiscount)); // Ensure non-negative value
    
            // Create the order
            $order = Order::create([
                'name' => $request->customer_name,
                'customer_id' => $user->id,
                'phone' => $request->customer_phone,
                'address' => $request->customer_address,
                'email' => $request->customer_email,
                'notes' => $request->customera_note ?? '',
                'delivery_type' => $request->shipping_type,
                'coupon' => $couponDiscount,
                'amount' => $totalPrice,
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
            ]);
    
            // Insert order items
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'color' => $cart->options->color ?? '',
                    'size' => $cart->options->size ?? '',
                ]);
            }
    
            // Commit the transaction
            DB::commit();
    
            // Clear the cart
            Cart::destroy();
    
            // Return success notification and render order confirmation view
            return view('frontend.order_confirmation', compact('order'))->with([
                'notification' => [
                    'messege' => 'Order is completed successfully!',
                    'alert-type' => 'success'
                ]
            ]);
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();
    
            // Log the error for debugging
            Log::error('Order Placement Error: ' . $e->getMessage());
    
            // Return error notification
            return redirect()->back()->withInput()->withErrors([
                'messege' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
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



    }
   
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

public function multiplePdf(Request $request)
{
    $title = $this->title;
    $selectedIds = $request->input('selected_ids', ''); // This will get the comma-separated string
    $data = Order::whereIn('id', explode(',', $selectedIds))->get(); // Split the string and fetch corresponding orders

    return view('admin.orders.print', compact('title', 'data'));
}
}
