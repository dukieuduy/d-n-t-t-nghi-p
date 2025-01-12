<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
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

        $product = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('product_variations', 'order_items.product_sku', '=', 'product_variations.sku')
            ->where('orders.id', $orderId)
            ->distinct()
            ->select('product_variations.product_id', 'product_variations.image')
            // ->pluck('product_variations.product_id')
            // ->get();
            ->first();
        // dd($product);
        $productId = $product->product_id;
        $image = $product -> image;

        $skus = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.id', $orderId)
            ->pluck('order_items.product_sku')
            ->first();

        $product_name = DB::table('products')
            ->where('id', $productId)
            ->value('name');


        return view('client.reviews.create', compact('orderId', 'productId', 'product_name', 'skus', 'image'));
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
        // dd($request->order_id);
        $reviews->save();

        Order::where('id', $request->order_id)->update(['is_reviewed' => 1]);
        return back()->with('success', 'Cảm ơn bạn đã đánh giá góp ý về sản phẩm của chúng tôi');
    }
    

    public function reply_comment(Request $request)
    {
        \Log::info('Incoming Request:', $request->all()); // Debugging log
    
        try {
            $request->validate([
                'comment' => 'required|string',
                'id' => 'required|integer',
                'comment_product_id' => 'required|integer',
            ]);
    
            // Save the reply (update this logic as per your DB structure)
            $reply = new Review();
            // $reply->id = $request->id;
            $reply->product_id = $request->comment_product_id;
            $reply->comment = $request->comment;
            $reply->comment_parent = $request->id;
            $reply->rating = '5';
            $reply->user_id = auth()->id();
            $reply->save();
    
            return response()->json(['message' => 'Reply saved successfully!'], 200);
        } catch (\Exception $e) {
            \Log::error('Error in replyComment:', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
    



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
