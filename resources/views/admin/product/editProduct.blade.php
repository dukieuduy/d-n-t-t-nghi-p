@extends("admin.app")

@section("content")
    <h2 class="mb-4 text-center text-primary">Chỉnh sửa sản phẩm</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{route('admin.products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tên sản phẩm -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Giá sản phẩm cũ -->
                <div class="form-group mb-3">
                    <label for="price_old" class="form-label">Giá cũ</label>
                    <input type="number" class="form-control" id="price_old" name="price_old" value="{{ old('price_old', $product->price_old) }}" required>
                </div>

                <!-- Giá sản phẩm mới -->
                <div class="form-group mb-3">
                    <label for="price_new" class="form-label">Giá mới</label>
                    <input type="number" class="form-control" id="price_new" name="price_new" value="{{ old('price_new', $product->price_new) }}" required>
                </div>

                <!-- Hình ảnh sản phẩm -->
                <div class="form-group mb-3">
                    <label for="image_prd" class="form-label">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control-file" id="image_prd" name="image_prd">
                    @if($product->image_prd)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $product->image_prd) }}" alt="Image" width="150" class="rounded">
                        </div>
                    @endif
                </div>

                <!-- Chọn danh mục sản phẩm -->
                <div class="form-group mb-3">
                    <label for="category_id" class="form-label">Danh mục sản phẩm</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nút lưu -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
