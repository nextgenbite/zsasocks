<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Hash};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Define Carbon instances for today and 30 days ago
        $today = Carbon::today();
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        // Fetch orders with status 2 and related products for the last 30 days
        $orders = Order::with('orderitem.product')
            ->where('status', 2)

            ->get();


        // Calculate total expenses for the last 30 days
        $expense_month = Expense::where('date', '>=', $thirtyDaysAgo)
            ->where('date', '<=', $today)
            ->sum('amount');

        // Calculate today's total expenses
        $today_expense = Expense::where('date', $today)->sum('amount');

        // Fetch top products based on quantity sold in the last 30 days
        $top_products = OrderItem::select('product_id', DB::raw('SUM(qty) as total_quantity'))
        ->Where('updated_at', '>=', $thirtyDaysAgo)
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->with('product')
            ->get();

        // Count total users with role 'user'
        $total_users = User::where('role', 'user')->count();


        // Prepare data for the view
        $data = [
            'orders' => $orders,
            'today_expense' => $today_expense,
            'expense_month' => $expense_month,
            'order_item' => $top_products,
            'total_users' => $total_users,
        ];

        return view('admin.home', compact('data'));
    }







    public function changePassword()
    {
        return view('auth.passwords.update');
    }
    public function AdminUpdateChangePassword(Request $request)
    {
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = array(
                'message' => 'Password changed successfully. Please log in with your new password.',
                'alert-type' => 'success'
            );

            // Redirect to the login page after password change
            return redirect()->route('login')->with($notification);
        } else {
            $notification = array(
                'message' => 'Old password is incorrect. Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
