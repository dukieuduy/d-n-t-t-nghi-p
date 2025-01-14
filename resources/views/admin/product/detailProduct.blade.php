@extends("admin.app")

@section("content")
<div class="container mt-4">
    <div class="container mt-4">
        <!-- Tiêu đề chi tiết sản phẩm -->
        <div class="mb-4 border-bottom pb-3">
            <h2 class="text-center text-primary">Chi Tiết Sản Phẩm</h2>
        </div>
        
        <!-- Phần thông tin sản phẩm -->
        <div class="row mb-4 border-bottom pb-3">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $product->name }}</h1>
                <p class="mb-3">{{ $product->description }}</p>
                <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
            </div>
            <div class="col-md-4">
                <h5>Ảnh sản phẩm:</h5>
                @if($product->image_prd)
                    <img src="{{ asset('storage/' . $product->image_prd) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
                @else
                    <p>Chưa có ảnh sản phẩm</p>
                @endif
            </div>
        </div>
    
        <!-- Thông báo lỗi hoặc thành công -->
        <div class="mb-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
    
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    
        <!-- Nút "Thêm Biến Thể" và "Sửa sản phẩm" -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-top pt-3">
            <!-- Nút thêm biến thể -->
            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addVariationModal">
                <i class="bi bi-plus-circle"></i> Thêm Biến Thể
            </button>
            
            <!-- Nút sửa sản phẩm -->
            <a href="{{route('admin.products.edit', $product['id'])}}">
                <button type="button" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Sửa sản phẩm
                </button>
            </a>
        </div>
    
        <!-- Modal: Thêm Biến Thể Sản Phẩm -->
        <div class="modal fade" id="addVariationModal" tabindex="-1" aria-labelledby="addVariationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVariationModalLabel">Thêm Biến Thể</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addVariationForm" method="POST" action="{{ route('admin.products.variations.store', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="color" class="form-label">Màu</label>
                                <select class="form-select" name="color" id="color" required>
                                    <option value="">Chọn màu</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->value }}">{{ $color->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <select class="form-select" name="size" id="size" required>
                                    <option value="">Chọn size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->value }}">{{ $size->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá biến thể</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Thêm Biến Thể</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Mã SKU</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Số lượng</th>
                <th>Thuộc tính</th>
                <th>Trạng thái</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product->variations as $variation)
                <tr>
                    <td>{{$variation->id}}</td>
                    <td>{{ $variation->sku }}</td>
                    <td>{{ number_format($variation->price, 0, ',', '.') }}</td>
                    <td>
                        @if($variation->image)
                            <img src="{{ asset('storage/' . $variation->image) }}" alt="{{ $product['name'] }}" width="50">
                        @else
                            <span>Không có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $variation->stock_quantity }}</td>
                    <td>
                        <ul>
                            @foreach($variation->variationAttributes as $variationAttribute)
                                <li>
                                    <strong>{{ $variationAttribute->attributeValue->attribute->name }}:</strong>
                                    {{ $variationAttribute->attributeValue->value }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="variantStatus" {{ $variation->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="variantStatus">Kích hoạt biến thể sản phẩm</label>
                        </div>
                    </td>
                    <td>   
                        <a href="{{route('admin.product-variants.edit',$variation->id)}}">
                            <button type="button" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Sửa sản phẩm biến thể
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Mở modal khi bấm vào nút
        $('[data-bs-toggle="modal"]').on('click', function() {
            var targetModal = $(this).data('bs-target');
            var modal = new bootstrap.Modal(document.querySelector(targetModal));
            modal.show();
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy tham chiếu đến dropdown màu và size
        const colorDropdown = document.getElementById("color");
        const sizeDropdown = document.getElementById("size");

        // Mảng colorToSizes được truyền từ PHP
        const colorToSizes = @json($colorToSizes);

        // Lắng nghe sự kiện thay đổi trên dropdown màu
        colorDropdown.addEventListener("change", function () {
            const selectedColor = colorDropdown.value;

            // Xóa trạng thái "disabled" của tất cả các option trong dropdown size
            Array.from(sizeDropdown.options).forEach(option => {
                option.disabled = false;
            });

            // Nếu có màu được chọn và tồn tại trong colorToSizes
            if (selectedColor && colorToSizes[selectedColor]) {
                const unavailableSizes = colorToSizes[selectedColor];

                // Lặp qua các option của dropdown size
                Array.from(sizeDropdown.options).forEach(option => {
                    if (unavailableSizes.includes(option.value)) {
                        // Vô hiệu hóa các size đã tồn tại cho màu đã chọn
                        option.disabled = true;
                    }
                });
            }
        });
    });
</script>

@endsection
