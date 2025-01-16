@extends('app')
@section('content')
    <section class="product_area mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><span><strong>Danh mục :</strong>{{ $names[0] }} </span></h2>
                        <!-- Danh sách danh mục -->
                        <ul class="product_tab_button nav" >
                            @foreach ($categories as $index => $category)
                                @if ($category->is_active == 1)
                                    <li>
                                        <a href="{{ route('category_page', $category->id) }}">
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
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="category-{{ $category->id }}"
                        role="tabpanel" aria-labelledby="category-{{ $category->id }}">

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
                                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                                            </div>
                                            <div class="product_thumb">
                                                <a class="primary_img"
                                                    href="{{ route('detail-product', ['id' => $item->id]) }}">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image_prd) }}"
                                                        alt="">
                                                </a>
                                                <div class="label_product">
                                                    <span class="label_sale">{{ $item->total_sale_percentage }}%</span>
                                                </div>
                                                <div class="action_links">
                                                    <ul>
                                                        <li class="quick_button">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#modal_box" title="quick view">
                                                                <span class="lnr lnr-magnifier"></span>
                                                            </a>
                                                        </li>
                                                        <li class="wishlist">
                                                            <a href="wishlist.html" title="Add to Wishlist">
                                                                <span class="lnr lnr-heart"></span>
                                                            </a>
                                                        </li>
                                                        <li class="compare">
                                                            <a href="compare.html" title="compare">
                                                                <span class="lnr lnr-sync"></span>
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
                                                            {{ number_format($item->price_new - ($item->price_new * $item->total_sale_percentage) / 100) }}
                                                            đ
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
@endsection
