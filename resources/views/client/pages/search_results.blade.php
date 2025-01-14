@extends('app')

@section('content')
    <section class="search_result_area mb-50">
                <div class="container">
                    <h4 class="mb-30">Kết quả tìm kiếm cho: "{{ $key_word }}"</h4>
                    @if($listProduct->isEmpty())
                        <p>Không tìm thấy sản phẩm nào.</p>
                    @else
                        <div class="row">
                            <!-- Hiển thị tất cả sản phẩm -->
                            @foreach ($listProduct as $product)
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100">
                                        <!-- Hình ảnh sản phẩm -->
                                        <a href="{{ route('detail-product', ['id' => $product->id]) }}">
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image_prd) }}" 
                                                 class="card-img-top img-fluid" 
                                                 alt="{{ $product->name }}">
                                        </a>
                                        <!-- Thông tin sản phẩm -->
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('detail-product', ['id' => $product->id]) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h5>
                                            <div class="price_box">
                                                <span class="current_price text-success fw-bold">
                                                    {{ number_format($product->price_new, 0) }} VND
                                                </span>
                                                @if ($product->price_od > $product->price_new)
                                                    <span class="old_price text-muted text-decoration-line-through">
                                                        {{ number_format($product->price_od, 0) }} VND
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Nút thêm vào giỏ hàng -->
                                        <div class="card-footer d-flex justify-content-between align-items-center">
                                            <a href="cart.html" class="btn btn-primary btn-sm">
                                                <span class="lnr lnr-cart"></span> Thêm vào giỏ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Kết thúc vòng lặp -->
                        </div>            
            @endif
        </div>
    </section>
    <!-- Kết thúc kết quả tìm kiếm -->
@endsection
