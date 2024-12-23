@extends('app')
@section('content')
<!-- SweetAlert2 CSS -->

<!-- SweetAlert2 JS -->

    <!-- Shopping Cart Area Start -->
    <div class="shopping_cart_area my-5">
        <div class="container">
            <form action="{{route('checkout')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <!-- Cart Table -->
                        <div class="card shadow border-0">
                            <div class="card-header text-danger p-3">
                                <img
                                    src="https://static.vecteezy.com/system/resources/thumbnails/021/491/887/small_2x/shopping-cart-element-for-delivery-concept-png.png"
                                    alt="cart_icon" width="40" height="40">
                                <span style="margin-left: 10px;">Giỏ hàng của: <b>{{ Auth::user()->name }}</b> </span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Phân loại</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $key)
                                            <!-- Gửi product_sku như một mảng -->
                                            <input type="hidden" name="product_sku[]" value="{{ $key->product_sku }}">
                                            <tr>
                                                <td>
                                                    <span class="d-none cart_item_id">{{ $key->id }}</span>
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
                                                            <select id="size" class="form-select form-select-sm" disabled>
                                                                <option value="">{{ $key->size }}</option>
                                                            </select>
                                                        </div>
                                                        <!-- Dropdown cho màu sắc -->
                                                        <div>
                                                            <label for="color" class="form-label mb-1">Màu sắc</label>
                                                            <select id="color" class="form-select form-select-sm" disabled>
                                                                <option value="">{{ $key->color }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($key->price, 0, ',', '.') }}đ</td>
                                                <td>
                                                    <!-- Sửa lại name cho quantity thành mảng -->
                                                    <input name="quantity[]" type="number" class="form-control w-50 quantity-input" readonly
                                                           value="{{ $key->quantity }}" min="1" max="100">
                                                </td>
                                                <td class="product_total">
                                                    <span class="d-none price">{{ number_format($key->price, 0, ',', '.') }}</span>
                                                    <span class="subtotal">{{ number_format($key->quantity * $key->price, 0, ',', '.') }}</span>đ
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
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <div class="card shadow border-0">
                                        <div class="card-header text-danger">
                                            <img
                                                src="https://i.pinimg.com/originals/66/a6/6b/66a66bca51f6e2770ecfa63c40e97a0a.png"
                                                alt="coupon_icon" width="30" height="30">
                                            <span style="margin-left: 10px;">Mã giảm giá</span>
                                        </div>
                                        <div class="card-body">
                                            Nhập mã giảm giá của bạn:

                                            <!-- Input cho mã giảm giá dạng văn bản -->
                                            <input type="text" class="form-control mb-3" placeholder="Mã giảm giá"
                                                   style="font-size: 18px;">

                                            <!-- Thêm dòng mã giảm giá với các option -->
                                            <label for="discount-options">Mã giảm giá đã lưu:</label>
                                            <select id="discount-options" class="form-control mb-3"
                                                    style="font-size: 17px;">
                                                <option value="">Chọn mã giảm giá</option>
                                                <option value="DISCOUNT10">DISCOUNT10 - Giảm 10%</option>
                                                <option value="DISCOUNT20">DISCOUNT20 - Giảm 20%</option>
                                                <option value="DISCOUNT30">DISCOUNT30 - Giảm 30%</option>
                                            </select>

                                            <!-- Button Áp dụng -->
                                            <button type="submit" class="btn text-white" style="background-color: #00CC99;">
                                                Áp
                                                dụng
                                            </button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-6 mb-2">
                                        <div class="card-body">
                                            <div class="card shadow border-0">
                                                <div class="card-header text-danger">
                                                    <span style="margin-left: 10px;">Địa chỉ nhận hàng</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="province" class="form-label">Tỉnh/Thành phố:</label>
                                                        <select id="province" name="province_id" class="form-select">
                                                            <option value="">-- Chọn --</option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger" id="error_province"></span>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="district" class="form-label">Quận/Huyện:</label>
                                                        <select id="district" name="district" class="form-select" disabled>
                                                            <option value="">-- Chọn --</option>
                                                        </select>
                                                        <span class="text-danger" id="error_district"></span>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="ward" class="form-label">Xã/Phường:</label>
                                                        <select id="ward" name="ward" class="form-select" disabled>
                                                            <option value="">-- Chọn --</option>
                                                        </select>
                                                        <span class="text-danger" id="error_ward"></span>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        
                                        <span class="text-danger mx-4" id="error_address"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-6 mb-2">
                                    <div class="card shadow border-0">
                                        <div class="card-header text-danger">
                                            <span style="margin-left: 10px;">Phương thức thanh toán</span>
                                        </div>
                                        <div class="card-body mx-3">
                                            <label>
                                                <input type="radio" name="payment_method" value="CASH" >
                                                <img
                                                    src="https://thumbs.dreamstime.com/b/earn-money-vector-logo-icon-design-salary-symbol-design-hand-illustrations-earn-money-vector-logo-icon-design-salary-symbol-152893719.jpg"
                                                    alt="VNPay Logo" width="50" height="50">
                                                Thanh toán khi nhận hàng
                                            </label> <br> <br>
                                            <label>
                                                <input type="radio" name="payment_method" value="VNPAY" >
                                                <img src="https://vinadesign.vn/uploads/images/2023/05/vnpay-logo-vinadesign-25-12-57-55.jpg"
                                                     alt="VNPay Logo" width="50" height="50">
                                                Thanh toán bằng VNPay
                                            </label>
                                            <br> <br>

                                            <label>
                                                <input type="radio" name="payment_method" value="MOMO" >
                                                <img
                                                    src="https://developers.momo.vn/v3/vi/assets/images/circle-a14ff76cbd316ccef146fa7deaaace2e.png"
                                                    alt="Momo Logo" width="50" height="50">
                                                Thanh toán bằng Momo
                                            </label>
                                            <br>
                                            <span class="text-danger" id="error_payment"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
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
                                                <p class="mb-0 fw-bold cart_amount total">{{ $totalAmount}}đ</p>
                                                <input type="hidden" name="total_amount" value="{{ $totalAmount}}">
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between shipping-fee-container" style="display: none;">
                                                <p class="mb-0">Phí vận chuyển:</p>
                                                <p class="mb-0 fw-bold shipping-fee" data-shipping="0">0đ</p>
                                                <input type="hidden" name="ship" id="ship">
                                            </div>
                                            
                                            
                                            {{-- <hr> --}}
                                            {{-- <div class="d-flex justify-content-between">
                                                <p class="mb-0">Tổng cộng:</p>
                                                <p class="mb-0 fw-bold text-success ">
                                                    <input type="text" class="form-control-plaintext" id="total-amount" value="{{ number_format($totalAmount, 0, ',', '.') }}" disabled>
                                                </p>
                                            </div> --}}
                                            <div class="mt-3">
                                                {{-- <a id="checkout" data-url="{{ route('checkout') }}" class="btn text-white w-100" style="background-color: #ff6600;">Thanh toán</a> --}}
                                                {{-- <input type="hidden" name="redirect" value="true"> --}}
                                                <button type="submit" name="redirect" class="btn text-white w-100" style="background-color: #ff6600;">Thanh toán</button>

                                            </div>
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

    {{-- <script>
        $(document).ready(function () {
            // Lắng nghe sự kiện khi người dùng chọn Tỉnh/Thành phố
            $('#province').change(function() {
                let provinceId = $(this).val();
                console.log('Province ID:', provinceId); // Kiểm tra giá trị provinceId
                
                if (provinceId) {
                    $.get(`/districts/${provinceId}`, function(data) {
                        $('#district').html('<option value="">-- Chọn --</option>');
                        data.forEach(d => {
                            $('#district').append(`<option value="${d.id}">${d.name}</option>`);
                        });
                        $('#district').prop('disabled', false);
                        // Reset and disable ward after changing province
                        $('#ward').html('<option value="">-- Chọn --</option>').prop('disabled', true);
                    });
                } else {
                    // Disable district and ward if no province is selected
                    $('#district').prop('disabled', true).html('<option value="">-- Chọn --</option>');
                    $('#ward').prop('disabled', true).html('<option value="">-- Chọn --</option>');
                }
            });
            
    
            // Lắng nghe sự kiện khi người dùng chọn Quận/Huyện
            $('#district').change(function() {
                let districtId = $(this).val();
                if (districtId) {
                    $.get(`/wards/${districtId}`, function(data) {
                        $('#ward').html('<option value="">-- Chọn --</option>');
                        data.forEach(w => {
                            $('#ward').append(`<option value="${w.id}">${w.name}</option>`);
                        });
                        $('#ward').prop('disabled', false);
                    });
                } else {
                    // Disable ward if no district is selected
                    $('#ward').prop('disabled', true).html('<option value="">-- Chọn --</option>');
                }
            });
    
            // Xử lý sự kiện thanh toán
            $('#checkout').on('click', function () {
                let paymentMethod = $('input[name="payment_method"]:checked').val();
                let totalAmount = $('.total-amount').text().replace(/[^0-9]/g, ''); // Xử lý số tiền
                let products = [];
    
                // Lấy thông tin sản phẩm trong giỏ hàng
                $('.cart_item_id').each(function(index) {
                    let product = {
                        id: $(this).text().trim(),
                        quantity: $('.quantity-input').eq(index).val().trim(),
                        price: $('.price').eq(index).text().trim().replace(/[^0-9]/g, ''), // Loại bỏ ký tự không phải số
                        subtotal: $('.subtotal').eq(index).text().trim().replace(/[^0-9]/g, '') // Loại bỏ ký tự không phải số
                    };
    
                    products.push(product);
                });
    
                // Reset thông báo lỗi
                $('#error_payment').text('');
                $('#error_cart_items').text('');
                $('#error_province').text('');
                $('#error_district').text('');
                $('#error_ward').text('');
    
                let isValid = true;
    
                // Kiểm tra thanh toán
                if (!paymentMethod) {
                    $('#error_payment').text('Vui lòng chọn 1 phương thức thanh toán!');
                    isValid = false;
                }
    
                // Kiểm tra giỏ hàng
                if (products.length === 0) {
                    $('#error_cart_items').text('Vui lòng chọn ít nhất một sản phẩm!');
                    isValid = false;
                }
    
                // Lấy giá trị Tỉnh/Thành phố, Quận/Huyện, Xã/Phường
                let province = $('#province').val();
                let district = $('#district').val();
                let ward = $('#ward').val();
    
                // Kiểm tra xem đã chọn Tỉnh, Quận, Xã chưa
                if (!province) {
                    $('#error_province').text('Vui lòng chọn Tỉnh/Thành phố!');
                    isValid = false;
                }
                if (!district) {
                    $('#error_district').text('Vui lòng chọn Quận/Huyện!');
                    isValid = false;
                }
                if (!ward) {
                    $('#error_ward').text('Vui lòng chọn Xã/Phường!');
                    isValid = false;
                }
    
                // Nếu tất cả đều hợp lệ, hiển thị thông báo thanh toán thành công
                if (isValid) {
                    alert('Thanh toán thành công, vui lòng kiểm tra đơn hàng của bạn trong phần "Đơn hàng của tôi"');
                    window.location.href = '/'; // Chuyển hướng về trang chủ hoặc một trang khác sau khi thanh toán
                }
            });
        });
    </script> --}}
    <script>
        $(document).ready(function () {
            // Đặt phí vận chuyển mặc định là 0đ
            $('.shipping-fee').text('0đ');
            $('.shipping-fee-container').hide(); // Ẩn phí vận chuyển khi chưa chọn gì
    
            // Lắng nghe sự kiện khi người dùng chọn Tỉnh/Thành phố
            $('#province').change(function() {
                let provinceId = $(this).val();
                console.log('Province ID:', provinceId); // Kiểm tra giá trị provinceId
    
                // Tải danh sách quận/huyện cho tỉnh đã chọn
                $.get(`/districts/${provinceId}`, function(data) {
                    $('#district').html('<option value="">-- Chọn --</option>');
                    data.forEach(d => {
                        $('#district').append(`<option value="${d.id}">${d.name}</option>`);
                    });
                    $('#district').prop('disabled', false);
                    // Reset và hiển thị xã/phường
                    $('#ward').html('<option value="">-- Chọn --</option>').prop('disabled', false);
                });
    
                // Lấy phí vận chuyển khi chọn tỉnh
                $.get(`/shipping-fee/${provinceId}`, function(data) {
                    if (data) {
                        let shippingFee = data.fee;
                        $('.shipping-fee').text(shippingFee.toLocaleString() + 'đ');
                        $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                        $('#ship').val(shippingFee);  // Gán giá trị phí vận chuyển vào input
                    } else {
                        // Nếu không có phí vận chuyển, vẫn hiển thị 0đ
                        $('.shipping-fee').text('0đ');
                        $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                    }
                });
            });
            
    
            // Lắng nghe sự kiện khi người dùng chọn Quận/Huyện
            $('#district').change(function() {
                let districtId = $(this).val();
                let provinceId = $('#province').val();
    
                // Lấy phí vận chuyển khi chọn Quận/Huyện
                if (provinceId === '3' && districtId) {
                    // Nếu chọn Hà Nội và có district, lấy phí vận chuyển từ province_id và district_id
                    $.get(`/shipping-fee/${provinceId}/${districtId}`, function(data) {
                        if (data) {
                            let shippingFee = data.fee;
                            $('.shipping-fee').text(shippingFee.toLocaleString() + 'đ');
                            $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                        } else {
                            // Nếu không có phí vận chuyển, vẫn hiển thị 0đ
                            $('.shipping-fee').text('0đ');
                            $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                        }
                    });
                } else if (provinceId !== '3' && districtId) {
                    // Nếu tỉnh khác Hà Nội, chỉ cần kiểm tra phí vận chuyển qua province_id
                    $.get(`/shipping-fee/${provinceId}`, function(data) {
                        if (data) {
                            let shippingFee = data.fee;
                            $('.shipping-fee').text(shippingFee.toLocaleString() + 'đ');
                            $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                        } else {
                            // Nếu không có phí vận chuyển, vẫn hiển thị 0đ
                            $('.shipping-fee').text('0đ');
                            $('.shipping-fee-container').show(); // Hiển thị phí vận chuyển
                        }
                    });
                }
    
                // Tải danh sách xã/phường cho Quận/Huyện đã chọn
                if (districtId) {
                    $.get(`/wards/${districtId}`, function(data) {
                        $('#ward').html('<option value="">-- Chọn --</option>');
                        data.forEach(w => {
                            $('#ward').append(`<option value="${w.id}">${w.name}</option>`);
                        });
                        $('#ward').prop('disabled', false);
                    });
                } else {
                    $('#ward').html('<option value="">-- Chọn --</option>').prop('disabled', true);
                }
            });
    
            // Xử lý sự kiện thanh toán
            $('#checkout').on('click', function () {
                let paymentMethod = $('input[name="payment_method"]:checked').val();
                let totalAmount = $('.total-amount').text().replace(/[^0-9]/g, ''); // Xử lý số tiền
                let products = [];
    
                // Lấy thông tin sản phẩm trong giỏ hàng
                $('.cart_item_id').each(function(index) {
                    let product = {
                        id: $(this).text().trim(),
                        quantity: $('.quantity-input').eq(index).val().trim(),
                        price: $('.price').eq(index).text().trim().replace(/[^0-9]/g, ''), // Loại bỏ ký tự không phải số
                        subtotal: $('.subtotal').eq(index).text().trim().replace(/[^0-9]/g, '') // Loại bỏ ký tự không phải số
                    };
    
                    products.push(product);
                });
    
                // Reset thông báo lỗi
                $('#error_payment').text('');
                $('#error_cart_items').text('');
                $('#error_province').text('');
                $('#error_district').text('');
                $('#error_ward').text('');
    
                let isValid = true;
    
                // Kiểm tra thanh toán
                if (!paymentMethod) {
                    $('#error_payment').text('Vui lòng chọn 1 phương thức thanh toán!');
                    isValid = false;
                }
    
                // Kiểm tra giỏ hàng
                if (products.length === 0) {
                    $('#error_cart_items').text('Vui lòng chọn ít nhất một sản phẩm!');
                    isValid = false;
                }
    
                // Lấy giá trị Tỉnh/Thành phố, Quận/Huyện, Xã/Phường
                let province = $('#province').val();
                let district = $('#district').val();
                let ward = $('#ward').val();
    
                // Kiểm tra xem đã chọn Tỉnh, Quận, Xã chưa
                if (!province) {
                    $('#error_province').text('Vui lòng chọn Tỉnh/Thành phố!');
                    isValid = false;
                }
                if (!district) {
                    $('#error_district').text('Vui lòng chọn Quận/Huyện!');
                    isValid = false;
                }
                if (!ward) {
                    $('#error_ward').text('Vui lòng chọn Xã/Phường!');
                    isValid = false;
                }
    
                // Nếu tất cả đều hợp lệ, hiển thị thông báo thanh toán thành công
                if (isValid) {
                    alert('Thanh toán thành công, vui lòng kiểm tra đơn hàng của bạn trong phần "Đơn hàng của tôi"');
                }
            });
        });
        
    </script>
    
    
    
    
    
@endsection
{{-- @section('script')
<script src="/assets/js/checkout.js"></script>
@endsection --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

