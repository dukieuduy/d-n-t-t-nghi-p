<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function show()
    {
        $wishlistProducts = Wishlist::select('wishlists.*', 'products.name', 'product_variations.image', 'product_variations.price')
            ->where('user_id', auth()->user()->id)
            ->where('product_variations.is_default', 1)
            ->join('products', 'products.id', 'wishlists.product_id')
            ->join('product_variations', 'product_variations.product_id', 'wishlists.product_id')

            ->get();
        // dd($wishlistProducts);
        //return view('wishlist.index', compact('wishlistProducts'));

        return view('client.pages.wishlist', compact('wishlistProducts'));
    }


    public function create(Request $request)
    {
        // Lưu sản phẩm vào bảng Wishlist
        $wishlist = new Wishlist(); // Thay Product bằng model tương ứng của sản phẩm
        $wishlist->user_id = auth()->user()->id;

        //Kiểm tra xem sản phẩm đấy có trong wishlists của người dùng í chưa
        $checkItemInWishlist = Wishlist::where('user_id', auth()->user()->id)
            ->where('product_id', $request->product_id)
            ->get();

        if ($checkItemInWishlist->count() > 0) {
            return redirect()->back()->with('success', 'Sản phẩm đã có trong mục yêu thích của bạn');
        } else {
            //Nếu có rồi thì thông báo,hoặc trả về trang wishlists
            //Nếu không có thêm sản phẩm vào wishlists
            $wishlist->product_id = $request->product_id;
            $wishlist->save();
            return redirect()->back()->with('success', 'Sản phẩm đã thêm vào mục yêu thích');
        }

    }
    // public function destroy($id)
    // {
    //     Wishlist::where('id', $id)->delete();
    //     return redirect()->back()->with('success', 'Xóa thành công');
    // }


    public function destroy($id)
    {
        try {
            // Thực hiện xóa wishlist
            Wishlist::where('id', $id)->delete();

            // Nếu thành công, chuyển hướng với thông báo thành công
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, chuyển hướng với thông báo lỗi
            return redirect()->back()->with('error', 'Xóa không thành công: ' . $e->getMessage());
        }
    }

}
