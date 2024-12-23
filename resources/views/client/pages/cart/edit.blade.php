<!-- resources/views/client/pages/cart/edit.blade.php -->

@extends('app') <!-- Nếu bạn sử dụng layout chính -->

@section('content')
<div class="container">
    <h1>Chỉnh sửa giỏ hàng</h1>

    <form action="#" method="POST">
        @csrf
        @method('PUT') <!-- Nếu bạn sử dụng PUT để cập nhật giỏ hàng -->

        <div class="row">
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info">
                    <h3>{{ $cartItem->product->name }}</h3>
                    <img src="{{ asset('storage/products/'.$cartItem->product->image) }}" alt="{{ $cartItem->product->name }}" class="img-fluid">
                    <p>Giá: {{ number_format($cartItem->product->price, 0, ',', '.') }} VNĐ</p>
                </div>
            </div>

            <!-- Chọn kích thước và màu sắc -->
            <div class="col-md-6">
                <div class="variation-options">
                    <label for="size">Kích thước:</label>
                    <select name="size" id="size" class="form-control">
                        @foreach($sizesWithColors as $productId => $sizes)
                            @if($productId == $cartItem->product->id)
                                @foreach($sizes as $size => $colors)
                                    <option value="{{ $size }}" {{ $cartItem->size == $size ? 'selected' : '' }}>{{ $size }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>

                    <label for="color">Màu sắc:</label>
                    <select name="color" id="color" class="form-control">
                        @foreach($sizesWithColors as $productId => $sizes)
                            @if($productId == $cartItem->product->id)
                                @foreach($sizes as $size => $colors)
                                    <optgroup label="{{ $size }}">
                                        @foreach($colors as $color)
                                            <option value="{{ $color }}" {{ $cartItem->color == $color ? 'selected' : '' }}>{{ $color }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @endif
                        @endforeach
                    </select>

                    <div class="mt-3">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $cartItem->quantity }}" min="1" max="10">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit button to update the cart item -->
        <button type="submit" class="btn btn-primary mt-3">Cập nhật giỏ hàng</button>
    </form>
</div>
@endsection
