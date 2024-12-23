<?php

namespace App\Providers;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Để sử dụng View Composer

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Chia sẻ biến $orderCount tới tất cả view
        View::composer('*', function ($view) {
            $orderCount = 0; // Mặc định là 0 nếu chưa đăng nhập
            $cartCount = 0;  // Mặc định là 0 nếu chưa đăng nhập

            if (Auth::check()) {
                // Nếu người dùng đã đăng nhập, đếm số lượng đơn hàng
                $orderCount = Order::where('user_id', Auth::id())->count();

                // Lấy giỏ hàng của người dùng
                $cart = Cart::where('user_id', Auth::id())->first();
                
                if ($cart) {
                    // Đếm tổng số lượng sản phẩm trong giỏ hàng
                    // Lấy tất cả các sản phẩm trong giỏ hàng và tính tổng số lượng
                    $cartCount = $cart->cartItems->sum('quantity');  // 'quantity' là trường trong cart_items lưu số lượng
                }
            }

            // Chia sẻ các biến tới tất cả view
            $view->with('orderCount', $orderCount);
            $view->with('cartCount', $cartCount);
        });
    }
}
