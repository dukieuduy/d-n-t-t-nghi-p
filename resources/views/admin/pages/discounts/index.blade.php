@extends("admin.app")
@section("content")
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h1 class="mb-4">Quản Lý Mã Giảm Giá</h1>
            <div>
                <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary mt-3">Thêm Mã Giảm Giá</a>
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
                    <th>Mã giảm giá</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>Giá đơn hàng tối thiểu</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Hành Động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($discounts as $discount)
                    <tr>
                        <td>{{ $discount->id }}</td>
                        <td>{{ $discount->code }}</td>
                        <td>
                            @if($discount->type =='shipping')
                                Phí vận chuyển
                            @elseif ($discount->type == 'percentage')
                                Phần trăm
                            @else
                                Cố định
                            @endif
                        </td>
                        <td>{{ $discount->value }}</td>
                        <td>{{ $discount->min_purchase_amount }}</td>
                        <td>{{ $discount->quantity }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input change-status-togle" type="checkbox" id="flexSwitchCheckChecked"
                                       data-discount-id="{{$discount->id}}" {{ $discount->is_active == "1" ? "checked" : "" }}>
                            </div>
                        </td>
                        <td class="d-flex gap-2 text-nowrap">
                            <a href="{{ route('admin.discounts.show', $discount->id) }}" title="xem chi tiết"
                               class="btn btn-outline-info"><i class="bi bi-eye-fill"></i></a>
                            <a href="{{ route('admin.discounts.edit', $discount->id) }}" title="chỉnh sửa"
                               class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                            {{ Form::open(['route' => ['admin.discounts.destroy', $discount->id], 'method' => 'delete']) }}
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
            {{ $discounts->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@push("script")
    <script>
        $('.change-status-togle').each(function() {
            $(this).on('change', function() {
                var discountId = $(this).attr('data-discount-id');
                $.ajax({
                    url: "{{ route('admin.discounts.changeStatus', ':id') }}".replace(':id', discountId),
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
