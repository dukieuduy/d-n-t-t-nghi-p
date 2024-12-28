@extends('app')
@section('content')

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{{ session('
            success ') }}');
        window.location.href = 'http://datncampuchia.test/'; // Thay '/desired-route' bằng đường dẫn trang đích
    });
</script>
@endif



<div class="container my-5">
    <form action="{{ route('client.reviews.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Mã đơn hàng</label>
            <input class="form-control" type="text" value="{{ $orderId }}" disabled>
        </div>
        <div class="form-group mt-2">
            <label for="">Sản phẩm đã mua</label>
            <input class="form-control" name="product" type="text" value="{{ $product_name }}" disabled>
            <input class="form-control" name="product" type="hidden" value="{{ $productId }}">
        </div>
        <div class="form-group mt-2">
            <label for="">Đánh giá</label>
            <textarea class="form-control" name="comment" id=""></textarea>
        </div>
        <div>
            <table>
                <tr>
                    <td><label for="">Đánh giá (sao)</label></td>
                </tr>
                <tr>
                    <td>
                        <div class="rating">
                            @for ($i = 5; $i >= 1; $i--) <!-- Đảo ngược số sao để dùng hover -->
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                            <label for="star{{ $i }}">&#9733;</label>
                            @endfor
                    </td>
                </tr>

            </table>


        </div>





        @error('rating')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror

        <button class="btn btn-success mt-3">Đánh giá</button>
        <button class="btn btn-primary mt-3 ms-2"><a href="{{ route('user.orders.index')  }}">Quay lại</a></button>
        </form>
</div>

@endsection