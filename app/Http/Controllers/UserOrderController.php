<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            // Nếu người dùng đã đăng nhập, hiển thị đơn hàng của họ
            $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
            return view('client.pages.orders.index', compact('orders'));
        } else {
            // Nếu chưa đăng nhập, chuyển đến trang nhập số điện thoại
            return redirect()->route('user.orders.verify_phone');
        }
    }

    // Hiển thị form nhập số điện thoại
    public function verifyPhone()
    {
        return view('client.pages.orders.verify_phone');
    }

    // Xử lý xác minh số điện thoại
    public function checkPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10', // Kiểm tra số điện thoại phải đủ 10 chữ số
        ]);

        // Kiểm tra đơn hàng với số điện thoại đã nhập
        $orders = Order::where('phone', $request->phone)->latest()->paginate(10);

        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng với số điện thoại này.');
        }

        // Nếu tìm thấy đơn hàng, hiển thị danh sách
        return view('client.pages.orders.index', compact('orders'));
    }
    public function cancel($orderId)
    {
        // Lấy đơn hàng theo ID
        $order = Order::findOrFail($orderId);

        // Kiểm tra nếu đơn hàng đang ở trạng thái "Đang chờ thanh toán"
        if ($order->status === 'pending') {
            // Cập nhật trạng thái đơn hàng thành "Đã hủy"
            $order->status = 'cancelled';
            $order->shipping_status = 'cancelled';
            $order->save();
        }

        // Quay lại trang danh sách đơn hàng
        return redirect()->route('user.orders.index')->with('success', 'Đơn hàng đã được hủy.');
    }
}

