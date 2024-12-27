@extends('app')

@section('content')

<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    .about_section h1,
    .feedback_form h2 {
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        color: #333;
    }

    .single_step h4 {
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        color: #0056b3; /* Xanh đậm */
    }

    .single_step p {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: #555; /* Màu xám */
    }

    .step_icon {
        color: #007bff; /* Đảm bảo màu icon đồng nhất */
    }
</style>

<div class="about_section mt-32">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="about_thumb mb-4 text-center">
                    <img src="https://khothietbidien.vn/wp-content/uploads/2022/11/huong-dan-mua-hang.jpg"
                         alt="Hướng dẫn mua hàng"
                         class="img-fluid rounded"
                         style="max-width: 50%; height: auto;">
                </div>

                <div class="about_content text-center">
                    <h1 class="mb-3">HƯỚNG DẪN MUA HÀNG</h1>
                    <p class="lead text-muted">Hãy làm theo các bước dưới đây để dễ dàng mua sắm tại cửa hàng của chúng tôi!</p>
                </div>

                <div class="guideline_steps mt-5">
                    <div class="row">
                        <!-- Các bước mua hàng -->
                        @php
                            $steps = [
                                ['icon' => 'search', 'title' => 'Tìm kiếm sản phẩm', 'description' => 'Chọn danh mục hoặc sử dụng thanh tìm kiếm để tìm sản phẩm bạn cần. Đừng quên kiểm tra thông tin chi tiết sản phẩm trước khi mua.'],
                                ['icon' => 'shopping-cart', 'title' => 'Thêm vào giỏ hàng', 'description' => 'Nhấn "Thêm vào giỏ hàng" để lưu sản phẩm yêu thích. Sau đó, bạn có thể xem lại danh sách sản phẩm trong giỏ hàng.'],
                                ['icon' => 'credit-card', 'title' => 'Thanh toán', 'description' => 'Kiểm tra giỏ hàng, nhập địa chỉ giao hàng và chọn phương thức thanh toán phù hợp. Xác nhận đơn hàng và nhận thông tin qua email.'],
                                ['icon' => 'truck', 'title' => 'Giao hàng', 'description' => 'Đơn hàng của bạn sẽ được giao đến địa chỉ đã đăng ký trong thời gian sớm nhất. Bạn có thể theo dõi trạng thái giao hàng qua hệ thống của chúng tôi.'],
                                ['icon' => 'star', 'title' => 'Nhận hàng và đánh giá', 'description' => 'Nhận hàng và kiểm tra sản phẩm. Nếu hài lòng, hãy để lại đánh giá để giúp chúng tôi cải thiện dịch vụ!']
                            ];
                        @endphp

                        @foreach($steps as $step)
                        <div class="col-lg-4 col-md-6">
                            <div class="single_step text-center">
                                <div class="step_icon mb-3">
                                    <i class="fa fa-{{ $step['icon'] }} fa-3x text-primary"></i>
                                </div>
                                <h4>{{ $step['title'] }}</h4>
                                <p>{{ $step['description'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
