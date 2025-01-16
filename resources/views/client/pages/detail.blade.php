{{-- @dd($colors,$sizes) --}}
@extends('app')
@section('content')
    <style>
        .form-check-input {
            display: none;
        }

        .form-check-label {
            cursor: pointer;
            padding: 10px 15px;
            border: 2px solid lightgray;
            border-radius: 5px;
            transition: all 0.3s ease;

        }

        .form-check-input:checked+.form-check-label {
            border: 2px solid red;
            color: red;
            font-weight: bold;
        }
    </style>
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
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
             @endif
        
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
                                <img id="zoom1" src="{{ asset('storage/' . $product->image_prd) }}"
                                    data-zoom-image="{{ asset('storage/' . $product->image_prd) }}" alt="big-1">
                            </a>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update=""
                                        data-image="{{ asset('storage/' . $product->image_prd) }}"
                                        data-zoom-image="{{ asset('storage/' . $product->image_prd) }}">
                                        <img src="{{ asset('storage/' . $product->image_prd) }}" alt="zo-th-1" />
                                    </a>
                                </li>
                                @foreach ($variations as $item)
                                    <li>
                                        <a href="#" class="elevatezoom-gallery" data-update=""
                                            data-image="{{ asset('storage/' . $item->image) }}"
                                            data-zoom-image="{{ asset('storage/' . $item->image) }}">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="zo-th-1" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="col-lg-6 col-md-6">
                        <div class="product_d_right">

                            <h1>{{ $product->name }}</h1>
                            <div class="price_box">
                                <span class="current_price">{{ number_format($product->price_new, 0, ',', '.') }}
                                    VNĐ</span>
                                <span class="old_price">{{ number_format($product->price_old, 0, ',', '.') }} </span>

                            </div>
                            <div class="product_desc">
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="product_variant color">
                                <h3>Chọn màu</h3>
                                <ul>
                                    @foreach ($colors as $value)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input color-option" type="radio" name="selectedColor"
                                                id="{{ $value }}" value="{{ $value }}">
                                            <label class="form-check-label"
                                                for="{{ $value }}">{{ $value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="product_variant quantity">
                                    <label>Số Lượng</label>
                                    <input name="quantity" id="quantityInput" min="1" max="{{ $stockQuantity }}"
                                        value="1" type="number">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @if (Auth::check())
                                        <!-- Người dùng đã đăng nhập -->
                                        <button class="button" type="submit">Thêm vào Giỏ Hàng</button>
                                    @else
                                        <!-- Người dùng chưa đăng nhập -->
                                        <button class="button" type="button" id="buyNowButton">Mua Ngay</button>

                                    @endif

                                </div> --}}
                            {{-- </form> --}}
                                </ul>
                            </div>
                            <div class="product_variant size mb-4">
                                <h3>Chọn kích cỡ</h3>
                                @foreach ($sizes as $value)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input size-option" data-size="{{ $value }}"
                                            type="radio" name="selectedSize" id="{{ $value }}"
                                            value="{{ $value }}">
                                        <label class="form-check-label"
                                            for="{{ $value }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="product_variant quantity">
                                <label>Số Lượng</label>
                                <input name="quantity" id="quantityInput" min="1" max="{{ $stockQuantity }}"
                                    value="1" type="number">

                                <input type="hidden" name="product_id" id="product_cart_id" value="{{ $product->id }}">
                                @if (Auth::check())
                                        <!-- Người dùng đã đăng nhập -->
                                        <button class="button" type="button" id="btn_submit_cart">Thêm vào Giỏ Hàng</button>
                                    @else
                                        <!-- Người dùng chưa đăng nhập -->
                                        <button class="button" type="button" id="buyNowButton">Mua Ngay</button>

                                    @endif
                                
                            </div>


                            <form action="{{ route('wishlist.create', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class=" product_d_action">
                                    <ul>
                                        <li><button type="submit" title="Add to wishlist">+ Thêm vào danh mục yêu thích
                                            </button></li>
                                    </ul>
                                </div>

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
                                <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i>
                                        Like</a>
                                </li>
                                <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i>
                                        tweet</a>
                                </li>
                                <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i>
                                        save</a></li>
                                <li><a class="google-plus" href="#" title="google +"><i
                                            class="fa fa-google-plus"></i>
                                        share</a></li>
                                <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i>
                                        linked</a></li>
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
                                    <div class="container my-4">
                                        @foreach ($reviews as $comment)
                                            @if (is_null($comment->comment_parent) || $comment->comment_parent == 0)
                                                <!-- Kiểm tra comment_parent -->
                                                <div class="card mb-4 border-0 shadow">
                                                    <div class="card-body">
                                                        <!-- Header của bình luận -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-3">
                                                            <span class="text-primary fw-bold">Khách hàng:
                                                                {{ $comment->user->name }}</span>
                                                            <small
                                                                class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
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
                                                                    <div
                                                                        class="card my-2 border-start border-3 border-success">
                                                                        <div class="card-body">
                                                                            <!-- Header của trả lời -->
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                                <span
                                                                                    class="text-dark fw-bold">Admin</span>
                                                                                <!-- <span class="text-dark fw-bold">{{ $reply->user->name }}</span> -->
                                                                                <small
                                                                                    class="text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                                                                            </div>
                                                                            <!-- Nội dung trả lời -->
                                                                            <p class="fw-light text-secondary mb-0">
                                                                                {{ $reply->comment }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-red-500 italic mt-8">*** Chưa có đánh giá nào cho sản phẩm này ***</p>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

                <section class="product_area mb-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section_title">
                                    <h2><span> <strong>Sản phẩm</strong>liên quan</span></h2>
                                </div>

                                <div class="product_carousel product_column5 owl-carousel">
                                    @foreach ($productRelates as $productRelate)
                                        <div class="single_product">
                                            <div class="product_name">
                                                <h3><a
                                                        href="{{ route('detail-product', ['id' => $productRelate->id]) }}">{{ $productRelate->name }}</a>
                                                </h3>
                                                <p class="manufacture_product"><a href="#">Accessories</a></p>
                                            </div>
                                            <div class="product_thumb">
                                                <a class="primary_img"
                                                    href="{{ route('detail-product', ['id' => $productRelate->id]) }}">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($productRelate->image_prd) }}"
                                                        alt=""></a>
                                                <div class="label_product">
                                                    <span
                                                        class="label_sale">{{ $productRelate->total_sale_percentage }}%</span>
                                                </div>

                                                <div class="action_links">
                                                    <ul>
                                                        <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#modal_box" title="quick view">
                                                                <span class="lnr lnr-magnifier"></span></a></li>
                                                        <li class="wishlist"><a href="wishlist.html"
                                                                title="Add to Wishlist"><span
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
                                                        <small><del>{{ number_format($productRelate->price_old) }}</del></small>
                                                        <span
                                                            class="regular_price">{{ number_format($productRelate->price_new - ($productRelate->price_new * $productRelate->total_sale_percentage) / 100) }}
                                                            đ</span>
                                                    </div>
                                                    <div class="add_to_cart">
                                                        <a href="cart.html" title="add to cart"><span
                                                                class="lnr lnr-cart"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                var sizeOption = document.querySelector('.size-option[data-size="' +
                                    size + '"]');
                                if (sizeOption) {
                                    sizeOption.parentElement.style.display = 'inline-block';
                                }
                            }
                        });
                    }

                    // Reset giá khi chọn màu
                    updatePrice(null);
                });
            });

            // Cập nhật max của input quantity và giá khi chọn size và màu
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
                            var price = variant.price; // Giá của biến thể
                            var quantityInput = document.getElementById('quantityInput');

                            // Cập nhật max của input quantity
                            quantityInput.max = stockQuantity;
                            quantityInput.value = Math.min(quantityInput.value,
                                stockQuantity); // Đảm bảo giá trị không vượt quá tồn kho

                            // Cập nhật giá
                            updatePrice(price);
                        }
                    }
                });
            });

            // Hàm cập nhật giá
            function updatePrice(price) {
                var priceBox = document.querySelector('.price_box .current_price');
                if (price !== null) {
                    priceBox.textContent = price + "vnđ"; // Hiển thị giá biến thể
                } else {
                    priceBox.textContent = "{{ $product->price_new }}vnđ"; // Giá mặc định
                }
            }
        </script>
        <script>
            let selectedColor = ''; // Biến lưu màu sắc đã chọn
            let selectedSize = '';  // Biến lưu kích thước đã chọn
            let quantity = 1;       // Biến lưu số lượng sản phẩm
        
            // Lắng nghe sự kiện thay đổi khi chọn size
            document.querySelectorAll('.size-option').forEach(function(input) {
                input.addEventListener('change', function() {
                    selectedSize = this.value; // Lưu giá trị size đã chọn
                });
            });
        
            // Lắng nghe sự kiện thay đổi khi chọn color
            document.querySelectorAll('.color-option').forEach(function(input) {
                input.addEventListener('change', function() {
                    selectedColor = this.value; // Lưu giá trị color đã chọn
                });
            });
        
            // Lắng nghe sự kiện thay đổi số lượng
            document.getElementById('quantityInput')?.addEventListener('input', function() {
                quantity = this.value; // Lưu giá trị quantity đã nhập
            });
        
            // Hàm chuyển hướng đến trang thanh toán khi nhấn nút "Mua Ngay"
            document.getElementById('buyNowButton')?.addEventListener('click', function() {
                if (selectedColor && selectedSize && quantity) {
                    // Thay thế các tham số trong route
                    let url = '{{ route('guest.checkout', ['id_product' => $product->id, 'color' => ':color', 'size' => ':size', 'quantity' => ':quantity']) }}'
                        .replace(':color', selectedColor)  // Thay thế :color bằng giá trị người dùng chọn
                        .replace(':size', selectedSize)    // Thay thế :size bằng giá trị người dùng chọn
                        .replace(':quantity', quantity);   // Thay thế :quantity bằng số lượng người dùng nhập
                    
                    window.location.href = url; // Chuyển hướng đến URL thanh toán
                } else {
                    alert('Vui lòng chọn đầy đủ thông tin (size, color, quantity).');
                }
            });
        </script>
        

        <script>
            let color = '';
            let size = '';
            let quantityy= 1;

            function statusAlert(type, title, message) {
                Swal.fire({
                    icon: `${type}`,
                    title: `${title}`,
                    text: `${message}`,

                });
            }

            function getSelectedColor() {
                const selectedColor = document.querySelector('input[name="selectedColor"]:checked');
                return selectedColor ? selectedColor.value : null;
            }

            function getSelectedSize() {
                const selectedSize = document.querySelector('input[name="selectedSize"]:checked');
                return selectedSize ? selectedSize.value : null;
            }

            document.querySelectorAll('input[name="selectedColor"]').forEach(input => {
                input.addEventListener('change', () => {
                    color = getSelectedColor();
                });
            });

            document.querySelectorAll('input[name="selectedSize"]').forEach(input => {
                input.addEventListener('change', () => {
                    size = getSelectedSize();
                });
            });
            const quantitys = document.querySelector('#quantityInput');
            quantitys.addEventListener('change', () => {
                quantityy = quantitys.value;

            })
            const id = document.querySelector('#product_cart_id').value;
            const btn_cart = document.querySelector('#btn_submit_cart');


            btn_cart.addEventListener('click', () => {
                if (color == "" || size == "") {
                    statusAlert('error', 'Lỗi', 'Vui lòng chọn phân loại');
                } else {
                    $.ajax({
                        url: "{{ route('cart.add') }}",
                        method: "GET",
                        data: {
                            color,
                            size,
                            quantity:quantityy,
                            id

                        },
                        success: function(response) {

                            statusAlert(response.type, response.title, response.message);


                        }

                    });
                }

            })
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const colorOptions = document.querySelectorAll(".color-option");
                const sizeOptions = document.querySelectorAll(".size-option");

                colorOptions.forEach(input => {
                    input.addEventListener("change", function() {
                        document.querySelectorAll(".color-option + label").forEach(label => {
                            label.style.border = "2px solid transparent";
                        });
                        this.nextElementSibling.style.border = "2px solid red";
                    });
                });

                sizeOptions.forEach(input => {
                    input.addEventListener("change", function() {
                        document.querySelectorAll(".size-option + label").forEach(label => {
                            label.style.border = "2px solid transparent";
                        });
                        this.nextElementSibling.style.border = "2px solid red";
                    });
                });
            });
        </script>

    @endsection
