@extends('admin.app')

@section('content')
  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    <!-- Begin Page Content -->
    <div class="container-fluid">

        {{-- <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
            <div class="col-md-8">
                <input type="text" name="search" placeholder="Tìm kiếm danh mục" value="{{ request('search') }}"
                    class="form-control">
            </div>
            <div class="col-md-4">
                <select name="sort_by" class="custom-select">
                    <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>A-Z</option>
                    <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Z-A</option>
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary mb-3">Tìm kiếm</button>
            </div>
        </form> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Quản lý danh mục
                </h6>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable-category" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên danh mục</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>

                                    <td>{{ $category->is_active == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="openDeleteModal('{{ route('admin.categories.destroy', $category->id) }}')">Xóa</button>

                                            <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button> -->
                                        </form>

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
                                                        Bạn có chắc chắn muốn xóa danh mục này không?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Hủy</button>
                                                        <form id="deleteForm" action="" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xóa</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
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

<script>
    function openDeleteModal(actionUrl) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = actionUrl; // Cập nhật URL cho form
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
    }
</script>
