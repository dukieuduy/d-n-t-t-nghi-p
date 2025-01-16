@extends('app')

@section('content')
<div class="container">
    <h1>Danh sách đơn hàng</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>số điện thoại</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->user->phone }}</td>
                    <td>@if($order->status=='shipping') đang giao @endif</td>
                    <td>
                        @if ($order->status === 'confirmed')
                            <form action="{{ route('shipper.confirmDelivery', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Xác nhận giao hàng</button>
                            </form>
                        @elseif ($order->status === 'shipping')
                            <form action="{{ route('shipper.returnOrder', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning">Hoàn đơn</button>
                            </form>
                            <form action="{{ route('shipper.completeOrder', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Hoàn thành</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Không có đơn hàng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
