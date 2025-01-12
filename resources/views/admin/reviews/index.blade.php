@extends('admin.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <div class="container mt-4">
        <h2>Danh sách đánh giá</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif



        <table class="table table-bordered" id="datatable-category">
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
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->user->name ?? 'Người dùng không tồn tại' }}</td>
                        <td>{{ $review->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->comment }}
                            <hr>
                            <textarea rows="5" id="reply-comment-{{ $review->id }}" class="form-control reply-comment"></textarea>
                            <button class="btn btn-success mt-2 btn-reply-comment" data-comment_id="{{ $review->id }}"
                                data-product_id="{{ $review->product_id }}">Trả lời bình luận</button>
                        </td>
                        <td>
                            <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn ẩn bình luận này không?')">Ẩn bình luận</button> -->

                            <!-- <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">Sửa</a> -->
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="openDeleteModal('{{ route('admin.reviews.destroy', $review->id) }}')">Xóa</button>
                            </form>

                            <!-- Bootstrap Modal -->
                            <div class="modal fade" id="deleteConfirmModal" tabindex="-1"
                                aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteConfirmLabel">Xác nhận xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa đánh giá này không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <form id="deleteForm" action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-category').DataTable({
                lengthChange: true,
            });
        });
    </script>
@endsection

<script type="text/javascript">
    $(document).on('click', '.btn-reply-comment', function() {
        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).data('product_id');
        var comment = $('#reply-comment-' + comment_id).val();

        $.ajax({
            url: "{{ url('/reviews/reply-comment') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                comment: comment,
                id: comment_id,
                comment_product_id: comment_product_id
            },
            success: function(response) {
                $('#reply-comment-' + comment_id).val(''); // Clear input field
                alert('Reply submitted successfully!');
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('An error occurred. Please try again.');
            }
        });
    });


    function openDeleteModal(actionUrl) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = actionUrl; // Cập nhật URL cho form
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
    }
</script>
