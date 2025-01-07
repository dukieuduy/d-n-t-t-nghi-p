@extends("admin.app")

@section("content")
<div class="container mt-4">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>

    <h3>Biến thể sản phẩm:</h3>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    <!-- Nút "Thêm Biến Thể" -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVariationModal">Thêm Biến Thể</button>

    <!-- Modal Form Thêm Biến Thể -->
    <div class="modal fade" id="addVariationModal" tabindex="-1" aria-labelledby="addVariationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVariationModalLabel">Thêm Biến Thể</h5>
                </div>
                <div class="modal-body">
                    <form id="addVariationForm" method="POST" action="{{ route('admin.products.variations.store', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
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
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm Biến Thể</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <table border="1" cellpadding="10" class="table">
        <thead>
            <tr>
                <th>Mã SKU</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Số lượng</th>
                <th>Thuộc tính</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product->variations as $variation)
                <tr>
                    <td>{{ $variation->sku }}</td>
                    <td>{{ $variation->price }}</td>
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
