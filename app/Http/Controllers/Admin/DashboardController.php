<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $productQty = Product::count();
        $userQty = User::where('type', 'member')->count();
        $adminQty = User::where('type', 'admin')->count();
        $orderQty = Order::count();
        $totalMoney = Order::all()->sum('total_amount');
        $totalMoneyThisMonth = Order::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');

        return view("admin.pages.dashboard", compact('productQty', 'userQty', 'orderQty', 'totalMoney', 'totalMoneyThisMonth', 'adminQty'));
    }

    public function getEarningsData()
    {
        $orders = Order::all();

        $monthlyEarnings = array_fill(0, 12, 0);

        foreach ($orders as $order) {
            $month = Carbon::parse($order->created_at)->month;

            $monthlyEarnings[$month - 1] += $order->total_amount;
        }

        return response()->json([
            'monthlyEarnings' => $monthlyEarnings
        ]);
    }
}
