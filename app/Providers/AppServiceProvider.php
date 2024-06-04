<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View as FacadeView; // Sửa lỗi import đúng namespace cho View facade
use Illuminate\View\View;

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
        // Chia sẻ biến session('cart') cho các view header.blade.php và checkout.php
            FacadeView::composer(['layout.header','banhang.checkout'], function (View $view) { // Liệt kê thêm các view nếu cần
            if (Session::has('cart')) { // Sử dụng Session::has để kiểm tra sự tồn tại của 'cart'
                $oldCart = Session::get('cart'); // session cart được tạo trong phương thức addToCart của PageController
                $cart = new Cart($oldCart);
                $view->with([
                    'cart' => Session::get('cart'),
                    'productCarts' => $cart->items,
                    'totalPrice' => $cart->totalPrice,
                    'totalQty' => $cart->totalQty,
                ]);
            }
        });
    }
}
