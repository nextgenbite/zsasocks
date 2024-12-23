<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Expense;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Hash};
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ReportController extends Controller
{
    public function profitLoss(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->fetchData($request->start_date, $request->end_date);
            return response()->json(array_values($data));
        }

        // Default date range, last 30 days
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        $result = $this->fetchData($startDate, $endDate);
        $title = ["Profit Or Loss", 'profit'];

        return view('admin.report.profit_loss', compact('result', 'title'));
    }

    public function fetchData($start_date, $end_date)
    {
        $startDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        // Fetch orders with total amount and delivery type
        $orders = Order::where('status', 2)
            ->select(
                DB::raw('DATE(updated_at) as date'),
                DB::raw('SUM(amount - COALESCE(coupon, 0)) as total_orders'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(delivery_type) as delivery_cost') // Example for delivery cost
            )
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(updated_at)'))
            ->get();

        // Fetch expenses
        $expenses = Expense::select(
            DB::raw('DATE(date) as date'),
            DB::raw('SUM(amount) as total_expenses')
        )
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(date)'))
            ->get();

        // Initialize data array with default values
        $data = [];
        $period = new \DatePeriod(
            $startDate,
            new \DateInterval('P1D'),
            $endDate->addDay()
        );

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $data[$formattedDate] = [
                'date' => $formattedDate,
                'total_orders' => 0,
                'orders_count' => 0,
                'delivery_cost' => 0,
                'total_expenses' => 0,
            ];
        }

        // Map orders data into the result
        foreach ($orders as $order) {
            $data[$order->date]['total_orders'] = $order->total_orders;
            $data[$order->date]['delivery_cost'] = $order->delivery_cost;
            $data[$order->date]['orders_count'] = $order->orders_count;
        }

        // Map expenses data into the result
        foreach ($expenses as $expense) {
            $data[$expense->date]['total_expenses'] = $expense->total_expenses;
        }

        return $data;
    }


    //   public  function profitLoss(Request $request)
    //   {
    //     $title =["Profit Or Loss", 'profit'];
    //     if ($request->ajax()) {
    //        $dateRange = $request->input('date_range');
    //       if ($dateRange && strpos($dateRange, ' to ') !== false) {
    //         $dateRange = explode(' to ', $dateRange);
    //           return   $orders = Order::with('orderitem.product')
    //             //  ->where('status', 2)
    //              ->whereBetween('created_at', [$dateRange[0], $dateRange[1]])
    //              ->orWhereBetween('updated_at', [$dateRange[0], $dateRange[1]])
    //              ->get();
    //     }else{
    //         return  $orders = Order::with('orderitem.product')
    //             //  ->where('status', 2)
    //             ->createdOrUpdated($dateRange)
    //              ->get();
    //     }
    //     }
    //         // Define Carbon instances for today and 30 days ago
    //         $today = Carbon::today();
    //         $thirtyDaysAgo = Carbon::now()->subDays(30);


    //         $startDate = Carbon::now()->subDays(60);
    //         $endDate = Carbon::now();

    //              // Fetch orders and expenses grouped by date
    //              $orders = Order::select(
    //                 DB::raw('DATE(created_at) as date'),
    //                 DB::raw('SUM(amount) as total_orders')
    //             )
    //             ->whereBetween('created_at', [$startDate, $endDate])
    //             ->groupBy('created_at')
    //             ->get();

    //         $expenses = Expense::select(
    //                 DB::raw('DATE(date) as date'),
    //                 DB::raw('SUM(amount) as total_expenses')
    //             )
    //             ->whereBetween('date', [$startDate, $endDate])
    //             ->groupBy('date')
    //             ->get();
    //             $data = [];
    //         foreach (range(0, 30) as $day) {
    //             $date = $startDate->copy()->addDays($day)->format('d-m-Y');
    //             $data[$date] = [
    //                 'date' => $date,
    //                 'total_orders' => 0,
    //                 'total_expenses' => 0,
    //             ];
    //         }
    //         foreach ($orders as $order) {
    //             $data[$order->date]['total_orders'] = $order->total_orders;
    //         }

    //         foreach ($expenses as $expense) {
    //             $data[$expense->date]['total_expenses'] = $expense->total_expenses;
    //         }

    //         // Convert to collection for further processing if needed
    //       return  $result = collect($data);
    //         // Fetch orders with status 2 and related products for the last 30 days
    //         // $orders = Order::with('orderitem.product')
    //         //     // ->where('status', 2)
    //         //     // ->createdOrUpdated($thirtyDaysAgo)
    //         //     ->get();

    //         // // Calculate total buying price and revenue for the last 30 days
    //         // $thisMonthTotalBuyingPrice = $orders->flatMap(function ($order) {
    //         //     return $order->orderitem;
    //         // })->sum(function ($orderItem) {
    //         //     return $orderItem->product->buying_price * $orderItem->qty;
    //         // });

    //         // $thisMonthOrdersPrice = $orders->sum(function ($order) {
    //         //     return $order->amount - $order->coupon ?? 0;
    //         // }) * 0.99; // Apply 1% discount

    //         // // Calculate total expenses for the last 30 days
    //         // $expense_month = Expense::where('date', '>=', $thirtyDaysAgo)
    //         //     ->where('date', '<=', $today)
    //         //     ->sum('amount');




    //         // // Prepare data for the view
    //         // $data = [
    //         //     'month_revenue' => $thisMonthOrdersPrice - ($thisMonthTotalBuyingPrice + $expense_month),
    //         //     'expense_month' => $expense_month,
    //         //     'month_sales' => $thisMonthOrdersPrice,
    //         //     'orders' => $orders,
    //         //     'result' => $result,
    //         // ];

    //         return view('admin.report.profit_loss', compact('data', 'result', 'title'));
    //   }
    public  function productStock()
    {
        $title = ["Product Stock", 'product'];
        $index = Product::select(['id', 'sku', 'selling_price', 'product_image', 'product_qty'])
            ->get();


        return view('admin.report.stock', compact('index', 'title'));
    }
    public  function buyingProduct()
    {
        $title = ["Buying Product", 'product'];
        $index = Product::select(['id', 'product_name', 'sku', 'buying_price', 'selling_price', 'product_image', 'product_qty'])
            ->get();
        $total = Product::select(DB::raw('SUM(buying_price * product_qty) as price'))->first()->price;
        return view('admin.report.buying_product', compact('index', 'title', 'total'));
    }
}
