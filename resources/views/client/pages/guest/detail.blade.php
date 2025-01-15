@extends('app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Chi tiết đơn hàng</h1>


        <div class="row mb-3">
            <!-- City -->
            <div class="col-md-4">
                <label for="city" class="form-label">Tỉnh/Thành phố</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $province->name }}" disabled>
            </div>

            <!-- State -->
            <div class="col-md-4">
                <label for="state" class="form-label">Quận/Huyện</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ $district->name }}"disabled>
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
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>ảnh sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
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
            
            <a href="{{ route('guest.order.verify') }}" class="btn btn-info btn-sm">Trở về</a>
        </div>
</div>
@endsection