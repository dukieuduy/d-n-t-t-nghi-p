@extends("admin.app")
@section("content")
<div class="container mt-4">
    <h1 class="mb-4 text-center text-primary">Quản Lý Sản Phẩm</h1>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Bảng danh sách sản phẩm --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Mô Tả</th>
                    <th>Giá Cũ</th>
                    <th>Giá Mới</th>
                    <th>Danh Mục</th>
                    <th>Ảnh</th>
                    <th>Tổng Số Lượng</th>
                    <th>Đã Bán</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product['id'] }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['description'] }}</td>
                        <td>{{ number_format($product['price_old'], 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format($product['price_new'], 0, ',', '.') }} VNĐ</td>
                        <td>{{ $product['category']['name'] }}</td>
                        <td>
                            @if($product['image_prd'])
                                <img src="{{ Storage::url($product['image_prd']) }}" alt="{{ $product['name'] }}" width="50" class="img-fluid">
                            @else
                                <span>Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{ $product['total_stock'] }}</td>
                        <td>300</td>
                        {{-- <td>
                            <!-- Toggle Switch -->
                            <label class="switch">
                                <input type="checkbox" class="toggle-status" data-product-id="{{ $product['id'] }}" {{ $product['is_active'] ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </td> --}}
                        <td>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="variantStatus"{{ $product['is_active'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="variantStatus">Kích hoạt biến thể sản phẩm</label>
                            </div>
                        </td>
                        <td>
                            <!-- Các hành động quản lý sản phẩm -->
                            <a href="{{ route('admin.products.detail', $product['id']) }}" class="btn btn-outline-success btn-sm">Chi Tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
     
    {{-- Thêm sản phẩm --}}
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-3">Thêm Sản Phẩm</a>
</div>

{{-- Cập nhật trạng thái sản phẩm --}}
<script>
    // Khi người dùng thay đổi trạng thái của toggle switch
    document.querySelectorAll('.toggle-status').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const productId = this.dataset.productId;
            const isActive = this.checked ? 1 : 0;

            // Hiển thị spinner hoặc thông báo trong khi chờ
            const spinner = document.createElement('span');
            spinner.innerText = 'Đang cập nhật...';
            this.parentElement.appendChild(spinner);

            // Gửi request Ajax để cập nhật trạng thái sản phẩm
            fetch(`/admin/products/${productId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    is_active: isActive
                })
            }).then(response => response.json())
              .then(data => {
                  spinner.remove();
                  if (data.success) {
                      alert('Trạng thái sản phẩm đã được cập nhật!');
                  } else {
                      alert('Có lỗi xảy ra!');
                      this.checked = !isActive; // Khôi phục trạng thái ban đầu
                  }
              })
              .catch(error => {
                  spinner.remove();
                  alert('Có lỗi xảy ra!');
                  this.checked = !isActive; // Khôi phục trạng thái ban đầu
              });
        });
    });
</script>
@endsection
