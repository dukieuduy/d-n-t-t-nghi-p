@extends('app')

@section('content')

    <style>
        /* Đặt font chữ cố định cho toàn bộ giao diện */
        body {
            font-family: 'Roboto', sans-serif; /* Bạn có thể đổi sang font khác như Arial hoặc Times New Roman */
        }

        .policy_section h2,
        .policy-card h4 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700; /* Đậm hơn cho tiêu đề */
        }

        .policy-card p,
        .section_title p {
            font-family: 'Roboto', sans-serif;
            font-weight: 400; /* Mỏng hơn cho đoạn văn */
        }
    </style>

    <!-- Chính sách bán quần áo -->
    <div class="policy_section py-5 bg-light">
        <div class="container">
            <!-- Tiêu đề -->
            <div class="section_title text-center mb-5">
                <h2 class="display-5 fw-bold text-uppercase text-dark">Chính Sách Bán Quần Áo</h2>
            </div>
            <!-- Nội dung chính sách -->
            <div class="row g-4">
                <!-- Chính sách đổi trả -->
                <div class="col-lg-6 col-md-6">
                    <div class="card shadow-lg border-0 h-100 policy-card">
                        <div class="card-body text-center">
                            <div class="policy-icon mb-3">
                                <i class="fa fa-refresh fa-3x text-primary"></i>
                            </div>
                            <h4 class="card-title fs-5 fw-bold text-primary mb-3">Chính sách đổi trả</h4>
                            <p class="card-text text-muted">
                                - Thời gian đổi trả: Trong vòng 7 ngày kể từ ngày nhận hàng.<br>
                                - Sản phẩm phải còn nguyên tem mác và chưa qua sử dụng.<br>
                                - Đổi trả miễn phí với lỗi từ nhà sản xuất.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Chính sách bảo hành -->
                <div class="col-lg-6 col-md-6">
                    <div class="card shadow-lg border-0 h-100 policy-card">
                        <div class="card-body text-center">
                            <div class="policy-icon mb-3">
                                <i class="fa fa-shield fa-3x text-success"></i>
                            </div>
                            <h4 class="card-title fs-5 fw-bold text-success mb-3">Chính sách bảo hành</h4>
                            <p class="card-text text-muted">
                                - Bảo hành đường chỉ may trong vòng 30 ngày.<br>
                                - Sản phẩm được bảo hành miễn phí nếu phát hiện lỗi sản xuất.<br>
                                - Không áp dụng bảo hành với sản phẩm giảm giá trên 50%.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Chính sách thanh toán -->
                <div class="col-lg-6 col-md-6">
                    <div class="card shadow-lg border-0 h-100 policy-card">
                        <div class="card-body text-center">
                            <div class="policy-icon mb-3">
                                <i class="fa fa-credit-card fa-3x text-warning"></i>
                            </div>
                            <h4 class="card-title fs-5 fw-bold text-warning mb-3">Chính sách thanh toán</h4>
                            <p class="card-text text-muted">
                                - Hỗ trợ thanh toán qua tiền mặt, thẻ tín dụng, và ví điện tử.<br>
                                - Thanh toán an toàn qua cổng bảo mật SSL.<br>
                                - Hóa đơn điện tử được gửi ngay sau khi thanh toán.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Chính sách giao hàng -->
                <div class="col-lg-6 col-md-6">
                    <div class="card shadow-lg border-0 h-100 policy-card">
                        <div class="card-body text-center">
                            <div class="policy-icon mb-3">
                                <i class="fa fa-truck fa-3x text-danger"></i>
                            </div>
                            <h4 class="card-title fs-5 fw-bold text-danger mb-3">Chính sách giao hàng</h4>
                            <p class="card-text text-muted">
                                - Giao hàng toàn quốc với thời gian từ 2-5 ngày làm việc.<br>
                                - Miễn phí giao hàng cho đơn từ 500.000 VNĐ.<br>
                                - Hỗ trợ kiểm tra hàng trước khi thanh toán.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
