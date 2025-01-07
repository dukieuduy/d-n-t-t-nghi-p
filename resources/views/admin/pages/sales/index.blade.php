@extends("admin.app")
@section("content")
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h1 class="mb-4">Quản Lý Giảm Giá</h1>
            <div>
                <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">+ Giảm giá sản phẩm</a>
            </div>
        </div>


        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Tỉ lệ giảm giá</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành Động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ count($sale->products) }} sản phẩm</td>
                        <td>{{ $sale->percentage }}</td>
                        <td>{{ $sale->issue_date }}</td>
                        <td>{{ $sale->expired_date }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input change-status-togle" type="checkbox" id="flexSwitchCheckChecked"
                                       data-sale-id="{{$sale->id}}" {{ $sale->is_active == "1" ? "checked" : "" }}>
                            </div>
                        </td>
                        <td class="d-flex gap-2 text-nowrap">
                            <a href="{{ route('admin.sales.show', $sale->id) }}" title="xem chi tiết"
                               class="btn btn-outline-info"><i class="bi bi-eye-fill"></i></a>
                            <a href="{{ route('admin.sales.edit', $sale->id) }}" title="chỉnh sửa"
                               class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                            {{ Form::open(['route' => ['admin.sales.destroy', $sale->id], 'method' => 'delete']) }}
                            <button type="submit" class="btn btn-outline-danger" title="Xóa"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $sales->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@push("script")
    <script>
        $('.change-status-togle').each(function() {
            $(this).on('change', function() {
                var saleId = $(this).attr('data-sale-id');
                $.ajax({
                    url: "{{ route('admin.sales.changeStatus', ':id') }}".replace(':id', saleId),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
