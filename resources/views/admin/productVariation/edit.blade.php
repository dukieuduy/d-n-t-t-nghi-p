@extends("admin.app")

@section("content")
<div class="container">
    <h2>Sửa biến thể sản phẩm</h2>

    <!-- Hiển thị thông báo thành công -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Hiển thị thông báo thất bại -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Hiển thị lỗi khi xác thực không thành công -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form chỉnh sửa biến thể sản phẩm -->
    <form action="{{ route('admin.product-variants.update', $ProductVariation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" id="" value="{{$ProductVariation->product_id}}">
        <input type="hidden" name="id" id="" value="{{$ProductVariation->id}}">


        <div class="form-group">
            <label for="name">Mã biến thể</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $ProductVariation->sku) }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $ProductVariation->price) }}" required>
        </div>
        
        <div class="form-group">
            <label for="stock_quantity">Số lượng trong kho</label>
            <input type="number" id="stock_quantity" class="form-control" value="{{ $ProductVariation->stock_quantity }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="add_quantity">Thêm số lượng</label>
            <input type="number" name="add_quantity" id="add_quantity" class="form-control" value="{{ old('add_quantity') }}" placeholder="Nhập số lượng cần thêm">
        </div>
        
        <div class="form-group">
            <label for="image">Ảnh sản phẩm</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        @if($ProductVariation->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $ProductVariation->image) }}" alt="Image" width="150">
        </div>
        @endif
        
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ old('status', $ProductVariation->status) == '1' ? 'selected' : '' }}>Kích hoạt</option>
                <option value="0" {{ old('status', $ProductVariation->status) == '0' ? 'selected' : '' }}>Vô hiệu hóa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Cập nhật biến thể</button>
    </form>
</div>
@endsection
