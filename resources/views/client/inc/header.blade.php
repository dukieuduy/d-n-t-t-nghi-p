<!-- Main Wrapper Start -->
<!--header area start-->
<header class="header_area header_padding">
    <!--header top start-->
    <div class="header_top top_two">
        <div class="container">
            <div class="top_inner">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="follow_us">
                            <label>Follow Us:</label>
                            <ul class="follow_link">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="top_right text-end">
                            <ul>
                                @guest
                                @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('đăng nhập') }}</a>
                                </li>
                                @endif

                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('đăng ký') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <div class="dropdown-header">
                                            <a href="{{route('profile')}}">Thông tin tài khoản</a>
                                        </div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        <?php
                                        if (auth()->check()) {
                                            if (auth()->user()->type === 'admin') {
                                                echo '<li>
                                                    <a href="' .
                                                    url('admin/products') .
                                                    '" class="sub-menu-item">Admin</a>
                                                    </li>';
                                            }
                                        }
                                        ?>

                                    </div>
                                </li>
                                @endguest

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header top start-->
    <!--header middel start-->
    <div class="header_middle middle_two">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <h1 style="color: #ff6300">CAMCAM</h1>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="middel_right">
                        <div class="search-container search_two">
                            <form action="{{ route('products.search') }}" method="GET">
                                @csrf <!-- CSRF token for security -->
                                <div class="search_box">
                                    <input name="query" placeholder="Search entire store here ..." type="text" required>
                                    <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="middel_right_info">

                            {{-- <div class="header_wishlist">
                                <a href="wishlist.html"><span class="lnr lnr-heart"></span> yêu thích </a>
                                <span class="wishlist_quantity">3</span>
                            </div> --}}
                            <div class="mini_cart_wrapper">
                                <a href="{{route('cart.index')}}"><span class="lnr lnr-cart"></span>giỏ hàng </a>
                                <span class="cart_quantity">{{$cartCount}}</span>
                            </div>
                            <div class="mini_cart_wrapper">
                                <a href="{{ route('user.orders.index') }}">
                                    <span class="lnr lnr-cart"></span>đơn hàng</a>


                                <span class="cart_quantity">{{ $orderCount }}</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->

    <!--mini cart-->
    {{-- <div class="mini_cart">
        <div class="cart_close">
            <div class="cart_text">
                <h3>cart</h3>
            </div>
            <div class="mini_cart_close">
                <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
            </div>
        </div>
        <div class="cart_item">
            <div class="cart_img">
                <a href="#"><img src="assets/img/s-product/product.jpg" alt=""></a>
            </div>
            <div class="cart_info">
                <a href="#">JBL Flip 3 Splasroof Portable Bluetooth 2</a>

                <span class="quantity">Qty: 1</span>
                <span class="price_cart">$60.00</span>

            </div>
            <div class="cart_remove">
                <a href="#"><i class="ion-android-close"></i></a>
            </div>
        </div>
        <div class="cart_item">
            <div class="cart_img">
                <a href="#"><img src="assets/img/s-product/product2.jpg" alt=""></a>
            </div>
            <div class="cart_info">
                <a href="#">Koss Porta Pro On Ear Headphones </a>
                <span class="quantity">Qty: 1</span>
                <span class="price_cart">$69.00</span>
            </div>
            <div class="cart_remove">
                <a href="#"><i class="ion-android-close"></i></a>
            </div>
        </div>
        <div class="mini_cart_table">
            <div class="cart_total">
                <span>Sub total:</span>
                <span class="price">$138.00</span>
            </div>
            <div class="cart_total mt-10">
                <span>total:</span>
                <span class="price">$138.00</span>
            </div>
        </div>

        <div class="mini_cart_footer">
            <div class="cart_button">
                <a href="{{ route('cart.show') }}">View cart</a>
    </div>
    <div class="cart_button">
        <a class="active" href="checkout.html">Checkout</a>
    </div>

    </div>

    </div> --}}
    <!--mini cart end-->

    <!--header bottom satrt-->
    <div class="header_bottom bottom_two sticky-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="header_bottom_container">
                        <div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle">Danh mục</h2>
                            </div>

                        
                            <div class="categories_menu_toggle">
                                <ul>
                                    @if (isset($categories))
                                        
                                    
                                        <!-- Hiển thị các danh mục chính -->
                                    @foreach ($categories->take(4) as $category) <!-- Lấy 4 danh mục đầu -->
                                        @if ($category->is_active == "1")
                                            <li><a href="#">{{ $category->name }}</a></li>
                                        @endif
                                    @endforeach

                                    <!-- Danh mục ẩn -->
                                    @foreach ($categories->skip(4) as $category) <!-- Bỏ 4 danh mục đầu -->
                                        @if ($category->is_active == "1")
                                            <li class="hidden-category" style="display: none;"><a href="#">{{ $category->name }}</a></li>
                                        @endif
                                    @endforeach

                                    <!-- Nút More Categories -->
                                    @if ($categories->count() > 4)
                                        <li>
                                            <a href="#" id="more-btn">
                                                <i class="fa fa-plus" aria-hidden="true"></i> More Categories
                                            </a>
                                        </li>
                                    @endif
                                    @endif
                                </ul>
                            </div>


                        </div>
                        <div class="main_menu">
                            <nav>
                                <ul>
                                    <li><a href="{{route('home')}}">Trang chủ<i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu">
                                            <li><a href="index.html">Home 1</a></li>
                                            <li><a href="index-2.html">Home 2</a></li>
                                            <li><a href="index-3.html">Home 3</a></li>
                                            <li><a href="index-4.html">Home 4</a></li>
                                            <li><a href="index-5.html">Home 5</a></li>
                                            <li><a href="index-6.html">Home 6</a></li>
                                            <li class="home7new"><a href="index-7.html">Home 7</a><span>new</span>
                                            </li>
                                        </ul>

                                    </li>
                                    <li class="mega_items"><a href="shop.html">shop<i
                                                class="fa fa-angle-down"></i></a>
                                        <div class="mega_menu">
                                            <ul class="mega_menu_inner">
                                                <li><a href="#">Shop Layouts</a>
                                                    <ul>
                                                        <li><a href="shop-fullwidth.html">Full Width</a></li>
                                                        <li><a href="shop-fullwidth-list.html">Full Width list</a></li>
                                                        <li><a href="shop-right-sidebar.html">Right Sidebar </a></li>
                                                        <li><a href="shop-right-sidebar-list.html"> Right Sidebar
                                                                list</a></li>
                                                        <li><a href="shop-list.html">List View</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">other Pages</a>
                                                    <ul>
                                                        <li><a href="#">cart</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="my-account.html">my account</a></li>
                                                        <li><a href="404.html">Error 404</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Product Types</a>
                                                    <ul>
                                                        <li><a href="product-details.html">product details</a></li>
                                                        <li><a href="product-sidebar.html">product sidebar</a></li>
                                                        <li><a href="product-grouped.html">product grouped</a></li>
                                                        <li><a href="variable-product.html">product variable</a></li>

                                                    </ul>
                                                </li>
                                                <li><a href="#">Concrete Tools</a>
                                                    <ul>
                                                        <li><a href="shop.html">Cables & Connectors</a></li>
                                                        <li><a href="shop-list.html">Graphics Tablets</a></li>
                                                        <li><a href="shop-fullwidth.html">Printers, Ink & Toner</a>
                                                        </li>
                                                        <li><a href="shop-fullwidth-list.html">Refurbished Tablets</a>
                                                        </li>
                                                        <li><a href="shop-right-sidebar.html">Optical Drives</a></li>

                                                    </ul>
                                                </li>
                                            </ul>
                                            <div class="banner_static_menu">
                                                <a href="shop.html"><img src="assets/img/bg/banner1.jpg"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="{{route('client.blogs.index')}}">blog<i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="{{route('client.blogs.index')}}">Quản lý bài viết</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="#">pages <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="{{route('client.aboutus.create')}}">Chính Sách</a></li>
                                            <li><a href="{{route('client.purchase.create')}}">Hướng Dẫn Mùa Hàng</a></li>

                                        </ul>
                                    </li>
                                    {{-- <li><a href="{{route('client.contactus.create')}}"> Liên Hệ</a></li> --}}
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--header bottom end-->

