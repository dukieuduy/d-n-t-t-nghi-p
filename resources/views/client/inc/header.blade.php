<!-- Main Wrapper Start -->
<!--header area start-->
<header class="header_area header_padding">
    <!--header top start-->
    <div class="header_top top_two">
        <div class="container">

            <div class="top_inner">
                <div class="row align-items-center" style="height: 60px;">
                    <div class="col-lg-6 col-md-6">
                        <div class="follow_us">
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
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <div class="dropdown-header">
                                                <a href="{{ route('profile') }}">Thông tin tài khoản</a>
                                            </div>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                {{ __('Đăng xuất') }}
                                            </a>
                                            <div class="dropdown-header">

                                                <a href="{{ route('user.orders.index') }}">Đơn hàng:</a>
                                                <span class="cart_quantity">{{ $orderCount }}</span>
                                            </div>


                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
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
                        <a href="{{ route('home') }}">
                            <img src="assets/img/Logohome/Cam.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="middel_right">
                        <div class="search-container search_two">
                            <form action="{{ route('products.search') }}" method="GET">
                                @csrf <!-- CSRF token for security -->
                                <div class="search_box">
                                    <input name="query" placeholder="Tìm kiếm ..." type="text" required>
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
                                <a href="{{ route('cart.index') }}"><span class="lnr lnr-cart"></span>giỏ hàng </a>
                                <span class="cart_quantity">{{ $cartCount }}</span>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->
    <div class="running-text">
        <span>🎀 Wish you be my love forever 🎀 | 🎀 You're always speacial in my eyes 🎀</span>
    </div>


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
                                        @foreach ($categories->take(4) as $category)
                                            <!-- Lấy 4 danh mục đầu -->
                                            @if ($category->is_active == '1')
                                                <li><a
                                                        href="{{ route('category_page', $category->id) }}">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        <!-- Danh mục ẩn -->
                                        @foreach ($categories->skip(4) as $category)
                                            <!-- Bỏ 4 danh mục đầu -->
                                            @if ($category->is_active == '1')
                                                <li class="hidden-category" style="display: none;"><a
                                                        href="#">{{ $category->name }}</a></li>
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
                                    <li><a href="{{ route('home') }}">Trang chủ</a>


                                    </li>

                                    <li><a href="{{ route('client.blogs.index') }}">Thông tin
                                    </li>
                                    <li><a href="{{ route('client.aboutus.create') }}">Chính sách
                                    </li>
                                    <li><a href="{{ route('client.purchase.create') }}">Hướng dẫn
                                    </li>
                                    <li><a href="{{ route('wishlist.show') }}"> Yêu thích</a></li>
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
