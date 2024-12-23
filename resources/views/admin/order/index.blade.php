@extends("admin.app")
@section("content")
    <div class="container">
        <h1>Quản lý đơn hàng</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- Thanh chọn lọc trạng thái -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-4">
            <div class="form-group">
                <label for="status" class="form-label">Filter by Status</label>
                <select name="status" id="status" class="form-control form-control-sm" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tất cả</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Mới</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang chờ xử lý</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                </select>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ Tên Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng tiền</th>
                    <th>Phí Vận Chuyển</th>
                    <th>Trạng thái</th>
                    <th>Ngày Đặt</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->user->name }}</td> <!-- Customer Name -->
                        <td>{{ $order->user->phone }}</td> <!-- Customer Phone -->
                        <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($order->ship, 0, ',', '.') }}đ</td>

                        <td>
                            @switch($order->status)
                                @case('pending')
                                    {{ 'Đang chờ xử lý' }}
                                    @break
                                @case('completed')
                                    {{ 'Đã hoàn thành' }}
                                    @break
                                @case('cancelled')
                                    {{ 'Đã hủy' }}
                                    @break
                                @case('paid')
                                    {{ 'Đã thanh toán' }}
                                    @break
                                @case('confirmed')
                                    {{ 'Đã xác nhận' }}
                                    @break
                                @default
                                    {{ 'Chưa xác định' }}
                            @endswitch
                        </td>
                        
                        <td>{{ $order->created_at->format('d/m/Y') }}</td> <!-- Order Date -->
                        <td>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()"
                                        {{ $order->status == 'cancelled' || $order->status == 'completed' ? 'disabled' : '' }}>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" 
                                            {{ $order->status == 'completed' ? 'selected' : '' }} 
                                            {{ $order->status == 'completed' ? 'disabled' : '' }}>
                                        Completed
                                    </option>
                                    <option value="cancelled" 
                                            {{ $order->status == 'cancelled' ? 'selected' : '' }} 
                                            {{ $order->status != 'pending' ? 'disabled' : '' }}>
                                        Cancelled
                                    </option>
                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                </select>
                            </form>
                            
                            
                            
                            
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
