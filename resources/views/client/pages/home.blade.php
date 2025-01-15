@extends('app')
@section('content')
    <!--slider area start-->
    {{-- banner --}}
    <section class="slider_section slider_two mb-50">
        <div class="slider_area owl-carousel">
            @foreach ($banner as $b)
                <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('storage/banners/' . $b->image) }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="slider_content">
                                    <h2 style="color:white">{{ $b->title }}</h2>
                                    <h1 style="color:white">{!! $b->content !!}</h1> <br>
                                    <a class="button"
                                        href="{{ route('detail-product', ['id' => $b->product_id]) }}">Shopping now!</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </section>
    <!--slider area end-->
    <!--product area start-->


    <section class="product_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span>Sản phẩm của chúng tôi</span></h2>
                        <!-- Danh sách danh mục -->
                        <ul class="product_tab_button nav" role="tablist" id="nav-tab">
                            @foreach ($categories as $index => $category)
                                @if ($category->is_active == 1)
                                    <li>
                                        <a 
                                            class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                            data-bs-toggle="tab" 
                                            href="#category-{{ $category->id }}" 
                                            role="tab" 
                                            aria-controls="category-{{ $category->id }}" 
                                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        
            <!-- Hiển thị sản phẩm theo danh mục -->
            <div class="tab-content">
                @foreach ($categories as $index => $category)
                    <div 
                        class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                        id="category-{{ $category->id }}" 
                        role="tabpanel" 
                        aria-labelledby="category-{{ $category->id }}">
        
                        <!-- Hiển thị sản phẩm thuộc danh mục này -->
                        <div class="product_carousel product_column5 owl-carousel">
                            @foreach ($products as $item)
                                @if ($item->category_id == $category->id)
                                    <div class="single_product_list">
                                        <div class="single_product">
                                            <div class="product_name">
                                                <h3>
                                                    <a href="{{ route('detail-product', ['id' => $item->id]) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="product_thumb">
                                                <a class="primary_img" href="{{ route('detail-product', ['id' => $item->id]) }}">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image_prd) }}" alt="">
                                                </a>
                                                <div class="label_product">
                                                    <span class="label_sale">{{ $item->total_sale_percentage }}%</span>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        
                                                        <li class="wishlist">
                                                            <a href="wishlist.html" title="Add to Wishlist">
                                                                <span class="lnr lnr-heart"></span>
                                                            </a>
                                                        </li>
                                                        
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
                                                        <small><del>{{ number_format($item->price_old) }}</del></small>
                                                        <span class="regular_price">
                                                            {{ number_format($item->price_new - ($item->price_new * $item->total_sale_percentage / 100)) }} đ
                                                        </span>
                                                    </div>
                                                    <div class="add_to_cart">
                                                        <a href="cart.html" title="add to cart">
                                                            <span class="lnr lnr-cart"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--product area end-->

    @endsection
