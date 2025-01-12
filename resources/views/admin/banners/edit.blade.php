@extends('admin.app')

@section('content')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <div class="container mt-5">
        <h2>Sửa danh mục</h2>
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $banner->title) }}">
                @error('title')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="edit" class="form-label">Nội dung</label>
                <textarea name="content" id="edit" cols="30" rows="10">{{ $banner->content }}</textarea>
                @error('content')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <img src="{{ asset('storage/banners/' . $banner->image) }}" width="100px" alt="">

            <div class="mb-3">
                <label for="image" class="form-label">Upload ảnh</label>
                <input type="file" class="form-control" name="image">
                @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label">Upload ảnh</label>
                <select name="product_id" id="product_id" class="form-select">
                    <option selected value="">Chọn sản phẩm </option>
                    @foreach ($product as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $banner->product_id ? 'selected' : '' }}>
                            {{ $p->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>



            <button type="submit" class="btn btn-success">Thêm mới</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
        <script>
            CKEDITOR.replace('edit');
        </script>
    </div>
@endsection
