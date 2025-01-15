@extends('app')

@section('content')
    <div class="container">
        <h3>Nhập số điện thoại để xem đơn hàng</h3>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('guest.order.check') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="phone_number" class="form-label">Số điện thoại:</label>
                <input type="tel" id="phone_number" name="phone_number" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </form>
    </div>
@endsection
