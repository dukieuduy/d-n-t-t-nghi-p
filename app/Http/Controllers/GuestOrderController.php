<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\GuestBuyer;
use Illuminate\Http\Request;

class GuestOrderController extends Controller
{
    // Hiển thị form nhập số điện thoại
    public function showPhoneForm()
    {
        return view('client.pages.guest.verify'); // View chứa form nhập số điện thoại
    }

    // Kiểm tra số điện thoại và hiển thị các đơn hàng
    public function showOrders(Request $request)
    {
        // Validate số điện thoại
        $request->validate([
            'phone_number' => 'required|regex:/^(0[35789])[0-9]{8}$/',
        ],[
            'phone_number.required' => 'Số điện thoại không được để trống.',
            'phone_number.regex' => 'Số điện thoại không đúng định dạng.',]);

        // Tìm người mua dựa trên số điện thoại
       // Tìm tất cả các người mua theo số điện thoại
        $guestBuyers = GuestBuyer::where('phone_number', $request->phone_number)->get();

        // Kiểm tra nếu không có người mua nào
        if ($guestBuyers->isEmpty()) {
            return redirect()->route('guest.order.verify')
                ->with('error', 'Không tìm thấy người mua với số điện thoại này.');
        }

        // Khởi tạo mảng để chứa các đơn hàng
        $orders = collect();

        // Lặp qua tất cả GuestBuyer để lấy đơn hàng tương ứng
        foreach ($guestBuyers as $guestBuyer) {
            // Tìm các đơn hàng tương ứng với order_id của mỗi GuestBuyer
            $order = Order::where('id', $guestBuyer->order_id)->first();
            
            // Nếu tìm thấy đơn hàng, thêm vào mảng orders
            if ($order) {
                $orders->push($order);
            }
        }

        // Kiểm tra nếu không tìm thấy đơn hàng nào
        if ($orders->isEmpty()) {
            return redirect()->route('guest.order.verify')
                ->with('error', 'Không tìm thấy đơn hàng với mã này.');
        }
        // Hiển thị thông tin đơn hàng
        return view('client.pages.guest.order', compact('orders','guestBuyers'));
    }
    public function show($id)
    {
        $order=Order::where('id', $id)->get();
        // Lấy tất cả các order_items liên quan đến order_id
        $orderItems = OrderItem::where('order_id', $id)->get();
    
        if ($orderItems->isEmpty()) {
            return redirect()->route('guest.order.verify')
                ->with('error', 'Không tìm thấy sản phẩm trong đơn hàng này.');
        }
    
        // Hiển thị chi tiết đơn hàng
        return view('client.pages.guest.detail', compact('orderItems','order'));
    }
    

}