</header>
<!--header area end-->
<!--Offcanvas menu area start-->
<div class="off_canvars_overlay"></div>
<div class="Offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <span>MENU</span>
                    <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                </div>
                <div class="Offcanvas_menu_wrapper">

                    <div class="canvas_close">
                        <a href="#"><i class="ion-android-close"></i></a>
                    </div>


                    <div class="top_right text-end">
                        <ul>
                            <li class="top_links"><a href="#"><i class="ion-android-person"></i> My Account<i
                                        class="ion-ios-arrow-down"></i></a>
                                <ul class="dropdown_links">
                                    <li><a href="checkout.html">Checkout </a></li>
                                    <li><a href="my-account.html">My Account </a></li>
                                    <li><a href="#">Shopping Cart</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="language"><a href="#"><img src="assets/img/logo/language.png"
                                        alt="">en-gb<i class="ion-ios-arrow-down"></i></a>
                                <ul class="dropdown_language">
                                    <li><a href="#"><img src="assets/img/logo/language.png" alt="">
                                            English</a></li>
                                    <li><a href="#"><img src="assets/img/logo/language2.png" alt="">
                                            Germany</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="currency"><a href="#">$ USD<i class="ion-ios-arrow-down"></i></a>
                                <ul class="dropdown_currency">
                                    <li><a href="#">EUR – Euro</a></li>
                                    <li><a href="#">GBP – British Pound</a></li>
                                    <li><a href="#">INR – India Rupee</a></li>
                                </ul>
                            </li>


                        </ul>
                    </div>
                    <div class="Offcanvas_follow">
                        <label>Follow Us:</label>
                        <ul class="follow_link">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="search-container">
                        <form action="#">
                            <div class="search_box">
                                <input placeholder="Search entire store here ..." type="text">
                                <button type="submit"><i class="ion-ios-search-strong"></i></button>
                            </div>
                        </form>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children">
                                <a href="{{route('home')}}">Trang chủ</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Shop</a>
                                <ul class="sub-menu">
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Layouts</a>
                                        <ul class="sub-menu">
                                            <li><a href="shop.html">shop</a></li>
                                            <li><a href="shop-fullwidth.html">Full Width</a></li>
                                            <li><a href="shop-fullwidth-list.html">Full Width list</a></li>
                                            <li><a href="shop-right-sidebar.html">Right Sidebar </a></li>
                                            <li><a href="shop-right-sidebar-list.html"> Right Sidebar list</a></li>
                                            <li><a href="shop-list.html">List View</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">other Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">cart</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="my-account.html">my account</a></li>
                                            <li><a href="404.html">Error 404</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Product Types</a>
                                        <ul class="sub-menu">
                                            <li><a href="product-details.html">product details</a></li>
                                            <li><a href="product-sidebar.html">product sidebar</a></li>
                                            <li><a href="product-grouped.html">product grouped</a></li>
                                            <li><a href="variable-product.html">product variable</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.html">blog</a></li>
                                    <li><a href="blog-details.html">blog details</a></li>
                                    <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                    <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                </ul>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">pages </a>
                                <ul class="sub-menu">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="services.html">services</a></li>
                                    <li><a href="faq.html">Frequently Questions</a></li>
                                    <li><a href="login.html">login</a></li>
                                    <li><a href="compare.html">compare</a></li>
                                    <li><a href="privacy-policy.html">privacy policy</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="my-account.html">my account</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="about.html">About Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="contact.html"> Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--Offcanvas menu area end-->
