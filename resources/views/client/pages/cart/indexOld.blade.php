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
            <form action="{{ route('confirm_checkout') }}" method="post" >
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
                                <span style="margin-left: 10px;">Giỏ hàng của: <b>{{ Auth::user()->name }}</b> </span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th scope="col">
                                                <input type="checkbox" class="form-check-input" id="select-all">
                                            </th>
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
                                        @foreach($cartItems as $key)
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
                                                            <select id="size" class="form-select form-select-sm">
                                                                <option value="">{{$key->size}}</option>
                                                                <!-- Thêm các lựa chọn khác nếu cần -->
                                                            </select>
                                                        </div>
                                                        <!-- Dropdown cho màu sắc -->
                                                        <div>
                                                            <label for="color" class="form-label mb-1">Màu sắc</label>
                                                            <select id="color" class="form-select form-select-sm">
                                                                <option value="">{{$key->color}}</option>
                                                                <!-- Thêm các lựa chọn khác nếu cần -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($key->price, 0, ',', '.') }}đ</td>
                                                <td>
                                                    <input type="number" class="form-control w-50 quantity-input"
                                                           value="{{ $key->quantity }}" min="1" max="100"
                                                           data-price="{{ $key->price }}" onchange="updateCart(this)">
                                                </td>
                                                <td class="product_total">
                                                <span>{{ number_format($key->quantity * $key->price, 0, ',', '.')
                                                    }}</span>đ
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-outline-danger btn-sm"><i
                                                            class="fa fa-trash"></i></a>
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
                                            <p class="mb-0 fw-bold cart_amount total">{{ number_format($totalAmount, 0, ',',
                                            '.') }}đ</p>
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
                    <!-- Coupon Code Area End -->
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="/assets/js/cart.js"></script>
@endsection
