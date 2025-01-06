<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $title = ["User", 'user'];

    public function index()
    {
        $title =$this->title;
        $index = Customer::with('orders.orderitem')->latest()->get();
        // return response()->json($index);
        return view('admin.user.index', compact('index', 'title'));
    }

    public function dashboard()
    {
        $data = User::findOrFail(auth()->id());
        $cartCount = Cart::count();
        return view('frontend.user.dashboard', compact('data', 'cartCount'));
    }
    public function show()
    {
        $data = User::findOrFail(auth()->id());
        return view('frontend.user.profile', compact('data'));
    }
    public function purchaseHistory()
    {
        $data = User::with('orders')->findOrFail(auth()->id());
        return view('frontend.user.purchase_history', compact('data'));
    }
    public function invoiceCustomer($id)
    {
        $data = Order::findOrFail($id);
        return view('frontend.user.invoice', compact('data'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' =>[ 'confirmed'],
    	]);

        // return $request->all();
        $user = User::findOrFail(auth()->user()->id);
        $data = $request->all();
        $image = $request->file('avatar');
        if ($image) {
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'images/'.$this->title[1].'/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            if (file_exists($user->avatar)) {
                unlink(public_path($user->avatar));
            }
            $data['avatar'] =  $image_url ?? $user->avatar;
        }

        if($request->password)
        {
            $data['password']  =  Hash::make($request->password);
        }else{
            $data['password']  = $user->password;

        }
        $user->update($data);

        $notification = array(
            'messege' => 'Profile is update successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (file_exists($user->avatar)) {
            unlink(public_path($user->avatar));
        }
        $user->delete();

        $notification = array(
            'messege' => 'Data is Deleted!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
