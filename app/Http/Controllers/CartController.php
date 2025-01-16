<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Messenger;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductAttributeValue;
use Illuminate\Support\Facades\Session;
use App\Models\ProductVariationAttribute;

class CartController extends Controller
{
    public function index()
    {
        $id = 5;
        $messages = Messenger::where(function ($query) use ($id) {
            $query->where('id_user_revice', $id)
                ->where('id_user_send', Auth::id());
        })->orWhere(function ($query) use ($id) {
            $query->where('id_user_send', $id)
                ->where('id_user_revice', Auth::id());
        })->get();
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            // Lấy giỏ hàng từ session
            $cart = session()->get('cart', []);

            // Chuyển đổi giỏ hàng từ session thành một tập hợp các item để xử lý
            $cartItems = collect($cart)->map(function ($item) {
                return (object) [
                    'product_id' => $item['product_id'],
                    'product_sku' => $item['product_sku'],
                    'size' => $item['size'],
                    'color' => $item['color'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'product_name' => $item['product_name'],
                    'image' => $item['image'],
                ];
            });

            // Tính tổng tiền từ giỏ hàng trong session
            $totalAmount = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            // Không xử lý thông tin kích thước và màu sắc vì không có thông tin sản phẩm từ database
            $sizesWithColors = [];

            // Trả về view với giỏ hàng từ session
            return view('client.pages.cart.index', compact('cartItems', 'totalAmount', 'sizesWithColors','messages'));
        }

        // Lấy giỏ hàng của người dùng từ database
        $cart = Cart::where('user_id', Auth::id())->first();

        // Nếu không có giỏ hàng, trả về trang trống
        if (!$cart) {
            return view('client.pages.cart.index', ['cartItems' => [], 'totalAmount' => 0, 'sizesWithColors' => [],'messages']);
        }

        // Lấy tất cả các sản phẩm trong giỏ hàng
        $cartItems = $cart->cartItems;

        // Tính tổng tiền và thông tin kích thước, màu sắc
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Tạo mảng sizesWithColors để lưu thông tin màu sắc và kích thước cho từng sản phẩm trong giỏ hàng
        $sizesWithColors = [];

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product; // Lấy thông tin sản phẩm

            // Lấy các biến thể của sản phẩm
            $variations = $product->variations;

            // Lọc các biến thể có số lượng > 0
            $availableVariations = $variations->filter(function ($variation) {
                return $variation->stock_quantity > 0;
            });

            // Khởi tạo mảng cho mỗi sản phẩm
            if (!isset($sizesWithColors[$product->id])) {
                $sizesWithColors[$product->id] = [];
            }

            // Lưu thông tin kích thước với các màu sắc tương ứng
            foreach ($availableVariations as $variation) {
                // Lấy giá trị kích thước và màu sắc
                $sizeAttribute = $variation->variationAttributes->firstWhere('attributeValue.attribute.name', 'size');
                $colorAttribute = $variation->variationAttributes->firstWhere('attributeValue.attribute.name', 'color');

                if ($sizeAttribute && $colorAttribute) {
                    $size = $sizeAttribute->attributeValue->value;
                    $color = $colorAttribute->attributeValue->value;

                    // Thêm màu sắc vào mảng sizesWithColors cho sản phẩm và kích thước tương ứng
                    if (!isset($sizesWithColors[$product->id][$size])) {
                        $sizesWithColors[$product->id][$size] = [];
                    }

                    // Thêm màu sắc vào kích thước tương ứng, loại bỏ trùng lặp
                    if (!in_array($color, $sizesWithColors[$product->id][$size])) {
                        $sizesWithColors[$product->id][$size][] = $color;
                    }
                }
            }
        }


