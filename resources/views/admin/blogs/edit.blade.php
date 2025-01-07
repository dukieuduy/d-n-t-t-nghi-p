@extends('admin.app')

@section('content')


<!-- Edit Blog form area start -->
<div class="blog_details blog_padding mt-23">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h3>Sửa Blog</h3>
                <!-- Form để sửa blog -->
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Tiêu Đề Blog</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Nội Dung Blog</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required>{{ $blog->content }}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="image">Chọn Hình Ảnh</label>
                        <input type="file" class="form-control" id="image" name="image" onchange="showImage(event)">
                        <img id="image" src="{{Storage::url($blog->image??null)}}" alt="" style="width:150px">
                    </div>

                    <button type="submit" class="btn btn-primary">Cập Nhật Blog</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Blog form area end -->
@endsection
@section('script')
<script>
    function showImage(event) {
        const imgCategory = document.querySelector('#image');
        // console.log(imgCategory);
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            imgCategory.src = reader.result;
            imgCategory.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
    </script>

@endsection
