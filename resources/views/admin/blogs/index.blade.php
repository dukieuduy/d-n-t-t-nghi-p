@extends('admin.app')

@section('content')


<!-- Blog list area start -->
<div class="blog_list blog_padding mt-23">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Danh Sách Blog</h3>

                <!-- Thông báo thành công -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Nút thêm blog -->
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">Thêm Blog Mới</a>

                <!-- Danh sách blog -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiêu Đề</th>
                            <th>nội dung</th>
                            <th>Hình Ảnh</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->content }}</td>

                                <td>
                                    @if($blog->image)
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" width="80">
                                    @else
                                        Không có
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Blog list area end -->
@endsection
