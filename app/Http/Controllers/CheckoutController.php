<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Ward;
use App\Models\Order;
use Mockery\Exception;
use App\Models\CartItem;
use App\Models\District;
use App\Models\Province;
use App\Models\OrderItem;
use App\Models\ShippingFee;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Hiển thị trang thanh toán
    // public function getProvinces()
    // {
    //     $provinces = Province::all();
    //     return view('locations.index', compact('provinces'));
    // }

    public function index()
{
    // Lấy danh sách đơn hàng của người dùng
    $userOrders = Order::where('user_id', Auth::id())->get();

    // Kiểm tra và cập nhật trạng thái
    foreach ($userOrders as $order) {
        if (
            $order->status === 'pending' &&
            $order->payment_method === 'VNPAY' && // Chỉ kiểm tra đơn hàng VNPAY
            $order->payment_expires_at < now()
        ) {
            $order->update(['status' => 'cancelled']);
        }
    }

    // Trả về view với danh sách đơn hàng
    return view('client.pages.orders.index', compact('userOrders'));
}

    public function getDistricts($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $wards = Ward::where('district_id', $districtId)->get();
        return response()->json($wards);
    }
    public function vnpayReturn(Request $request)
    {
        // Lấy thông tin phản hồi từ VNPAY
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        // Kiểm tra nếu giao dịch thành công (Mã phản hồi 00)
        if ($vnp_ResponseCode === "00") {
            // Lấy đơn hàng từ DB bằng vnp_TxnRef
            $order = Order::find($vnp_TxnRef);
    
            if ($order) {
                    $order->payment_status = 'paid'; // Cập nhật trạng thái đơn hàng thành 'paid'

                    $order->save();
    
                    return response()->json([
                        'message' => 'Thanh toán thành công!',
                        'order_id' => $order->id,
                    ], 200);
            } else {
                return response()->json([
                    'message' => 'Không tìm thấy đơn hàng.',
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Thanh toán không thành công.',
                'details' => 'Mã lỗi: ' . $vnp_ResponseCode,
            ], 400);
        }
    }
    
    

    public function checkout(Request $request)
{
    try {
        // Bắt đầu transaction
        DB::beginTransaction();

        // Debug dữ liệu nhận từ request
        $data = $request->all();
        Log::info('Checkout Data:', $data);

        // Kiểm tra payment_method
        if (!isset($data['payment_method'])) {
            return response()->json(['message' => 'Vui lòng chọn phương thức thanh toán!'], 400);
        }

        // Xử lý logic dựa trên phương thức thanh toán
        switch ($data['payment_method']) {
            case 'CASH':
                // Xử lý logic cho thanh toán COD (Cash On Delivery)
                Log::info('Thanh toán khi nhận hàng');

                // Tạo Order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_amount' => $data['total_amount'] ?? 0,
                    'status' => 'pending',
                    'payment_method' => $data['payment_method'],
                    'province' => $data['province_id'] ?? null,
                    'district' => $data['district'] ?? null,
                    'ward' => $data['ward'] ?? null,
                    'ship' => $data['ship'],
                    'payment_expires_at' => Carbon::now(),
                ]);

                // Kiểm tra và xử lý mảng product_sku và quantity
                if (isset($data['product_sku']) && is_array($data['product_sku']) && isset($data['quantity']) && is_array($data['quantity'])) {
                    foreach ($data['product_sku'] as $index => $sku) {
                        // Tạo OrderItem
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_sku' => $sku,
                            'quantity' => $data['quantity'][$index],
                        ]);

                        // Xóa sản phẩm khỏi giỏ hàng
                        $cart = Cart::where('user_id', Auth::id())->first();
                        if ($cart) {
                            CartItem::where('cart_id', $cart->id)
                                ->where('product_sku', $sku)
                                ->delete();
                        }
                    }
                } else {
                    Log::error('Invalid product data:', ['product_sku' => $data['product_sku'], 'quantity' => $data['quantity']]);
                    return response()->json(['message' => 'Invalid product data!'], 400);
                }

                // Commit transaction
                DB::commit();

                return redirect()->route('user.orders.index')->with([
                    'message' => 'Đơn hàng của bạn đã được tạo thành công!',
                    'details' => 'Chúng tôi đã nhận được đơn hàng của bạn và sẽ xử lý ngay lập tức. Cảm ơn bạn đã tin tưởng mua sắm tại cửa hàng!',
                    'order_id' => $order->id
                ]);
                
                break;


            case 'VNPAY':
                    Log::info('Thanh toán khi nhận hàng');

                    // Tạo Order
                    $order = Order::create([
                        'user_id' => Auth::id(),
                        'total_amount' => $data['total_amount'] ?? 0,
                        'status' => 'pending',
                        'payment_method' => $data['payment_method'],
                        'province' => $data['province_id'] ?? null,
                        'district' => $data['district'] ?? null,
                        'ward' => $data['ward'] ?? null,
                        'ship' => $data['ship'],
                        'payment_expires_at' => Carbon::now()->addMinute(15), // Hết hạn sau 15 phút
                    ]);
    
                    // Kiểm tra và xử lý mảng product_sku và quantity
                    if (isset($data['product_sku']) && is_array($data['product_sku']) && isset($data['quantity']) && is_array($data['quantity'])) {
                        foreach ($data['product_sku'] as $index => $sku) {
                            // Tạo OrderItem
                            OrderItem::create([
                                'order_id' => $order->id,
                                'product_sku' => $sku,
                                'quantity' => $data['quantity'][$index],
                            ]);
    
                            // Xóa sản phẩm khỏi giỏ hàng
                            $cart = Cart::where('user_id', Auth::id())->first();
                            if ($cart) {
                                CartItem::where('cart_id', $cart->id)
                                    ->where('product_sku', $sku)
                                    ->delete();
                            }
                        }
                    }
                    DB::commit();
                        // Thực hiện tạo URL thanh toán VNPAY
                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = route('vnpay.return');
                    $vnp_TmnCode = "0BQGSJLL";//Mã website tại VNPAY 
                    $vnp_HashSecret = "YYDH932FZ19XBC6F79BXIG833K2UO7ON"; //Chuỗi bí mật
                    $vnp_TxnRef = $order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                    $vnp_OrderInfo = 'thanh toán đơn hàng';
                    $vnp_OrderType = 'billpayment';
                    $vnp_Amount = ($order->total_amount+$order->ship) * 10000;
                    $vnp_Locale = 'vn';
                    $vnp_BankCode = 'NCB';
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                    );
                    
                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                    }
                    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                    }
                    
                    //var_dump($inputData);
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }
                    
                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    
                    $returnData = array('code' => '00'
                        , 'message' => 'success'
                        , 'data' => $vnp_Url);
                        if (isset($_POST['redirect'])) {
                            header('Location: ' . $vnp_Url);
                            die();
                        } else {
                            echo json_encode($returnData);
                        }
                        break;
    

    default:
                return response()->json(['message' => 'Phương thức thanh toán không hợp lệ!'], 400);
        }

    } catch (Exception $e) {
        // Rollback nếu có lỗi
        DB::rollBack();
        Log::error('Order creation failed:', ['error' => $e->getMessage()]);
        return response()->json([
            'message' => 'Rất tiếc, đã có lỗi xảy ra khi tạo đơn hàng.',
            'details' => 'Vui lòng thử lại sau. Nếu vấn đề vẫn tiếp tục, hãy liên hệ với chúng tôi để được hỗ trợ.',
            'error' => $e->getMessage()
        ], 500);
    }
}

    
    
    
    
    
    
    

    public function confirmCheckout(Request $request)
{
    // Cập nhật size, color và product_sku cho từng cart item
    if ($request->has('cart_item_id') && is_array($request->cart_item_id)) {
        foreach ($request->cart_item_id as $index => $cartItemId) {
            $cartItem = CartItem::find($cartItemId);
    
            if ($cartItem) {
                // Lấy size và color từ request hoặc giữ nguyên giá trị cũ
                $size = $request->size[$index] ?? $cartItem->size; // Lấy size từ request hoặc giữ nguyên
                $color = $request->color[$index] ?? $cartItem->color; // Lấy color từ request hoặc giữ nguyên
                $quantity = $request->quantity[$index] ?? $cartItem->quantity; // Lấy quantity từ request hoặc giữ nguyên
    
                // Cập nhật product_sku = product_id-size-color
                $productSku = "{$cartItem->product_id}-{$color}-{$size}";
    
                // In ra giá trị để kiểm tra
                // dd($request->size[$index], $request->color[$index], $request->quantity[$index], $productSku, $cartItem->product_id, $index); // Kiểm tra giá trị
    
                // Cập nhật các thông tin vào cơ sở dữ liệu
                $cartItem->update([
                    'size' => $size,
                    'color' => $color,
                    'quantity' => $quantity, // Cập nhật số lượng
                    'product_sku' => $productSku,
                ]);
            }
        }
    }
    
    

    // Kiểm tra nếu không có sản phẩm nào được chọn để thanh toán
    if (empty($request->cart_item_id)) {
        return redirect()->back()->with('message', 'Chưa chọn sản phẩm nào để thanh toán!');
    }

    // Lấy danh sách các sản phẩm đã chọn
    $cartItems = CartItem::whereIn('id', $request->cart_item_id)->get();

    // Tính tổng tiền thanh toán
    $totalAmount = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // Lấy danh sách tỉnh, quận, và phường
    $provinces = Province::all();
    $districts = District::where('province_id', $request->provinceId)->get();
    $wards = Ward::where('district_id', $request->districtId)->get();

    // Trả về view xác nhận thanh toán
    return view('client.pages.confirm_checkout', compact('cartItems', 'totalAmount', 'provinces', 'districts', 'wards'));
}

    
    
}
