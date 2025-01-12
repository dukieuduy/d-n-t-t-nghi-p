@extends('app')
@section('content')
    <!--slider area start-->
    {{-- banner --}}
    <section class="slider_section slider_two mb-50">
        <div class="slider_area owl-carousel">
           @foreach ($banner as $b)
           <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('storage/banners/'.$b->image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider_content">
                            <h2 style="color:white">{{ $b->title }}</h2>
                            <h1 style="color:white">{!! $b->content !!}</h1> <br>
                            <a class="button" href="{{ route('detail-product', ['id' => $b->product_id]) }}">Shopping now!</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
           @endforeach
          
        </div>
    </section>
    <!--slider area end-->

    <!--shipping area start-->
    <section class="shipping_area mb-50">
        <div class="container">
            <div class=" row">
                <div class="col-12">
                    <div class="shipping_inner">
                        <div class="single_shipping">
                            <div class="shipping_icone">
                                <img src="assets/img/about/shipping1.png" alt="">
                            </div>
                            <div class="shipping_content">
                                <h2>Free Shipping</h2>
                                <p>Free shipping on all US order</p>
                            </div>
                        </div>
                        <div class="single_shipping">
                            <div class="shipping_icone">
                                <img src="assets/img/about/shipping2.png" alt="">
                            </div>
                            <div class="shipping_content">
                                <h2>Support 24/7</h2>
                                <p>Contact us 24 hours a day</p>
                            </div>
                        </div>
                        <div class="single_shipping">
                            <div class="shipping_icone">
                                <img src="assets/img/about/shipping3.png" alt="">
                            </div>
                            <div class="shipping_content">
                                <h2>100% Money Back</h2>
                                <p>You have 30 days to Return</p>
                            </div>
                        </div>
                        <div class="single_shipping">
                            <div class="shipping_icone">
                                <img src="assets/img/about/shipping4.png" alt="">
                            </div>
                            <div class="shipping_content">
                                <h2>Payment Secure</h2>
                                <p>We ensure secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--shipping area end-->
    <!--product area start-->


    <section class="product_area mb-50">
        <div class="container">
        <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span><strong>Our</strong> Products</span></h2>
                        <ul class="product_tab_button nav" role="tablist" id="nav-tab">
                            @foreach ($categories as $index => $category)
                                <li>
                                {{ $category->name }}
                                    @if ($category->is_active == 1)
                                        <a 
                                        class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                        data-bs-toggle="tab" 
                                        href="#category-{{ $category->id }}" 
                                        role="tab" 
                                        aria-controls="category-{{ $category->id }}" 
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                      
                                    </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>


                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="brake" role="tabpanel">
                    <div class="product_carousel product_column5 owl-carousel">
                        {{-- <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="{{ route('detail-product', 1) }}">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                    </h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product6.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product7.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Bose SoundLink Bluetooth Speaker</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product8.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product9.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-47%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$3200.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @foreach ($products as $item)

                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="{{ route('detail-product', ['id' => $item->id]) }}">{{ $item->name }}</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="{{ route('detail-product', ['id' => $item->id]) }}"> <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image_prd)}}" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">{{ $item->total_sale_percentage }}%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <small><del>{{number_format($item->price_old)}}</del></small>
                                            <span class="regular_price">{{number_format($item->price_new - ($item->price_new * $item->total_sale_percentage / 100))}} đ</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                        {{-- <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="{{ route('detail-product', 1) }}">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                    </h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product13.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product14.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-07%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$180.00</span>
                                            <span class="old_price">$420.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product15.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product16.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$140.00</span>
                                            <span class="old_price">$320.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product17.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product18.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Fugit eum cupiditate necessitatibus
                                            similique </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product12.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product13.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product2.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product1.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Fugit eum cupiditate necessitatibus similique</a>
                                    </h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product3.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product4.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html"> repellendus quas ratione voluptas.</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product5.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product6.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product7.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product8.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">repellendus quas ratione voluptas.</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product9.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product10.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Etiam Gravida 16GB Factory Unlocked </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product11.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product12.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="tab-pane fade" id="wheels" role="tabpanel">
                    <div class="product_carousel product_column5 owl-carousel">
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                    </h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product1.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product2.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Bose SoundLink Bluetooth Speaker</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product3.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product4.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-47%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$3200.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Variable with soldout product for title</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product5.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product6.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$150.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Lorem ipsum dolor sit amet, consectetur</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product7.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product8.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$175.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                    </h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product9.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product10.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-07%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$180.00</span>
                                            <span class="old_price">$420.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product11.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product12.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$140.00</span>
                                            <span class="old_price">$320.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product13.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product14.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product15.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product16.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product17.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product18.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product12.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product13.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product19.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product1.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product18.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product2.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product17.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product3.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product16.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product4.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="tab-pane fade" id="turbo" role="tabpanel">
                    <div class="product_carousel product_column5 owl-carousel">
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                    </h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product10.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product11.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Bose SoundLink Bluetooth Speaker</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product12.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product11.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-47%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$3200.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Variable with soldout product for title</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product13.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product14.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$150.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Lorem ipsum dolor sit amet, consectetur</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product15.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product16.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$175.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                    </h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product17.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product18.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-07%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$180.00</span>
                                            <span class="old_price">$420.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product1.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product2.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="current_price">$140.00</span>
                                            <span class="old_price">$320.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product3.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product4.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product5.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product6.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product7.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product8.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product9.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product10.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product11.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product12.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product13.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product14.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product_list">
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product15.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product16.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product">
                                <div class="product_name">
                                    <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                    <p class="manufacture_product"><a href="#">Accessories</a></p>
                                </div>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img
                                            src="assets/img/product/product17.jpg" alt=""></a>
                                    <a class="secondary_img" href="product-details.html"><img
                                            src="assets/img/product/product18.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-57%</span>
                                    </div>

                                    <div class="action_links">
                                        <ul>
                                            <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_box" title="quick view">
                                                    <span class="lnr lnr-magnifier"></span></a></li>
                                            <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                        class="lnr lnr-heart"></span></a></li>
                                            <li class="compare"><a href="compare.html" title="compare"><span
                                                        class="lnr lnr-sync"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_footer d-flex align-items-center">
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a href="cart.html" title="add to cart"><span
                                                    class="lnr lnr-cart"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product area end-->


    <!--product area start-->
    <section class="new_product_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_tab_button tab_button2">
                        <ul class="nav" role="tablist" id="nav-tab2">
                            <li>
                                <a class="active" data-toggle="tab" href="#featured" role="tab" aria-controls="featured"
                                   aria-selected="true"><span>Featured</span> Products</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#view" role="tab" aria-controls="view" aria-selected="false"><span>Most</span>
                                    View Products</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#bestseller" role="tab" aria-controls="bestseller"
                                   aria-selected="false"><span>Bestseller</span> Products</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>


            <div class="tab-content">
                <div class="tab-pane fade show active" id="featured" role="tabpanel">
                    <div class="new_product_container">
                        <div class="sample_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                <div class="manufacture_product">
                                    <p><a href="#">Hewlett-Packard</a></p>
                                </div>
                            </div>
                            <div class="product_thumb">
                                <a href="#"><img src="assets/img/product/product19.jpg" alt=""></a>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="price_box">
                                    <span class="current_price">$160.00</span>
                                    <span class="old_price">$180.00</span>
                                </div>
                                <div class="quantity_progress">
                                    <p class="product_sold">Sold: <span>199</span></p>
                                    <p class="product_available">Availabe: <span>9800</span></p>
                                </div>
                                <div class="bar_percent">

                                </div>
                            </div>

                        </div>
                        <div class="product_carousel product_bg  product_column2 owl-carousel">
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Lid Cover Cookware Steel Hybrid</a></h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product2.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product12.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product5.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product10.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product11.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product13.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product7.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product14.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product15.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Lid Cover Cookware Steel Hybrid</a></h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product16.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JKodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product17.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$280.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product18.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="view" role="tabpanel">
                    <div class="new_product_container">
                        <div class="sample_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">Beats EP Wired On-Ear Headphone-Black</a></h3>
                                <div class="manufacture_product">
                                    <p><a href="#">Canon</a></p>
                                </div>
                            </div>
                            <div class="product_thumb">
                                <a href="#"><img src="assets/img/product/product15.jpg" alt=""></a>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="price_box">
                                    <span class="current_price">$160.00</span>
                                    <span class="old_price">$180.00</span>
                                </div>
                                <div class="quantity_progress">
                                    <p class="product_sold">Sold: <span>199</span></p>
                                    <p class="product_available">Availabe: <span>9800</span></p>
                                </div>
                                <div class="bar_percent">

                                </div>
                            </div>

                        </div>
                        <div class="product_carousel product_bg  product_column2 owl-carousel">
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Lid Cover Cookware Steel Hybrid</a></h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product10.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product11.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$280.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product12.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product13.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product11.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$280.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product14.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product15.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product16.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product17.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Lid Cover Cookware Steel Hybrid</a></h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product18.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JKodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product19.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product2.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bestseller" role="tabpanel">
                    <div class="new_product_container">
                        <div class="sample_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">Koss KPH7 Lightweight Portable Headphone</a></h3>
                                <div class="manufacture_product">
                                    <p><a href="#">Accessories</a></p>
                                </div>
                            </div>
                            <div class="product_thumb">
                                <a href="#"><img src="assets/img/product/product3.jpg" alt=""></a>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="price_box">
                                    <span class="current_price">$160.00</span>
                                    <span class="old_price">$180.00</span>
                                </div>
                                <div class="quantity_progress">
                                    <p class="product_sold">Sold: <span>199</span></p>
                                    <p class="product_available">Availabe: <span>9800</span></p>
                                </div>
                                <div class="bar_percent">

                                </div>
                            </div>

                        </div>
                        <div class="product_carousel product_bg  product_column2 owl-carousel">
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Lid Cover Cookware Steel Hybrid</a></h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product5.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product6.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$280.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product7.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$160.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product8.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product9.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$280.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product10.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product11.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product12.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product13.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small_product">
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Lid Cover Cookware Steel Hybrid</a></h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product14.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">JKodak PIXPRO Astro Zoom AZ421 16 MP 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="regular_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product15.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="single_product">
                                    <div class="product_content">
                                        <h3><a href="product-details.html">Nonstick Dishwasher On-Ear Headphones 2</a>
                                        </h3>
                                        <div class="product_ratings">
                                            <ul>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                                <li><a href="#"><i class="ion-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="price_box">
                                            <span class="current_price">$160.00</span>
                                            <span class="old_price">$180.00</span>
                                        </div>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product16.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product area end-->
    <!--banner area start-->
    <section class="banner_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_container">
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href="#"><img src="assets/img/bg/banner3.jpg" alt=""></a>
                                <div class="banner_text">
                                    <h3>Car Audio</h3>
                                    <h2>Super Natural Sound</h2>
                                    <a href="shop.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href="#"><img src="assets/img/bg/banner4.jpg" alt=""></a>
                                <div class="banner_text">
                                    <h3>All - New</h3>
                                    <h2>Perfomance Parts</h2>
                                    <a href="shop.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--banner area end-->

    <!--product area start-->
    <section class="product_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span> <strong>Special</strong>Offers</span></h2>
                    </div>
                    <div class="product_carousel product_column5 owl-carousel">
                        <div class="single_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a></h3>
                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                            </div>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="assets/img/product/product19.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="assets/img/product/product11.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">-57%</span>
                                </div>

                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box" title="quick view">
                                                <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                    class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="compare.html" title="compare"><span
                                                    class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="regular_price">$180.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">Bose SoundLink Bluetooth Speaker</a></h3>
                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                            </div>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="assets/img/product/product12.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="assets/img/product/product13.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">-47%</span>
                                </div>

                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box" title="quick view">
                                                <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                    class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="compare.html" title="compare"><span
                                                    class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="current_price">$160.00</span>
                                        <span class="old_price">$3200.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">Variable with soldout product for title</a></h3>
                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                            </div>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="assets/img/product/product15.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="assets/img/product/product14.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">-57%</span>
                                </div>

                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box" title="quick view">
                                                <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                    class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="compare.html" title="compare"><span
                                                    class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="regular_price">$150.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">Lorem ipsum dolor sit amet, consectetur</a></h3>
                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                            </div>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="assets/img/product/product16.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="assets/img/product/product17.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">-57%</span>
                                </div>

                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box" title="quick view">
                                                <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                    class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="compare.html" title="compare"><span
                                                    class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="regular_price">$175.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">JBL Flip 3 Splasroof Portable Bluetooth 2</a></h3>
                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                            </div>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="assets/img/product/product18.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="assets/img/product/product1.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">-07%</span>
                                </div>

                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box" title="quick view">
                                                <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                    class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="compare.html" title="compare"><span
                                                    class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                            </div>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="assets/img/product/product2.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="assets/img/product/product3.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">-57%</span>
                                </div>

                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box" title="quick view">
                                                <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                    class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="compare.html" title="compare"><span
                                                    class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="current_price">$140.00</span>
                                        <span class="old_price">$320.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_product">
                            <div class="product_name">
                                <h3><a href="product-details.html">Koss Porta Pro On Ear Headphones </a></h3>
                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                            </div>
                            <div class="product_thumb">
                                <a class="primary_img" href="product-details.html"><img
                                        src="assets/img/product/product4.jpg" alt=""></a>
                                <a class="secondary_img" href="product-details.html"><img
                                        src="assets/img/product/product5.jpg" alt=""></a>
                                <div class="label_product">
                                    <span class="label_sale">-57%</span>
                                </div>

                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box" title="quick view">
                                                <span class="lnr lnr-magnifier"></span></a></li>
                                        <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><span
                                                    class="lnr lnr-heart"></span></a></li>
                                        <li class="compare"><a href="compare.html" title="compare"><span
                                                    class="lnr lnr-sync"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_ratings">
                                    <ul>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                        <li><a href="#"><i class="ion-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_footer d-flex align-items-center">
                                    <div class="price_box">
                                        <span class="regular_price">$160.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="cart.html" title="add to cart"><span class="lnr lnr-cart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--product area end-->

    <!--banner area start-->
    <section class="banner_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_banner banner_fullwidth">
                        <div class="banner_thumb">
                            <a href="#"><img src="assets/img/bg/banner5.jpg" alt=""></a>
                            <div class="banner_text">
                                <h2>Win the cost of your</h2>
                                <h3>Tyres back</h3>
                                <p>Chance to win when you buy 2 + Pirell Tyres in March</p>
                                <a href="shop.html">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--banner area end-->

    <!--custom product area-->
    <section class="custom_product_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <!--featured product area-->
                    <div class="custom_product">
                        <div class="section_title">
                            <h2><span>Body Parts</span></h2>
                        </div>
                        <div class="small_product_items small_product_active">
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product1.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Variable with soldout product for title</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product2.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">JBL Flip 3 Splashproof Portable Bluetooth</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$170.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product3.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$160.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product4.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product5.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product6.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product1.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Variable with soldout product for title</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product2.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">JBL Flip 3 Splashproof Portable Bluetooth</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$170.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product3.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$160.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product4.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product5.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product6.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--featured product end-->
                </div>
                <div class="col-lg-4 col-md-12">
                    <!--mostview product area-->
                    <div class="custom_product">
                        <div class="section_title">
                            <h2><span>Body Parts</span></h2>
                        </div>
                        <div class="small_product_items small_product_active">
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product8.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$170.00</span>
                                        <span class="old_price">$430.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product9.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$170.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product4.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$160.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product10.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$160.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product11.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product12.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product8.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$170.00</span>
                                        <span class="old_price">$430.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product9.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$170.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product4.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$160.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product10.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$160.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product11.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product12.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--mostview product end-->
                </div>
                <div class="col-lg-4 col-md-12">
                    <!--bestSeller product area-->
                    <div class="custom_product">
                        <div class="section_title">
                            <h2><span>Body Parts</span></h2>
                        </div>
                        <div class="small_product_items small_product_active">
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product10.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Variable with soldout product for title</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product11.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">JBL Flip 3 Splashproof Portable Bluetooth</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$170.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product12.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$160.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product13.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product14.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product15.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product10.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Variable with soldout product for title</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product11.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">JBL Flip 3 Splashproof Portable Bluetooth</a>
                                        </h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$170.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product12.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Kodak PIXPRO Astro Zoom AZ421 16 MP</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="regular_price">$160.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product13.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product14.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">Accusantium dolorem Security Camera</a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="single_product_items">
                                <div class="product_thumb">
                                    <a href="product-details.html"><img src="assets/img/product/product15.jpg"
                                                                        alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <h3><a href="product-details.html">1. New and sale new badge product </a></h3>
                                    </div>
                                    <div class="product_ratings">
                                        <ul>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                            <li><a href="#"><i class="ion-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">$180.00</span>
                                        <span class="old_price">$420.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--bestSeller product end-->
                </div>
            </div>
        </div>
    </section>
    <!--custom product end-->

    <!--brand area start-->
    <div class="brand_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand_container owl-carousel">
                        <div class="single_brand">
                            <a href="#"><img src="assets/img/brand/brand.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="assets/img/brand/brand1.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="assets/img/brand/brand2.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="assets/img/brand/brand3.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="assets/img/brand/brand4.png" alt=""></a>
                        </div>
                        <div class="single_brand">
                            <a href="#"><img src="assets/img/brand/brand2.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--brand area end-->



    @endsection
