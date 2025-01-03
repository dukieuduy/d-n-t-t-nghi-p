@extends('app')

@section('content')
<div class="container">
    <h1>Lịch sử mua hàng</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Trạng thái giao hàng</th> <!-- Cột mới cho shipping_status -->
                <th>Ngày tạo</th>
                <th>Hạn thanh toán</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ number_format($order->total_amount) }} VND</td>
                <td>
                    @if ($order->status === 'cancelled')
                    <span class="text-danger">Đã hủy</span>
                    @elseif ($order->status === 'paid')
                    <span class="text-success">Đã thanh toán</span>
                    @elseif ($order->status === 'confirmed')
                    <span class="text-primary">Đang giao</span>
                    @elseif ($order->status === 'completed')
                    <a href=""><button class="text-warning">Mua lại đơn</button></a>
                    @else
                    <span class="text-warning">Đang chờ</span>
                    @endif
                </td>
                <td>
                    @if ($order->shipping_status === 'pending')
                    <span class="text-warning">Đang chờ</span> <!-- Đang chờ -->
                    @elseif ($order->shipping_status === 'shipped')
                    <span class="text-primary">Đang giao</span> <!-- Đang giao -->
                    @elseif ($order->shipping_status === 'delivered')
                    <span class="text-success">Đã giao</span> <!-- Đã giao thành công -->
                    @elseif ($order->shipping_status === 'cancelled')
                    <span class="text-danger">Đã hủy</span> <!-- Đã hủy đơn hàng -->
                    @else
                    <span class="text-muted">Chưa xác định</span> <!-- Trường hợp chưa xác định -->
                    @endif
                </td>

                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $order->payment_expires_at->format('d/m/Y H:i') }}</td>
                <td>

                    @if ($order->status === 'pending') <!-- Chỉ hiển thị nút khi trạng thái là đang chờ thanh toán -->
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn hủy đơn hàng này?')">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Hủy đơn</button>
                    </form>
                    @endif

                    @if ($order->status === 'completed' && !$order->is_reviewed) <!-- Chỉ hiển thị nút đánh giá khi trạng thái là đã xác nhận  -->

                    <button type="submit" class="btn btn-warning"><a href="{{ route('client.reviews.create', $order->id) }}">
                            Đánh giá
                        </a>
                    </button>

                    @endif

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

@endsection