        // Trả về view với các dữ liệu
        return view('client.pages.cart.index', compact('cartItems', 'totalAmount', 'sizesWithColors','messages'));
    }




    public function updateQuantityCart(Request $request)
    {
        $cartItem = CartItem::find($request->cart_item_id);

        if (!$cartItem) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng', 'type' => 'error', 'title' => 'Lỗi']);
        }

        $productVariation = ProductVariation::find($cartItem->product_variation_id);

        if ($request->quantity > $productVariation->stock_quantity) {
            return response()->json(['message' => 'Số lượng yêu cầu vượt quá số lượng tồn kho', 'type' => 'error', 'title' => 'Lỗi']);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        $totalAmount = CartItem::where('cart_id', $cartItem->cart_id)
            ->get()
            ->reduce(function ($sum, $item) {
                return $sum + ($item->quantity * $item->price);
            }, 0);

        return response()->json([
            'message' => 'Chỉnh số lượng vào giỏ hàng thành công',
            'type' => 'success',
            'title' => 'Thành công',
            'totalAmount' => $totalAmount
        ]);
    }



    public function add(Request $request)
    {
        $user = Auth::user();
        $productId = $request->query('id');
        $color = $request->query('color');
        $size = $request->query('size');
        $quantity = (int) $request->query('quantity');
        // return response()->json($request->query('quantity'));

        $colorAttributeId = ProductAttribute::where('name', 'color')->value('id');
        $sizeAttributeId = ProductAttribute::where('name', 'size')->value('id');

        if (!$colorAttributeId || !$sizeAttributeId) {
            return response()->json(['message' => 'Không tìm thấy thuộc tính', 'type' => 'error', 'title' => 'Lỗi']);
        }

        $colorValueId = ProductAttributeValue::where('product_attribute_id', $colorAttributeId)
            ->where('value', $color)
            ->value('id');

        $sizeValueId = ProductAttributeValue::where('product_attribute_id', $sizeAttributeId)
            ->where('value', $size)
            ->value('id');

        if (!$colorValueId || !$sizeValueId) {
            return response()->json(['error' => 'Không tìm thấy giá trị thuộc tính'], 400);
        }

        $productVariationIds = ProductVariationAttribute::whereIn('product_attribute_value_id', [$colorValueId, $sizeValueId])
            ->groupBy('product_variation_id')
            ->havingRaw('COUNT(DISTINCT product_attribute_value_id) = 2')
            ->pluck('product_variation_id');

        $productVariation = ProductVariation::whereIn('id', $productVariationIds)
            ->where('product_id', $productId)
            ->first();

        if (!$productVariation) {
            return response()->json(['message' => 'Không tìm thấy biến thể sản phẩm', 'type' => 'error', 'title' => 'Lỗi']);
        }

        if ($productVariation->stock_quantity < $quantity) {
            return response()->json(['message' => 'Số lượng yêu cầu vượt quá số lượng tồn kho', 'type' => 'error', 'title' => 'Lỗi']);
        }

        if (!$user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thêm vào giỏ hàng'], 401);
        }

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_variation_id', $productVariation->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;

            if ($newQuantity > $productVariation->stock_quantity) {
                return response()->json(['message' => 'Số lượng yêu cầu vượt quá số lượng tồn kho', 'type' => 'error', 'title' => 'Lỗi']);
            }

            $cartItem->update([
                'quantity' => $newQuantity,
                'price' => $newQuantity * $productVariation->price
            ]);
            return response()->json(['message' => 'Thêm vào giỏ hàng thành công', 'type' => 'success', 'title' => 'Thành công']);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_sku' => $productVariation->sku,
                'product_id' => $productId,
                'product_name' => $productVariation->product->name,
                'color' => $color,
                'size' => $size,
                'price' => $quantity * $productVariation->price,
                'image' => $productVariation->product->image_prd,
                'quantity' => $quantity,
                'product_variation_id' => $productVariation->id,
            ]);
        }

        return response()->json(['message' => 'Thêm vào giỏ hàng thành công', 'type' => 'success', 'title' => 'Thành công']);
    }



    public function edit($id)
    {
        // Lấy thông tin sản phẩm theo ID
        $cartItem = CartItem::with('product') // Giả sử bạn đã định nghĩa mối quan hệ với Product
            ->where('id', $id)
            ->first();


        $imagePrd = $cartItem->product->name;

        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found');
        }

        $product = $cartItem->product; // Lấy sản phẩm tương ứng với CartItem

        // Lấy các biến thể của sản phẩm
        $variations = $product->variations;

        // Lọc các biến thể có số lượng > 0
        $availableVariations = $variations->filter(function ($variation) {
            return $variation->stock_quantity > 0;
        });

        $sizesWithColors = [];

        // Lưu thông tin kích thước với các màu sắc tương ứng
        foreach ($availableVariations as $variation) {
            // Lấy giá trị kích thước và màu sắc
            $sizeAttribute = $variation->variationAttributes->firstWhere('attributeValue.attribute.name', 'size');
            $colorAttribute = $variation->variationAttributes->firstWhere('attributeValue.attribute.name', 'color');

            if ($sizeAttribute && $colorAttribute) {
                $size = $sizeAttribute->attributeValue->value;
                $color = $colorAttribute->attributeValue->value;

                // Thêm màu sắc vào mảng sizesWithColors cho sản phẩm và kích thước tương ứng
                if (!isset($sizesWithColors[$product->id][$size])) {
                    $sizesWithColors[$product->id][$size] = [];
                }

                // Thêm màu sắc vào kích thước tương ứng, loại bỏ trùng lặp
                if (!in_array($color, $sizesWithColors[$product->id][$size])) {
                    $sizesWithColors[$product->id][$size][] = $color;
                }
            }
        }
        $id = 5;
        $messages = Messenger::where(function ($query) use ($id) {
            $query->where('id_user_revice', $id)
                ->where('id_user_send', Auth::id());
        })->orWhere(function ($query) use ($id) {
            $query->where('id_user_send', $id)
                ->where('id_user_revice', Auth::id());
        })->get();
        // dd($cartItem,$sizesWithColors);
        // Trả về view edit với các dữ liệu cần thiết
        return view('client.pages.cart.edit', compact('cartItem', 'sizesWithColors', 'imagePrd','messages'));
    }


    public function remove($id)
    {
        // Lấy id của người dùng đang đăng nhập
        $userId = Auth::id();

        if ($userId === null) {
            // Nếu người dùng chưa đăng nhập, có thể redirect hoặc thông báo lỗi
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này.');
        }

        // Tìm giỏ hàng của người dùng bằng cách sử dụng user_id và cart_id
        $cartItem = CartItem::where('id', $id)
            ->whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId); // Kết nối với bảng carts để tìm cart_id của người dùng
            })
            ->first();

        if ($cartItem) {
            $cartItem->delete(); // Xóa sản phẩm
            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm này trong giỏ hàng của bạn.');
        }
    }
}
