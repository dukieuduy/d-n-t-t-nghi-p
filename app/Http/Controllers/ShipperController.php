<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ShipperController extends Controller
{
    /**
     * Hiển thị danh sách các đơn hàng đã được xác nhận hoặc đang giao.
     */
    public function confirmedOrders()
    {
        // Kiểm tra quyền truy cập
        if (auth()->user()->type !== 'shipper') {
            abort(403, 'Bạn không có quyền truy cập vào trang này.');
        }

        // Lấy danh sách các đơn hàng có trạng thái "confirmed" hoặc "shipping"
        // $orders = Order::whereIn('status', ['confirmed', 'shipping'])->get();
        $orders = Order::whereIn('status', ['confirmed', 'shipping'])
        ->with('user')  // Eager load user thông qua quan hệ đã định nghĩa
        ->get();

        return view('client.pages.shipper.confirmed_orders', compact('orders'));
    }

    /**
     * Xác nhận giao hàng (Chuyển trạng thái từ "confirmed" sang "shipping").
     */
    public function confirmDelivery(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }

        if ($order->status !== 'confirmed') {
            return redirect()->back()->with('error', 'Chỉ có thể xác nhận giao hàng với các đơn hàng đã được xác nhận.');
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = 'shipping';
        $order->save();

        return redirect()->back()->with('success', 'Đã xác nhận giao hàng cho đơn hàng #' . $order->id);
    }

    /**
     * Hoàn đơn (Chuyển trạng thái từ "shipping" sang "returned").
     */
    public function returnOrder($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }

        if ($order->status !== 'shipping') {
            return redirect()->back()->with('error', 'Chỉ có thể hoàn đơn với các đơn hàng đang được giao.');
        }

        $order->status = 'returned';
        $order->save();

        return redirect()->back()->with('success', 'Đã hoàn đơn cho đơn hàng #' . $order->id);
    }

    /**
     * Hoàn thành đơn hàng (Chuyển trạng thái từ "shipping" sang "completed").
     */
    public function completeOrder($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }

        if ($order->status !== 'shipping') {
            return redirect()->back()->with('error', 'Chỉ có thể hoàn thành các đơn hàng đang được giao.');
        }

        $order->status = 'completed';
        $order->payment_status= 'paid';
        $order->save();

        return redirect()->back()->with('success', 'Đã hoàn thành đơn hàng #' . $order->id);
    }
}
