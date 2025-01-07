@extends('app')

@section('content')
<!-- Shopping Cart Area Start -->
<div class="shopping_cart_area my-5">
    <div class="container">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form action="{{ route('confirm_checkout') }}" method="post">
            @csrf
            <div class="row">
                @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
                @endif
                <div class="col-12">
                    <!-- Cart Table -->
                    <div class="card shadow border-0">
                        <div class="card-header text-danger p-3">
                            <img
                                src="https://static.vecteezy.com/system/resources/thumbnails/021/491/887/small_2x/shopping-cart-element-for-delivery-concept-png.png"
                                alt="cart_icon" width="40" height="40">
                                @if (Auth::check())
                                <span style="margin-left: 10px;">Giỏ hàng của: <b>{{ Auth::user()->name }}</b></span>
                            @else
                                <span style="margin-left: 10px;">Giỏ hàng của bạn</span>
                            @endif
                            
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th scope="col"><input type="checkbox" class="form-check-input" id="select-all"></th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Phân loại</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thành tiền</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach($cartItems as $key)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input item-checkbox" name="cart_item_id[]"
                                                   value="{{ $key->id }}">
                                        </td>
                                        <td>
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($key->image) }}"
                                                 class="img-thumbnail"
                                                 style="width: 100px; height: 100px;" alt="Product">
                                        </td>
                                        <td>{{ $key->product_name }}</td>
                                        <td>
                                            <div class="d-flex flex-column align-items-start">
                                                <!-- Dropdown cho kích cỡ -->
                                                <div class="mb-2">
                                                    <label for="size" class="form-label mb-1">Kích cỡ</label>
                                                    <select name="size[]" class="form-select form-select-sm size-select" 
                                                            data-product-id="{{ $key['product_id'] }}" 
                                                            data-sizes-colors="{{ json_encode($sizesWithColors[$key['product_id']] ?? []) }}">
                                                        <option value="">Chọn kích cỡ</option>
                                                        @foreach(array_keys($sizesWithColors[$key['product_id']] ?? []) as $size)
                                                            <option value="{{ $size }}" 
                                                                    {{ $key['size'] === $size ? 'selected' : '' }}>
                                                                {{ $size }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        
                                                <!-- Dropdown cho màu sắc -->
                                                <div class="mb-2">
                                                    <label for="color" class="form-label mb-1">Màu sắc</label>
                                                    <select name="color[]" class="form-select form-select-sm color-select" 
                                                            data-product-id="{{ $key['product_id'] }}" 
                                                            data-sizes-colors="{{ json_encode($sizesWithColors[$key['product_id']] ?? []) }}">
                                                        <option value="">Chọn màu sắc</option>
                                                        @php
                                                            // Lấy tất cả các màu sắc của tất cả các size cho product_id này và loại bỏ màu trùng lặp
                                                            $allColors = collect($sizesWithColors[$key['product_id']] ?? [])
                                                                ->flatten() // Làm phẳng mảng size => màu sắc
                                                                ->unique(); // Loại bỏ màu trùng lặp
                                                        @endphp
                                                        @foreach($allColors as $color)
                                                            <option value="{{ $color }}" 
                                                                    {{ $key['color'] === $color ? 'selected' : '' }}>
                                                                {{ $color }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </td>         
                                        <td>{{ number_format($key->price, 0, ',', '.') }}đ</td>
                                        <td>
                                            <input name ="quantity[]" type="number" class="form-control w-50 quantity-input"
                                                   value="{{ $key->quantity }}" min="1" max="100"
                                                   data-price="{{ $key->price }}" data-cart-item-id="{{ $key->id }}"
                                                   onchange="updateCart(this)">
                                        </td>
                                        <td class="product_total">
                                            <span>{{ number_format($key->quantity * $key->price, 0, ',', '.') }}</span>đ
                                        </td>
                                        <td>
                                            <a href="{{ route('cart.remove', ['id' => $key->id]) }}" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach --}}
                                    @foreach($cartItems as $key)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input item-checkbox" name="cart_item_id[]"
                                                    value="{{ $key->id ?? $loop->index }}">
                                            </td>
                                            <td>
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($key->image) }}"
                                                    class="img-thumbnail"
                                                    style="width: 100px; height: 100px;" alt="Product">
                                            </td>
                                            <td>{{ $key->product_name }}</td>
                                            <td>
                                                <div class="d-flex flex-column align-items-start">
                                                    <!-- Dropdown cho kích cỡ -->
                                                    <div class="mb-2">
                                                        <label for="size" class="form-label mb-1">Kích cỡ</label>
                                                        <select name="size[]" class="form-select form-select-sm size-select" 
                                                                data-product-id="{{ $key->product_id }}" 
                                                                data-sizes-colors="{{ json_encode($sizesWithColors[$key->product_id] ?? []) }}">
                                                            <option value="">Chọn kích cỡ</option>
                                                            @foreach(array_keys($sizesWithColors[$key->product_id] ?? []) as $size)
                                                                <option value="{{ $size }}" 
                                                                        {{ $key->size === $size ? 'selected' : '' }}>
                                                                    {{ $size }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                
                                                    <!-- Dropdown cho màu sắc -->
                                                    <div class="mb-2">
                                                        <label for="color" class="form-label mb-1">Màu sắc</label>
                                                        <select name="color[]" class="form-select form-select-sm color-select" 
                                                                data-product-id="{{ $key->product_id }}" 
                                                                data-sizes-colors="{{ json_encode($sizesWithColors[$key->product_id] ?? []) }}">
                                                            <option value="">Chọn màu sắc</option>
                                                            @php
                                                                // Lấy tất cả các màu sắc của tất cả các size cho product_id này và loại bỏ màu trùng lặp
                                                                $allColors = collect($sizesWithColors[$key->product_id] ?? [])
                                                                    ->flatten() // Làm phẳng mảng size => màu sắc
                                                                    ->unique(); // Loại bỏ màu trùng lặp
                                                            @endphp
                                                            @foreach($allColors as $color)
                                                                <option value="{{ $color }}" 
                                                                        {{ $key->color === $color ? 'selected' : '' }}>
                                                                    {{ $color }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>         
                                            <td>{{ number_format($key->price, 0, ',', '.') }}đ</td>
                                            <td>
                                                <input name="quantity[]" type="number" class="form-control w-50 quantity-input"
                                                    value="{{ $key->quantity }}" min="1" max="100"
                                                    data-price="{{ $key->price }}" data-cart-item-id="{{ $key->id ?? $loop->index }}"
                                                    onchange="updateCart(this)">
                                            </td>
                                            <td class="product_total">
                                                <span>{{ number_format($key->quantity * $key->price, 0, ',', '.') }}</span>đ
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.remove', ['id' => $key->id ?? $loop->index]) }}" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Coupon Code Area -->
                    <div class="row mt-4">
                        <div class="col-lg-6 mt-3">
                            <div class="card shadow border-0">
                                
                                <div class="card-header text-danger">
                                    <img
                                        src="https://images.emojiterra.com/microsoft/fluent-emoji/15.1/1024px/1f4b8_color.png"
                                        alt="total_money_icon" width="30" height="30">
                                    <span style="margin-left: 10px;">Tổng giỏ hàng</span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0">Tổng tiền:</p>
                                        <p class="mb-0 fw-bold cart_amount total">{{ number_format($totalAmount, 0, ',', '.') }}đ</p>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn text-white w-100" id="next_btn" data-url="{{ route('confirm_checkout') }}" style="background-color: #ff6600;">Thanh toán</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Coupon Code Area End -->
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="/assets/js/cart.js"></script>
</script>
{{-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const sizeSelects = document.querySelectorAll('.size-select');
    const colorSelects = document.querySelectorAll('.color-select');

    // Lắng nghe sự kiện thay đổi trên kích cỡ
    sizeSelects.forEach(function(sizeSelect) {
        sizeSelect.addEventListener('change', function() {
            const productId = this.getAttribute('data-product-id');
            const selectedSize = this.value;
            const sizesWithColors = JSON.parse(this.getAttribute('data-sizes-colors'));

            // Lấy tất cả màu sắc có sẵn cho size đã chọn
            const availableColors = sizesWithColors[selectedSize] || [];

            // Cập nhật dropdown màu sắc dựa trên size đã chọn
            colorSelects.forEach(function(colorSelect) {
                if (colorSelect.getAttribute('data-product-id') == productId) {
                    const colorOptions = colorSelect.querySelectorAll('option');
                    colorOptions.forEach(function(option) {
                        if (selectedSize === "") {
                            // Nếu size chọn là "", cho phép chọn tất cả màu
                            option.disabled = false;
                        } else if (!availableColors.includes(option.value)) {
                            // Vô hiệu hóa màu không hợp lệ
                            option.disabled = true;
                        } else {
                            option.disabled = false;
                        }
                    });

                    // Nếu không có màu sắc nào được chọn, reset lại dropdown màu sắc
                    if (!availableColors.includes(colorSelect.value) && colorSelect.value !== "") {
                        colorSelect.value = ''; // Reset về giá trị mặc định
                    }
                }
            });
        });
    });

    // Lắng nghe sự kiện thay đổi trên màu sắc
    colorSelects.forEach(function(colorSelect) {
        colorSelect.addEventListener('change', function() {
            const productId = this.getAttribute('data-product-id');
            const selectedColor = this.value;
            const sizesWithColors = JSON.parse(this.getAttribute('data-sizes-colors'));

            // Lọc kích cỡ dựa trên màu sắc đã chọn
            let availableSizes = [];
            for (let size in sizesWithColors) {
                if (sizesWithColors[size].includes(selectedColor)) {
                    availableSizes.push(size);
                }
            }

            // Cập nhật dropdown kích cỡ dựa trên màu sắc đã chọn
            sizeSelects.forEach(function(sizeSelect) {
                if (sizeSelect.getAttribute('data-product-id') == productId) {
                    const sizeOptions = sizeSelect.querySelectorAll('option');
                    sizeOptions.forEach(function(option) {
                        if (selectedColor === "") {
                            // Nếu color chọn là "", cho phép chọn tất cả size
                            option.disabled = false;
                        } else if (!availableSizes.includes(option.value)) {
                            // Vô hiệu hóa size không hợp lệ
                            option.disabled = true;
                        } else {
                            option.disabled = false;
                        }
                    });

                    // Nếu không có kích cỡ nào được chọn, reset lại dropdown kích cỡ
                    if (!availableSizes.includes(sizeSelect.value) && sizeSelect.value !== "") {
                        sizeSelect.value = ''; // Reset về giá trị mặc định
                    }
                }
            });
        });
    });

    // Khi một trong các dropdown thay đổi, reset tất cả các dropdowns và các lựa chọn
    function resetOptions() {
        sizeSelects.forEach(function(sizeSelect) {
            const colorSelect = sizeSelect.closest('td').querySelector('.color-select');
            const productId = sizeSelect.getAttribute('data-product-id');
            const sizesWithColors = JSON.parse(sizeSelect.getAttribute('data-sizes-colors'));

            // Enable lại tất cả màu sắc khi size thay đổi
            const colorOptions = colorSelect.querySelectorAll('option');
            colorOptions.forEach(function(option) {
                option.disabled = false; // Bỏ vô hiệu hóa tất cả các màu
            });

            // Enable lại tất cả các size khi color thay đổi
            const sizeOptions = sizeSelect.querySelectorAll('option');
            sizeOptions.forEach(function(option) {
                option.disabled = false; // Bỏ vô hiệu hóa tất cả các size
            });
        });
    }

    // Reset các options khi page load hoặc khi người dùng thay đổi
    resetOptions();
});
</script> --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const sizeSelects = document.querySelectorAll('.size-select');
    const colorSelects = document.querySelectorAll('.color-select');
    const checkboxes = document.querySelectorAll('.item-checkbox');

    // Lắng nghe sự kiện thay đổi trên kích cỡ
    sizeSelects.forEach(function (sizeSelect) {
        sizeSelect.addEventListener('change', function () {
            const productId = this.getAttribute('data-product-id');
            const selectedSize = this.value;
            const sizesWithColors = JSON.parse(this.getAttribute('data-sizes-colors'));

            // Lấy tất cả màu sắc có sẵn cho size đã chọn
            const availableColors = sizesWithColors[selectedSize] || [];

            // Cập nhật dropdown màu sắc dựa trên size đã chọn
            colorSelects.forEach(function (colorSelect) {
                if (colorSelect.getAttribute('data-product-id') == productId) {
                    const colorOptions = colorSelect.querySelectorAll('option');
                    colorOptions.forEach(function (option) {
                        if (selectedSize === "") {
                            option.disabled = false; // Cho phép chọn tất cả màu
                        } else if (!availableColors.includes(option.value)) {
                            option.disabled = true; // Vô hiệu hóa màu không hợp lệ
                        } else {
                            option.disabled = false;
                        }
                    });

                    // Reset giá trị nếu màu sắc đã chọn không còn khả dụng
                    if (!availableColors.includes(colorSelect.value) && colorSelect.value !== "") {
                        colorSelect.value = ''; // Reset về giá trị mặc định
                    }
                }
            });

            updateCheckboxStatus(productId); // Cập nhật trạng thái checkbox
        });
    });

    // Lắng nghe sự kiện thay đổi trên màu sắc
    colorSelects.forEach(function (colorSelect) {
        colorSelect.addEventListener('change', function () {
            const productId = this.getAttribute('data-product-id');
            const selectedColor = this.value;
            const sizesWithColors = JSON.parse(this.getAttribute('data-sizes-colors'));

            // Lọc kích cỡ dựa trên màu sắc đã chọn
            let availableSizes = [];
            for (let size in sizesWithColors) {
                if (sizesWithColors[size].includes(selectedColor)) {
                    availableSizes.push(size);
                }
            }

            // Cập nhật dropdown kích cỡ dựa trên màu sắc đã chọn
            sizeSelects.forEach(function (sizeSelect) {
                if (sizeSelect.getAttribute('data-product-id') == productId) {
                    const sizeOptions = sizeSelect.querySelectorAll('option');
                    sizeOptions.forEach(function (option) {
                        if (selectedColor === "") {
                            option.disabled = false; // Cho phép chọn tất cả size
                        } else if (!availableSizes.includes(option.value)) {
                            option.disabled = true; // Vô hiệu hóa size không hợp lệ
                        } else {
                            option.disabled = false;
                        }
                    });

                    // Reset giá trị nếu kích cỡ đã chọn không còn khả dụng
                    if (!availableSizes.includes(sizeSelect.value) && sizeSelect.value !== "") {
                        sizeSelect.value = ''; // Reset về giá trị mặc định
                    }
                }
            });

            updateCheckboxStatus(productId); // Cập nhật trạng thái checkbox
        });
    });

    // Hàm cập nhật trạng thái checkbox dựa trên kích cỡ và màu sắc đã chọn
    function updateCheckboxStatus(productId) {
        checkboxes.forEach(function (checkbox) {
            if (checkbox.value == productId) {
                const sizeSelect = document.querySelector(`.size-select[data-product-id="${productId}"]`);
                const colorSelect = document.querySelector(`.color-select[data-product-id="${productId}"]`);

                // Kích hoạt checkbox nếu cả size và màu sắc được chọn
                if (sizeSelect && colorSelect && sizeSelect.value && colorSelect.value) {
                    checkbox.checked = true;
                } else {
                    checkbox.checked = false;
                }
            }
        });
    }

    // Khi một trong các dropdown thay đổi, reset tất cả các dropdowns và các lựa chọn
    function resetOptions() {
        sizeSelects.forEach(function (sizeSelect) {
            const colorSelect = sizeSelect.closest('td').querySelector('.color-select');
            const productId = sizeSelect.getAttribute('data-product-id');
            const sizesWithColors = JSON.parse(sizeSelect.getAttribute('data-sizes-colors'));

            // Enable lại tất cả màu sắc khi size thay đổi
            const colorOptions = colorSelect.querySelectorAll('option');
            colorOptions.forEach(function (option) {
                option.disabled = false; // Bỏ vô hiệu hóa tất cả các màu
            });

            // Enable lại tất cả các size khi color thay đổi
            const sizeOptions = sizeSelect.querySelectorAll('option');
            sizeOptions.forEach(function (option) {
                option.disabled = false; // Bỏ vô hiệu hóa tất cả các size
            });
        });
    }

    // Reset các options khi page load hoặc khi người dùng thay đổi
    resetOptions();

    // Đảm bảo logic checkbox hoạt động không phụ thuộc vào đăng nhập
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const row = this.closest('tr');
            const sizeSelect = row.querySelector('.size-select');
            const colorSelect = row.querySelector('.color-select');

            if (this.checked) {
                // Kiểm tra size và color có được chọn chưa
                if (!sizeSelect.value || !colorSelect.value) {
                    alert("Vui lòng chọn kích cỡ và màu sắc trước khi thanh toán.");
                    this.checked = false; // Bỏ chọn nếu không hợp lệ
                }
            }
        });
    });
});
</script>




   


@endsection
