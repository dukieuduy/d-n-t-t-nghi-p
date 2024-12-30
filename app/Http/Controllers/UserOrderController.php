<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\Order;
use App\Models\District;
use App\Models\Province;
use App\Models\CancelOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            // Nếu người dùng đã đăng nhập, hiển thị đơn hàng của họ
            $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
            // dd($orders);
            return view('client.pages.orders.index', compact('orders'));
        } else {
            // Nếu chưa đăng nhập, chuyển đến trang nhập số điện thoại
            return redirect()->route('user.orders.verify_phone');
        }
    }
    public function detail($id)
    {
        $order = Order::with([
            'user',
            'orderItems.productVariation',          // Eager load productVariation từ orderItems
            'orderItems.productVariation.product',   // Eager load product từ productVariation
            'province',
            'district',
            'ward'
        ])->findOrFail($id);
        
        // Lấy tỉnh, huyện, xã từ ID
        $province = Province::find($order->province);
        $district = District::find($order->district);
        $ward = Ward::find($order->ward);

        return view('client.pages.orders.detail', compact('order', 'province', 'district', 'ward'));
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
    // public function cancel($orderId)
    // {
    //     // Lấy đơn hàng theo ID
    //     $order = Order::findOrFail($orderId);

    //     // Kiểm tra nếu đơn hàng đang ở trạng thái "Đang chờ thanh toán"
    //     if ($order->status === 'pending') {
    //         // Cập nhật trạng thái đơn hàng thành "Đã hủy"
    //         $order->status = 'cancelled';
    //         $order->shipping_status = 'cancelled';
    //         $order->save();
    //     }

    //     // Quay lại trang danh sách đơn hàng
    //     return redirect()->route('user.orders.index')->with('success', 'Đơn hàng đã được hủy.');
    // }
    public function cancel(Request $request, $orderId)
    {
        // Lấy đơn hàng từ cơ sở dữ liệu
        $order = Order::findOrFail($orderId);

        // Cập nhật trạng thái đơn hàng
        $order->status = 'cancelled';
        $order->save(); // Lưu trạng thái mới của đơn hàng

        // Tạo một bản ghi mới trong bảng cancel_orders để lưu lý do hủy
        CancelOrder::create([
            'user_id' => auth()->id(), // Lưu ID của người dùng hiện tại
            'order_id' => $order->id, // Lưu ID của đơn hàng bị hủy
            'reason' => $request->input('reason'), // Lưu lý do hủy
        ]);

        // Quay lại trang danh sách đơn hàng với thông báo thành công
        return redirect()->route('user.orders.index')->with('success', 'Đơn hàng đã được hủy.');
    }
    public function reorder($id)
{
    $order = Order::findOrFail($id);

    // Kiểm tra nếu trạng thái hiện tại là 'cancelled'
    if ($order->status === 'cancelled') {
        // Cập nhật trạng thái thành 'pending'
        $order->status = 'pending';
        $order->save();

        return redirect()->route('user.orders.index')->with('success', 'Đặt hàng lại thành công!');
    }

    // Nếu không phải trạng thái 'cancelled', báo lỗi
    return redirect()->route('user.orders.index')->with('error', 'Chỉ có thể đặt lại đơn hàng đã hủy.');
}


}

