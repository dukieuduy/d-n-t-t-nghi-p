@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h2>Danh sách Review</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Sản phẩm</th>
                <th>Đánh giá (sao)</th>
                <th>Bình luận</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->name ?? 'Người dùng không tồn tại' }}</td>
                    <td>{{ $review->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->comment }}</td>
                    <td>
                    <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn ẩn bình luận này không?')">Ẩn bình luận</button> -->

                        <!-- <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">Sửa</a> -->
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
