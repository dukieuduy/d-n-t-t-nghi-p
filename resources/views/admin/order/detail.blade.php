@extends('admin.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Chi tiết đơn hàng</h1>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <!-- Order Number -->
            {{-- <div class="col-md-6">
                <label for="order_number" class="form-label">Con số</label>
                <input type="text" class="form-control" id="order_number" name="order_number" value="{{ $order->order_number }}" readonly>
            </div> --}}

            <!-- Customer Name -->
            <div class="col-md-6">
                <label for="customer_name" class="form-label">Khách hàng</label>
                <p>{{ $order->user->name ?? 'Không xác định' }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Status -->
            <div class="col-md-6">
                <label class="form-label">Trạng thái</label>
                <div class="btn-group w-100">
                    <input type="radio" class="btn-check" id="status_processing" name="status" value="pending" {{ $order->status == 'pending' ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="status_processing">Đang chờ xử lý</label>
            
                    <input type="radio" class="btn-check" id="status_completed" name="status" value="completed" {{ $order->status == 'completed' ? 'checked' : '' }}>
                    <label class="btn btn-outline-info" for="status_completed">Đã hoàn thành</label>
            
                    <input type="radio" class="btn-check" id="status_cancelled" name="status" value="cancelled" {{ $order->status == 'cancelled' ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="status_cancelled">Đã hủy</label>
                    
                    <input type="radio" class="btn-check" id="status_paid" name="status" value="paid" {{ $order->status == 'paid' ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="status_paid">Đã thanh toán</label>
                </div>
            </div>
            
            
            <!-- Currency -->
            <div class="col-md-6">
                <label for="currency" class="form-label">Tiền tệ</label>
                <select class="form-select" id="currency" name="currency" required>
                    <option value="VND" {{ $order->currency == 'VND' ? 'selected' : '' }}>VND</option>
                    <option value="USD" {{ $order->currency == 'USD' ? 'selected' : '' }}>USD</option>
                    <option value="RUB" {{ $order->currency == 'RUB' ? 'selected' : '' }}>Rúp Nga</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Country -->
            <div class="col-md-6">
                <label for="country" class="form-label">Quốc gia</label>
                {{-- <select class="form-select" id="country" name="country" required>
                    @foreach($countries as $country)
                        <option value="{{ $country }}" {{ $order->country == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select> --}}
            </div>

            <!-- Address -->
            {{-- <div class="col-md-6">
                <label for="address" class="form-label">Địa chỉ đường phố</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $order->address }}">
            </div> --}}
        </div>

        <div class="row mb-3">
            <!-- City -->
            <div class="col-md-4">
                <label for="city" class="form-label">Tỉnh/Thành phố</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $province->name }}">
            </div>

            <!-- State -->
            <div class="col-md-4">
                <label for="state" class="form-label">Quận/Huyện</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ $district->name }}">
            </div>

            <!-- Zip Code -->
            <div class="col-md-4">
                <label for="postal_code" class="form-label">Xã/Phường</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $ward->name }}" readonly>
            </div>
        </div>
        <h4>Chi tiết sản phẩm</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>ảnh sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $index => $item)
                        <tr>
                            <td>{{  $item->productVariation->sku }}</td>
                            <td>{{ $item->productVariation->product->name }}</td>
                            <td><img src="{{ asset('storage/' . $item->productVariation->image)}}" alt="" width="150px"></td>
                            <td>{{ $item->quantity }}</td>
                            
                            <td>{{ number_format($item->productVariation->price, 0, ',', '.') }}đ</td>
                            <td>{{ number_format($item->quantity * $item->productVariation->price, 0, ',', '.') }}đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>
@endsection
