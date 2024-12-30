<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Hiển thị danh sách tất cả các review
    public function index()
    {
        $reviews = Review::all();
        foreach ($reviews as $review) {
            $review->product = Product::find($review->product_id);
            $review->user = User::find($review->user_id);
        }
        return view('admin.reviews.index', compact('reviews'));
    }

    // Đánh giá sản phẩm theo sản phầm đã mua
    public function add(Request $request)
    {
        $orderId = $request->route('id');

        $productId = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('product_variations', 'order_items.product_sku', '=', 'product_variations.sku')
            ->where('orders.id', $orderId)
            ->distinct()
            ->pluck('product_variations.product_id')
            ->first();

        $product_name = DB::table('products')
            ->where('id', $productId)
            ->value('name');


        return view('client.reviews.create', compact('orderId', 'productId', 'product_name'));
    }

    public function compare(Request $request)
    {
        $request->validate([
            // 'product_id' => 'required|exists:products,id',
            // 'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $reviews = new Review();
        $reviews->product_id = $request->product;
        $reviews->user_id = auth()->id();
        $reviews->rating = $request->rating;
        $reviews->comment = $request->comment;
        $reviews->save();
        // session()->flash('success', 'Cảm ơn bạn đã đánh giá góp ý về sản phẩm của chúng tôi');
        return back()->with('success');
    }
    //


    // Hiển thị form tạo review mới
    // public function create()
    // {
    //     $products = Product::all();
    //     $users = User::all();
    //     return view('admin.pages.reviews.create1', compact('products', 'users'));
    // }

    // Lưu review mới vào cơ sở dữ liệu
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'user_id' => 'required|exists:users,id',
    //         'rating' => 'required|integer|min:1|max:5',
    //         'comment' => 'nullable|string|max:255',
    //     ]);

    //     Review::create($request->all()); // Lưu review vào bảng reviews

    //     return redirect()->route('admin.reviews.index')->with('success', 'Review đã được tạo.');
    // }



    // Xóa review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete(); // Xóa review

        return redirect()->route('admin.reviews.index')->with('success', 'Review đã được xóa.');
    }


}
