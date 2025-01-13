@extends('admin.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.users.index', ['role' => 'member'])}}">Trở về trang danh sách khách hàng</a>
        <p class="mt-5">Lịch sử mua hàng của <strong>{{ $user->name}}</strong></p>
        <table class="table">
            <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                {{-- <th>Trạng thái giao hàng</th> <!-- Cột mới cho shipping_status --> --}}
                <th>Thanh toán</th> <!-- Cột mới cho payment_status -->
                <th>Kiểu thanh toán</th> <!-- Cột mới cho payment_method -->
                <th>Ngày đặt</th>
                <th>Chi tết</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ number_format($order->total_amount) }} VND</td>
                    <td>
                        @if ($order->status === 'pending')
                            <span class="text-warning">Đang chờ xác nhận</span>
                        @elseif ($order->status === 'confirmed')
                            <span class="text-primary">Đã xác nhận(đang chờ đơn vị vận chuyển)</span>
                        @elseif ($order->status === 'shipping')
                            <span class="text-info">Đang giao</span>
                        @elseif ($order->status === 'returned')
                            <span class="text-danger">Đã hoàn trả</span>
                        @elseif ($order->status === 'completed')
                            <span class="text-success">Hoàn thành</span>
                        @elseif ($order->status === 'cancelled')
                            <span class="text-danger">Đã hủy</span>
                        @else
                            <span class="text-muted">Chưa xác định</span>
                        @endif
                    </td>
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
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.user.detail_order', $order->id) }}" class="btn btn-info btn-sm">Chi tết</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{-- Phân trang --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
    <!-- Thêm Bootstrap CSS vào phần <head> -->

    <!-- Thêm Bootstrap JS vào phần cuối của <body> trước thẻ đóng </body> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
