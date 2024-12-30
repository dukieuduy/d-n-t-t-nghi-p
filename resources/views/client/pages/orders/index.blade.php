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
                {{-- <th>Trạng thái giao hàng</th> <!-- Cột mới cho shipping_status --> --}}
                <th>Thanh toán</th> <!-- Cột mới cho payment_status -->
                <th>Kiểu thanh toán</th> <!-- Cột mới cho payment_method -->
                <th>Ngày đặt</th>
                <th>Hành động</th>
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
                    @if ($order->status === 'pending')
                    <!-- Nút "Hủy đơn" -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelOrderModal{{ $order->id }}">
                        Hủy đơn
                    </button>
                
                    <!-- Modal hủy đơn -->
                    <div class="modal fade" id="cancelOrderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cancelOrderModalLabel{{ $order->id }}">Lý do hủy đơn</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="reason">Lý do hủy:</label>
                                            <textarea id="reason" name="reason" class="form-control" required></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Hủy đơn</button>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    @elseif ($order->status === 'cancelled')
                    <!-- Nút "Đặt hàng lại" -->
                    <form action="{{ route('orders.reorder', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Đặt lại</button>
                    </form>
                    @endif
                </td>
                
                <td>
                    <a href="{{ route('user.orders.detail', $order->id) }}" class="btn btn-info btn-sm">Chi tết</a>
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
