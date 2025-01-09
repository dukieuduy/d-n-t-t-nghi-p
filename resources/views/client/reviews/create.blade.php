@extends('app')
@section('content')

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var thankYouPopup = new bootstrap.Modal(document.getElementById('thankYouPopup'));
        thankYouPopup.show();

        document.getElementById('redirectHome').addEventListener('click', function() {
            window.location.href = 'http://datncampuchia.test/';
        });
    });
</script>
@endif


<div class="container my-5">
    <form action="{{ route('client.reviews.store') }}" method="POST" class="p-4 border rounded shadow-sm ">
        @csrf
        <h3 class="text-center mb-4">Đánh giá sản phẩm</h3>
        <hr>

        <!-- Mã đơn hàng -->
        <div class="form-group mb-3">
            <label for="orderId" class="form-label">Mã đơn hàng</label>
            <input type="text" class="form-control" id="order_id_display" value="{{ $orderId }}" disabled>
            <input type="hidden" name="order_id" value="{{ $orderId }}">
        </div>

        <!-- Sản phẩm đã mua -->
        <div class="form-group mb-3">
            <label for="product" class="form-label">Sản phẩm đã mua</label>
            <input type="text" class="form-control" id="product" value="{{ $product_name }}" disabled>
            <input type="hidden" name="product" value="{{ $productId }}">

            <img src="{{ \Storage::url($image) }}" alt="">
            <p class="fst-italic"> {{ $skus }}</p>

        </div>
        <div class="form-group mt-2">
            <label for="">Đánh giá (sao)</label>
            <input class="form-control" name="rating" type="number" max="5" min="0">


        <!-- Đánh giá -->
        <div class="form-group mb-3">
            <label for="comment" class="form-label">Đánh giá</label>
            <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Hãy chia sẻ cảm nhận của bạn..."></textarea>
        </div>

        <!-- Đánh giá (sao) -->
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



            @error('rating')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nút gửi đánh giá và quay lại -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success me-2" id="submitReview">Gửi đánh giá</button>
            <a href="{{ route('user.orders.index') }}" class="btn btn-primary">Quay lại</a>
        </div>
    </form>
</div>

<div class="modal fade" id="thankYouPopup" tabindex="-1" aria-labelledby="thankYouLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thankYouLabel">Cảm ơn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi!!!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="redirectHome">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection