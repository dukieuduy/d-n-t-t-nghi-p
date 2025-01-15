<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
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
        return view('client.pages.cart.index', compact('cartItems', 'totalAmount', 'sizesWithColors'));
    }

    // Lấy giỏ hàng của người dùng từ database
    $cart = Cart::where('user_id', Auth::id())->first();

    // Nếu không có giỏ hàng, trả về trang trống
    if (!$cart) {
        return view('client.pages.cart.index', ['cartItems' => [], 'totalAmount' => 0, 'sizesWithColors' => []]);
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
    return view('client.pages.cart.index', compact('cartItems', 'totalAmount', 'sizesWithColors'));
}

    
    
    
    

    
    // public function add(Request $request)
    //         {
    //             $productId = $request->product_id;
    //             $selectedSize = $request->selectedSize;
    //             $selectedColor = $request->selectedColor;
    //             $quantity = $request->quantity;

    //             // Kiểm tra xem người dùng đã đăng nhập chưa
    //             if (!Auth::check()) {
    //                 return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
    //             }

    //             // Lấy tất cả các biến thể của sản phẩm
    //             $productVariations = ProductVariation::where('product_id', $productId)->get();

    //             $matchedVariation = null;

    //             foreach ($productVariations as $variation) {
    //                 // Lấy các thuộc tính của biến thể
    //                 $variationAttributes = $variation->variationAttributes;

    //                 // Lấy danh sách giá trị thuộc tính
    //                 $attributeValues = ProductAttributeValue::whereIn(
    //                     'id',
    //                     $variationAttributes->pluck('product_attribute_value_id')
    //                 )->pluck('value');

    //                 // Kiểm tra xem kích thước và màu sắc có khớp không
    //                 $sizeMatch = $attributeValues->contains($selectedSize);
    //                 $colorMatch = $attributeValues->contains($selectedColor);

    //                 if ($sizeMatch && $colorMatch) {
    //                     $matchedVariation = $variation;
    //                     break;
    //                 }
    //             }

    //             // Nếu không tìm thấy biến thể phù hợp
    //             if (!$matchedVariation) {
    //                 return redirect()->back()->with('error', 'Sản phẩm với màu sắc và kích thước đã chọn không tồn tại.');
    //             }

    //             $image = $matchedVariation->image;
    //             $price = $matchedVariation->price;
    //             $productSku=$matchedVariation->sku;

    //             // Kiểm tra hoặc tạo mới giỏ hàng cho người dùng
    //             $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

    //             // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    //             $cartItem = CartItem::where('cart_id', $cart->id)
    //                 ->where('product_id', $productId)
    //                 ->where('size', $selectedSize)
    //                 ->where('color', $selectedColor)
    //                 ->first();

    //             if ($cartItem) {
    //                 // Cập nhật số lượng nếu sản phẩm đã tồn tại
    //                 $cartItem->quantity += $quantity;
    //                 $cartItem->save();
    //                 return redirect()->route('cart.index')->with('success', 'Số lượng sản phẩm đã được cập nhật.');
    //             }

    //             // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
    //             $cartItem = new CartItem([
    //                 'cart_id' => $cart->id,
    //                 'product_sku'=>$productSku,
    //                 'product_id' => $productId,
    //                 'product_variation_id' => $matchedVariation->id, // Thêm dòng này
    //                 'size' => $selectedSize,
    //                 'color' => $selectedColor,
    //                 'quantity' => $quantity,
    //                 'price' => $price,
    //                 'product_name' => $matchedVariation->product->name ?? 'Tên sản phẩm',
    //                 'image' => $image,
    //             ]);
    //         // dd($cartItem, $matchedVariation->id);

    //             $cartItem->save();

    //             return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    //         }

    public function add(Request $request)
{
    $productId = $request->product_id;
    $selectedSize = $request->selectedSize;
    $selectedColor = $request->selectedColor;
    $quantity = $request->quantity;

    // Lấy tất cả các biến thể của sản phẩm
    $productVariations = ProductVariation::where('product_id', $productId)->get();

    $matchedVariation = null;

    foreach ($productVariations as $variation) {
        // Lấy các thuộc tính của biến thể
        $variationAttributes = $variation->variationAttributes;

        // Lấy danh sách giá trị thuộc tính
        $attributeValues = ProductAttributeValue::whereIn(
            'id',
            $variationAttributes->pluck('product_attribute_value_id')
        )->pluck('value');

        // Kiểm tra xem kích thước và màu sắc có khớp không
        $sizeMatch = $attributeValues->contains($selectedSize);
        $colorMatch = $attributeValues->contains($selectedColor);

        if ($sizeMatch && $colorMatch) {
            $matchedVariation = $variation;
            break;
        }
    }

    // Nếu không tìm thấy biến thể phù hợp
    if (!$matchedVariation) {
        return redirect()->back()->with('error', 'chọn màu sắc và size.');
    }

    $image = $matchedVariation->image;
    $price = $matchedVariation->price;
    $productSku = $matchedVariation->sku;

    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!Auth::check()) {
        // Lấy session cart
        $cart = session()->get('cart', []);

        // Tạo key duy nhất dựa trên sản phẩm, kích thước và màu sắc
        $key = "{$productId}_{$selectedSize}_{$selectedColor}";

        if (isset($cart[$key])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng session, cập nhật số lượng
            $cart[$key]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng session
            $cart[$key] = [
                'product_sku' => $productSku,
                'product_id' => $productId,
                'product_variation_id' => $matchedVariation->id,
                'size' => $selectedSize,
                'color' => $selectedColor,
                'quantity' => $quantity,
                'price' => $price,
                'product_name' => $matchedVariation->product->name ?? 'Tên sản phẩm',
                'image' => $image,
            ];
        }

        // Lưu lại giỏ hàng vào session
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng (session).');
    }

    // Nếu người dùng đã đăng nhập, sử dụng cơ chế lưu vào database
    $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

    $cartItem = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $productId)
        ->where('size', $selectedSize)
        ->where('color', $selectedColor)
        ->first();

    if ($cartItem) {
        $cartItem->quantity += $quantity;
        $cartItem->save();
        return redirect()->route('cart.index')->with('success', 'Số lượng sản phẩm đã được cập nhật.');
    }

    $cartItem = new CartItem([
        'cart_id' => $cart->id,
        'product_sku' => $productSku,
        'product_id' => $productId,
        'product_variation_id' => $matchedVariation->id,
        'size' => $selectedSize,
        'color' => $selectedColor,
        'quantity' => $quantity,
        'price' => $price,
        'product_name' => $matchedVariation->product->name ?? 'Tên sản phẩm',
        'image' => $image,
    ]);

    $cartItem->save();

    return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
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
            // dd($cartItem,$sizesWithColors);
                // Trả về view edit với các dữ liệu cần thiết
                return view('client.pages.cart.edit',compact('cartItem','sizesWithColors','imagePrd'));
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
                            ->whereHas('cart', function($query) use ($userId) {
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
