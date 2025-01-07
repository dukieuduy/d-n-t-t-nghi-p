@extends('admin.app')

@section('content')

<!-- Add Blog form area start -->
<div class="blog_details blog_padding mt-23">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h3>Thêm Blog Mới</h3>
                <!-- Form để thêm blog -->
                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu Đề Blog</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Nội Dung Blog</label>
                        <textarea class="form-control" id="content" name="content" rows="5" placeholder="Nhập nội dung blog" required></textarea>
                    </div>



                    <div class="form-group">
                        <label for="image">Chọn Hình Ảnh</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm Blog</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Blog form area end -->
@endsection
