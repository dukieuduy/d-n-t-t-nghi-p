@extends('app')

@section('content')

    <section class="search_result_area mb-50">
        <div class="container">
            <h4 class="mb-30">Kết quả tìm kiếm cho: "{{ $query }}"</h4>
            @if($listProduct->isEmpty())
                <p>Không tìm thấy sản phẩm nào.</p>
            @else
                <!-- Hiển thị chỉ 1 sản phẩm đầu tiên -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="brake" role="tabpanel">
                        <div class="product_carousel product_column1">
                            <!-- Hiển thị sản phẩm đầu tiên -->
                            <div class="single_product_list">
                                <div class="single_product">
                                    <div class="product_name">
                                        <h3>
                                            <a href="{{ route('detail-product', ['id' => $listProduct->first()->id]) }}">
                                                {{ $listProduct->first()->name }}
                                            </a>
                                        </h3>
                                        <p class="manufacture_product"><a href="#">Accessories</a></p>
                                    </div>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="{{ route('detail-product', ['id' => $listProduct->first()->id]) }}">
                                            <img src="{{ asset('storage/' . $listProduct->first()->lowest_price_image) }}" alt="Hình ảnh sản phẩm">
                                        </a>

                                        @if (isset($listProduct->first()->promotion))
                                            <div class="label_product">
                                                <span class="label_sale">-{{ number_format($listProduct->first()->promotion->discount_percentage, 0) }}%</span>
                                            </div>
                                        @endif

                                        <div class="action_links">
                                            <ul>
                                                <li class="quick_button">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view">
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
                                            </ul>
                                        </div>
                                        <div class="product_footer d-flex align-items-center">
                                            <div class="price_box">
                                                @if (isset($listProduct->first()->promotion))
                                                    <span class="current_price">{{ number_format($listProduct->first()->lowest_price_variation, 2) }} VND</span>
                                                    <span class="old_price">{{ number_format($listProduct->first()->original_price, 2) }} VND</span>
                                                @else
                                                    <span class="regular_price">{{ number_format($listProduct->first()->original_price, 2) }} VND</span>
                                                @endif
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
                            <!-- Kết thúc sản phẩm đầu tiên -->
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Kết thúc kết quả tìm kiếm -->
@endsection
