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
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang chờ xử lý</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                    <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Đã trả lại</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
            </div>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Đơn </th>
                    <th>Họ Tên Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Kiểu Thanh Toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày Đặt</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>@if(isset($order->user)){{$order->user->name}}@else user @endif</td> <!-- Customer Name -->
                        <td>@if(isset($order->user)){{$order->user->phone}}@else 0869837116 @endif</td> <!-- Customer Phone -->
                        <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                        {{-- <td>{{ number_format($order->ship, 0, ',', '.') }}đ</td> --}}
                        <td>
                            @if ($order->payment_status === 'pending')
                                <span class="text-warning">Đang chờ thanh toán</span>
                            @elseif ($order->payment_status === 'paid')
                                <span class="text-success">Đã thanh toán</span>
                            @elseif ($order->payment_status === 'unpaid')
                                <span class="text-danger">Thanh toán thất bại</span>
                            @else
                                <span class="text-muted">Chưa xác định</span>
                            @endif
                        </td>
                        <td>
                            {{-- @dd($order->payment_method); --}}
                            @if ($order->payment_method === 'CASH')
                                <span>Thanh toán khi nhận hàng</span>
                            @elseif ($order->payment_method === 'VNPAY')
                                <span>VNPay</span>
                            @else
                                <span class="text-muted">Không xác định</span>
                            @endif
                        </td>

                        <td>
                            @switch($order->status)
                                @case('pending')
                                    <span class="text-warning">{{ 'Đang chờ xác nhận' }}</span>
                                    @break
                                @case('confirmed')
                                    <span class="text-primary">{{ 'Đã xác nhận' }}</span>
                                    @break
                                @case('shipping')
                                    <span class="text-info">{{ 'Đang giao' }}</span>
                                    @break
                                @case('delivered')
                                    <span class="text-success">{{ 'Đã giao' }}</span>
                                    @break
                                @case('completed')
                                    <span class="text-success">{{ 'Hoàn thành' }}</span>
                                    @break
                                @case('cancelled')
                                    <span class="text-danger">{{ 'Đã hủy' }}</span>
                                    @break
                                @default
                                    <span class="text-muted">{{ 'Chưa xác định' }}</span>
                            @endswitch


                        </td>
                        
                        <td>{{ $order->created_at->format('d/m/Y') }}</td> <!-- Order Date -->
                        <td>
                            <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-info btn-sm">Chi tết</a>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <!-- Đang chờ (pending) -->
                                    <option value="pending" 
                                            {{ $order->status == 'pending' ? 'selected' : '' }} 
                                            {{ in_array($order->status, ['completed', 'returned', 'shipping', 'cancelled', 'confirmed']) ? 'disabled' : '' }}>
                                        Đang chờ
                                    </option>
                                    
                                    <!-- Đã xác nhận (confirmed) -->
                                    <option value="confirmed" 
                                            {{ $order->status == 'confirmed' ? 'selected' : '' }} 
                                            {{ in_array($order->status, ['completed', 'returned', 'shipping', 'cancelled', 'confirmed']) ? 'disabled' : '' }}>
                                        Xác nhận
                                    </option>
                                
                                    <!-- Đang giao (shipping) -->
                                    <option value="shipping" 
                                            {{ $order->status == 'shipping' ? 'selected' : '' }} 
                                            disabled>
                                        Đang giao
                                    </option>
                                
                                    <!-- Hoàn đơn (returned) -->
                                    <option value="returned" 
                                            {{ $order->status == 'returned' ? 'selected' : '' }} 
                                            disabled>
                                        Đã trả lại
                                    </option>
                                
                                    <!-- Hoàn thành (completed) -->
                                    <option value="completed" 
                                            {{ $order->status == 'completed' ? 'selected' : '' }} 
                                            disabled>
                                        Hoàn thành
                                    </option>
                                
                                    <!-- Đã hủy (cancelled) -->
                                    <option value="cancelled" 
                                            {{ $order->status == 'cancelled' ? 'selected' : '' }} 
                                            {{ in_array($order->status, ['completed', 'returned', 'shipping', 'confirmed']) ? 'disabled' : '' }}>
                                        Hủy
                                    </option>
                                </select>
                                
                                
                                
                                
                            
                            

            
                            
                            </form>
                            
                            
                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
