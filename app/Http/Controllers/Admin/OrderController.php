<?php
namespace App\Http\Controllers\Admin;
use App\Models\Ward;
use App\Models\Order;
use App\Models\District;
use App\Models\Province;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        // Áp dụng middleware auth để đảm bảo chỉ người dùng đã đăng nhập mới có thể truy cập
        $this->middleware('auth');
    }

    public function index(Request $request)
        {
            // Lấy tất cả đơn hàng của người dùng hiện tại với khả năng lọc theo trạng thái
            $query = Order::where('user_id', Auth::id());

            if ($request->has('status') && $request->status != 'all') {
                $query->where('status', $request->status);
            }

            $orders = $query->get();

            return view('admin.order.index', compact('orders'));
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

    return view('admin.order.detail', compact('order', 'province', 'district', 'ward'));
}



public function update(Request $request, $id)
{
    // Validate dữ liệu
    $request->validate([
        'status' => 'required|in:pending,completed,cancelled,paid,confirmed',
        'total_amount' => 'required|numeric',
        'payment_method' => 'required|string',
    ]);

    // Lấy đơn hàng từ DB
    $order = Order::findOrFail($id);

        // Xử lý thay đổi trạng thái
        if ($request->status === 'confirmed') {
            // Nếu status là confirmed, cập nhật shipping_status thành 'shipped' (đang giao)
            $order->shipping_status = 'shipped';
        } elseif ($request->status === 'completed') {
            // Nếu status là completed, cập nhật shipping_status thành 'delivered' (đã giao thành công)
            $order->shipping_status = 'delivered';
        } elseif ($request->status === 'cancelled') {
            // Nếu status là cancelled, cập nhật shipping_status thành 'cancelled' (đã hủy đơn hàng)
            $order->shipping_status = 'cancelled';
        }
    // Cập nhật các thông tin khác của đơn hàng
    $order->update([
        'status' => $request->status,
        'total_amount' => $request->total_amount,
        'payment_method' => $request->payment_method,
    ]);

    // Cập nhật các OrderItem nếu cần thiết
    foreach ($request->order_items as $item_id => $item_data) {
        $orderItem = OrderItem::find($item_id);
        if ($orderItem) {
            $orderItem->update([
                'quantity' => $item_data['quantity'],
                'price' => $item_data['price'],
            ]);
        }
    }

    return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập nhật thành công!');
}

//     public function updateStatus(Request $request, $id)
// {
//     // Lấy đơn hàng từ DB
//     $order = Order::findOrFail($id);

//     // Cập nhật trạng thái đơn hàng
//     $order->status = $request->input('status');

//     // Kiểm tra nếu status là 'confirmed', cập nhật shipping_status thành 'shipped'
//     if ($order->status === 'confirmed') {
//         $order->shipping_status = 'shipped'; // Đang giao
//     }
//     // Kiểm tra nếu status là 'completed', cập nhật shipping_status thành 'delivered'
//     elseif ($order->status === 'completed') {
//         $order->shipping_status = 'delivered'; // Đã giao thành công
//     }elseif ($order->status === 'cancelled') {
//         // Nếu status là cancelled, cập nhật shipping_status thành 'cancelled' (đã hủy đơn hàng)
//         $order->shipping_status = 'cancelled';
//     }
    

//     // Lưu lại thay đổi
//     $order->save();

//     return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');
// }
public function updateStatus(Request $request, $id)
{
    // Lấy đơn hàng từ DB
    $order = Order::findOrFail($id);

    // Cập nhật trạng thái đơn hàng
    $order->status = $request->input('status');

    // Kiểm tra nếu status là 'confirmed', cập nhật shipping_status thành 'shipped'
    if ($order->status === 'confirmed') {
        $order->shipping_status = 'shipped'; // Đang giao

        // Lấy danh sách order items của đơn hàng
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        foreach ($orderItems as $item) {
            // Lấy product variation thông qua SKU
            $productVariation = ProductVariation::where('sku', $item->product_sku)->first();

            if ($productVariation) {
                // Cập nhật stock_quantity
                $productVariation->stock_quantity -= $item->quantity;
                $productVariation->save();
            }
        }
    }
    // Kiểm tra nếu status là 'completed', cập nhật shipping_status thành 'delivered'
    elseif ($order->status === 'completed') {
        $order->shipping_status = 'delivered'; // Đã giao thành công
    }
    elseif ($order->status === 'cancelled') {
        // Nếu status là cancelled, cập nhật shipping_status thành 'cancelled' (đã hủy đơn hàng)
        $order->shipping_status = 'cancelled';
    }

    // Lưu lại thay đổi của đơn hàng
    $order->save();

    return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');
}

    

public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
}

}
