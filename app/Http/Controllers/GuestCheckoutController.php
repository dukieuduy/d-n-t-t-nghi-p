<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Ward;
use App\Models\Order;
use \App\Models\Product;
use App\Models\CartItem;
use App\Models\Discount;
use App\Models\District;
use App\Models\Province;
use App\Models\OrderItem;
use App\Models\GuestBuyer;
use Illuminate\Http\Request;
use App\Models\OrderDiscount;
use Illuminate\Support\Carbon;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GuestCheckoutController extends Controller
{
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
    // Phương thức xử lý cho khách chưa đăng nhập
    public function guestCheckout(Request $request,$id_product, $color, $size, $quantity)
    {
        // Ghép SKU từ id_product, color, size
        $provinces = Province::all();
        $districts = District::where('province_id', $request->provinceId)->get();
        $wards = Ward::where('district_id', $request->districtId)->get();
        $sku = "{$id_product}-{$color}-{$size}";

        // Truy vấn bảng ProductVariation để tìm thông tin sản phẩm dựa trên SKU
        $productVariation = ProductVariation::with('product') // Eager loading product
            ->where('sku', $sku)
            ->first();
        $totalPrice = $productVariation->price * $quantity;
        $discounts = Discount::where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->where('is_active', 1)
                ->where('quantity', '>', 0)
                ->whereDoesntHave('orders', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->get();
        return view('client.pages.checkout.guestCheckout', compact('productVariation','quantity','totalPrice','size','color','provinces','districts','wards','discounts'));
        
    }
    public function processGuestCheckout(Request $request)
    {
            // Bắt đầu transaction
            DB::beginTransaction();

            // Debug dữ liệu nhận từ request
            $data = $request->all();

            Log::info('Checkout Data:', $data);
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|regex:/^(0[35789])[0-9]{8}$/',
                'province_id' => 'required|exists:provinces,id',
                'district' => 'required|exists:districts,id',
                'ward' => 'required|exists:wards,id',
                'payment_method' => 'required|in:CASH,VNPAY,MOMO',
                'quantity' => 'required|min:1',
                'quantity.*' => 'required|integer|min:1|max:100',
            ], [
                'full_name.required' => 'Họ và tên không được để trống.',
                'phone_number.required' => 'Số điện thoại không được để trống.',
                'phone_number.regex' => 'Số điện thoại không đúng định dạng.',
                'province_id.required' => 'Vui lòng chọn Tỉnh/Thành phố.',
                'province_id.exists' => 'Tỉnh/Thành phố không hợp lệ.',
                'district.required' => 'Vui lòng chọn Quận/Huyện.',
                'district.exists' => 'Quận/Huyện không hợp lệ.',
                'ward.required' => 'Vui lòng chọn Xã/Phường.',
                'ward.exists' => 'Xã/Phường không hợp lệ.',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
                'payment_method.in' => 'Phương thức thanh toán không hợp lệ.',
                'quantity.required' => 'Số lượng không được để trống.',
                'quantity.min' => 'Số lượng phải có ít nhất 1 phần tử.',
                'quantity.*.required' => 'Mỗi sản phẩm phải có số lượng.',
                'quantity.*.integer' => 'Số lượng phải là số nguyên.',
                'quantity.*.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
                'quantity.*.max' => 'Số lượng phải nhỏ hơn hoặc bằng 100.',
            ]);
            


            // dd($data);

            // Xử lý logic dựa trên phương thức thanh toán
            switch ($data['payment_method']) {
                case 'CASH':
                    // Xử lý logic cho thanh toán COD (Cash On Delivery)
                    Log::info('Thanh toán khi nhận hàng');

                    // Tạo Order
                    $order = Order::create([
                        'user_id' => NULL,
                        'total_amount' => $data['total_amount'] ?? 0,
                        'status' => 'pending',
                        'payment_method' => $data['payment_method'],
                        'province' => $data['province_id'] ?? null,
                        'district' => $data['district'] ?? null,
                        'ward' => $data['ward'] ?? null,
                        'ship' => $data['ship'],
                        'payment_expires_at' => Carbon::now(),
                    ]);
                    // if ($data['discount'] && $data['discount'] !== 0)
                    // {
                    //     OrderDiscount::create([
                    //         'order_id' => $order->id,
                    //         'discount_id' => $data['discount'],
                    //         'discount_amount' => $data['discount_value'],
                    //         'applied_at' => Carbon::now(),
                    //     ]);
                    //     $discount = Discount::where('id', $data['discount'])->first();
                    //     if ($discount) {
                    //         $discount->quantity -= 1;
                    //         $discount->save();
                    //     }
                    // }

                    // Kiểm tra và xử lý mảng product_sku và quantity
                    OrderItem::create([
                                'order_id' => $order->id,
                                'product_sku' => $data['sku'],
                                'quantity' => $data['quantity'][0],
                            ]);
                    $guestBuyer = GuestBuyer::create([
                        'name' => $data['full_name'],
                        'phone_number' => $data['phone_number'],
                        'order_id' => $order->id,
                    ]);

                    // Commit transaction
                    DB::commit();

                return redirect()->route('guest.order.verify')->with([
                    'message' => 'Đơn hàng của bạn đã được tạo thành công!',
                    'details' => 'Chúng tôi đã nhận được đơn hàng của bạn và sẽ xử lý ngay lập tức. Cảm ơn bạn đã tin tưởng mua sắm tại cửa hàng!',
                    'order_id' => $order->id
                ]);

                break;


                case 'VNPAY':
                    Log::info('Thanh toán khi nhận hàng');

                    // Tạo Order
                    $order = Order::create([
                        'user_id' => NULL,
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
                                'product_sku' => $data['sku'],
                                'quantity' => $data['quantity'][0],
                            ]);
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
                    $vnp_Amount = ($order->total_amount + $order->ship) * 100;
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

                    $returnData = array(
                        'code' => '00'
                        ,
                        'message' => 'success'
                        ,
                        'data' => $vnp_Url
                    );
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

    }
}
