{{-- @dd($colors,$sizes) --}}
@extends('app')
@section('content')

@if (session('error'))
<script>
    alert("{{ session('error') }}");
</script>
<script>
    alert("{{ session('error') }}");
</script>
@endif
<div class="product_details mt-20">
    <div class="container">
        @if (session('message'))
        <div class="alert alert-success">
            <strong>{{ session('message') }}</strong>
            <p>{{ session('details') }}</p>
            <p>Mã đơn hàng: {{ session('order_id') }}</p>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="#">
                            <img id="zoom1" src="{{ asset('storage/' . $product->image_prd) }}" data-zoom-image="{{ asset('storage/' . $product->image_prd) }}" alt="big-1">
                        </a>
                    </div>
                    <div class="single-zoom-thumb">
                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                            <li>
                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ asset('storage/' . $product->image_prd) }}" data-zoom-image="{{ asset('storage/' . $product->image_prd) }}">
                                    <img src="{{ asset('storage/' . $product->image_prd) }}" alt="zo-th-1" />
                                </a>
                            </li>
                            @foreach($variations as $item)
                            <li>
                                <a href="#" class="elevatezoom-gallery" data-update="" data-image="{{ asset('storage/' . $item->image) }}" data-zoom-image="{{ asset('storage/' . $item->image) }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="zo-th-1" />
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="product_d_right">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <h1>{{ $product->name }}</h1>
                        <div class="price_box">
                            <span class="current_price">{{ $product->price_new }}vnđ</span>
                            <span class="old_price">{{ $product->price_old }}</span>
                        </div>
                        <div class="product_desc">
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="product_variant color">
                            <h3>Chọn màu</h3>
                            <ul>
                                @foreach($colors as $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input color-option" type="radio" name="selectedColor" id="{{ $value }}" value="{{ $value }}">
                                    <label class="form-check-label" for="{{ $value }}">{{ $value }}</label>
                                </div>
                                @endforeach
                            </ul>
                        </div>
                        <div class="product_variant size mb-4">
                            <h3>Chọn kích cỡ</h3>
                            @foreach($sizes as $value)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input size-option" data-size="{{ $value }}" type="radio" name="selectedSize" id="{{ $value }}" value="{{ $value }}">
                                <label class="form-check-label" for="{{ $value }}">{{ $value }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="product_variant quantity">
                            <label>Số Lượng</label>
                            <input name="quantity" id="quantityInput" min="1" max="{{ $stockQuantity }}" value="1" type="number">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="button" type="submit">Thêm vào Giỏ Hàng</button>
                        </div>
                    </form>
                    <div class="product_meta">
                        <span>Danh mục: <a href="#">{{ $category->name }}</a></span>
                        <div style="margin-top: 15px">
                            <label>Số lượng sản phẩm trong kho: {{ $sumQuantity }}</label>
                        </div>
                    </div>
                </div>

                </form>
                <div class="priduct_social">
                    <ul>
                        <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>
                        <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                        <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>
                        <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>
                        <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div>
            <div class="border-2 rounded mt-6">
                <div class="m-3">
                    <h2 class="mb-3 font-semibold text-xl">Đánh giá </h2>
                    <hr>
                    <div class="mt-3">


                        @if (count($reviews) > 0)
                        <div class="container my-4"> @foreach ($reviews as $comment)
                            <div class="card mb-4 border-0 shadow">
                                <div class="card-body">
                                    <!-- Header của bình luận -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-primary fw-bold">Khách hàng: {{ $comment->user->name }}</span>
                                        <small class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <!-- Nội dung bình luận -->
                                    <p class="fw-normal text-dark">{{ $comment->comment }}</p>
                                    <!-- Hiển thị số sao (rating) -->
                                    @if (isset($comment->rating) && $comment->rating > 0)
                                    <div class="mb-2">
                                        @for ($i = 0; $i < $comment->rating; $i++)
                                            <i class="fa fa-star text-warning"></i>
                                            @endfor
                                    </div>
                                    @else
                                    <p class="text-muted mb-2">Không có đánh giá.</p>
                                    @endif
                                    <!-- Hiển thị danh sách trả lời -->
                                    @if ($comment->replies->isNotEmpty())
                                    <div class="mt-4">
                                        <h6 class="text-success fw-bold">Trả lời:</h6>
                                        @foreach ($comment->replies as $reply)
                                        <div class="card my-2 border-start border-3 border-success">
                                            <div class="card-body">
                                                <!-- Header của trả lời -->
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-dark fw-bold">Admin</span>
                                                    <!-- <span class="text-dark fw-bold">{{ $reply->user->name }}</span> -->
                                                    <small class="text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                                                </div>
                                                <!-- Nội dung trả lời -->
                                                <p class="fw-light text-secondary mb-0">{{ $reply->comment }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @else
                        <p class="text-red-500 italic mt-8">*** Chưa có đánh giá nào cho sản phẩm này ***</p>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var sizesWithColors = @json($sizesWithColors);

    // Khi chọn màu, lọc kích thước phù hợp
    document.querySelectorAll('.color-option').forEach(function(colorInput) {
        colorInput.addEventListener('change', function() {
            var selectedColor = this.value;

            // Ẩn tất cả các size trước
            document.querySelectorAll('.size-option').forEach(function(sizeOption) {
                sizeOption.parentElement.style.display = 'none'; // Ẩn cả input và label
                sizeOption.checked = false; // Hủy chọn size
            });

            // Hiển thị size tương ứng với màu đã chọn
            for (var size in sizesWithColors) {
                sizesWithColors[size].forEach(function(variant) {
                    if (variant.color === selectedColor) {
                        var sizeOption = document.querySelector('.size-option[data-size="' + size + '"]');
                        if (sizeOption) {
                            sizeOption.parentElement.style.display = 'inline-block';
                        }
                    }
                });
            }
        });
    });

    // Cập nhật max của input quantity khi chọn size và màu
    document.querySelectorAll('.size-option').forEach(function(sizeInput) {
        sizeInput.addEventListener('change', function() {
            var selectedSize = this.value;
            var selectedColor = document.querySelector('.color-option:checked')?.value;

            if (selectedColor) {
                var variant = sizesWithColors[selectedSize]?.find(function(v) {
                    return v.color === selectedColor;
                });

                if (variant) {
                    var stockQuantity = variant.stock_quantity;
                    var quantityInput = document.getElementById('quantityInput');
                    quantityInput.max = stockQuantity;
                    quantityInput.value = Math.min(quantityInput.value, stockQuantity); // Đảm bảo giá trị không vượt quá tồn kho
                }
            }
        });
    });
</script>
@endsection