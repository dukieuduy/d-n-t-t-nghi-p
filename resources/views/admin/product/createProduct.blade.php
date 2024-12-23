@extends("admin.app")
@section("content")
<div class="container">
    <h1>Thêm Sản Phẩm</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tên sản phẩm -->
        <div class="form-group">
            <label for="name">Tên Sản Phẩm</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <div class="alert alert-danger">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>

        <!-- Giá Cũ sản phẩm -->
        <div class="form-group">
            <label for="price_old">Giá Cũ</label>
            <input class="form-control" name="price_old" id="price_old" value="{{ old('price_old') }}">
            @if ($errors->has('price_old'))
                <div class="alert alert-danger">
                    {{ $errors->first('price_old') }}
                </div>
            @endif
        </div>

        <!-- Giá Mới sản phẩm -->
        <div class="form-group">
            <label for="price_new">Giá Mới</label>
            <input class="form-control" name="price_new" id="price_new" value="{{ old('price_new') }}">
            @if ($errors->has('price_new'))
                <div class="alert alert-danger">
                    {{ $errors->first('price_new') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="img_prd">Ảnh</label>
            <input type="file" name="img_prd" class="form-control" >
        </div>

        <!-- Danh mục sản phẩm -->
        <div class="form-group">
            <label>Danh Mục Sản Phẩm</label>
            <select name="category" class="form-control">
                @foreach($category as $value)
                    <option value="{{ $value->id }}" {{ old('category') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Biến thể sản phẩm -->
        <h3>Biến Thể Sản Phẩm</h3>

        <div id="variations" class="border" style="padding: 10px">
            <div class="variation">
                <div class="form-group">
                    <label for="variation_price">Giá Biến Thể</label>
                    <input type="number" name="variations[0][price]" class="form-control" value="{{ old('variations.0.price') }}">
                </div>

                <div class="form-group">
                    <label for="stock_quantity">Số Lượng</label>
                    <input type="number" name="variations[0][stock_quantity]" class="form-control" value="{{ old('variations.0.stock_quantity') }}">
                </div>

                <div class="form-group">
                    <label for="image">Ảnh</label>
                    <input type="file" name="variations[0][image]" class="form-control">
                </div>

                <!-- Thuộc tính của biến thể -->
                <!-- Color -->
                 <div class="form-group">
                     <label>Color</label>
                     <select name="variations[0][attributes][color]" class="form-control attribute-select color-select" data-type="color">
                         <option value="">Chọn màu</option>
                         @foreach ($colorValues as $color)
                             <option value="{{ $color->id }}">{{ $color->value }}</option> <!-- Use color ID here -->
                         @endforeach
                     </select>
                 </div>
                <!-- Size -->
                <div class="form-group">
                    <label>Size</label>
                    <select name="variations[0][attributes][size]" class="form-control attribute-select size-select" data-type="size">
                        <option value="">Chọn size</option>
                        @foreach ($sizeValues as $size)
                            <option value="{{ $size->id }}">{{ $size->value }}</option> <!-- Use size ID here -->

                        @endforeach
                    </select>
                </div>



            </div>
        </div>

        <!-- Nút thêm và xóa biến thể -->
        <button type="button" id="addVariation" class="btn btn-primary mt-3">Thêm Biến Thể</button>
        <button type="button" id="removeVariation" class="btn btn-danger mt-3">Xóa Biến Thể Gần Nhất</button>

        <!-- Nút lưu sản phẩm -->
        <button type="submit" class="btn btn-success mt-3">Lưu Sản Phẩm</button>
    </form>
</div>

{{-- <script>
    let selectedCombinations = [];

    // Khóa các tùy chọn đã được chọn trong các dropdown
    function updateDisabledOptions() {
        selectedCombinations = [];

        document.querySelectorAll('.variation').forEach(variation => {
            const size = variation.querySelector('.size-select').value;
            const color = variation.querySelector('.color-select').value;

            if (size && color) {
                selectedCombinations.push(`${size}-${color}`);
            }
        });

        document.querySelectorAll('.variation').forEach(variation => {
            const sizeSelect = variation.querySelector('.size-select');
            const colorSelect = variation.querySelector('.color-select');

            if (sizeSelect && colorSelect) {
                colorSelect.querySelectorAll('option').forEach(option => {
                    const combination = `${sizeSelect.value}-${option.value}`;
                    option.disabled = selectedCombinations.includes(combination);
                });
            }
        });
    }

    // Thêm biến thể mới
    document.getElementById('addVariation').addEventListener('click', () => {
        const newVariation = document.querySelector('.variation').outerHTML.replace(/\[0\]/g, `[${Date.now()}]`);
        document.getElementById('variations').insertAdjacentHTML('beforeend', newVariation);
        updateDisabledOptions();
    });

    // Xóa biến thể gần nhất
    document.getElementById('removeVariation').addEventListener('click', () => {
        const variations = document.querySelectorAll('.variation');
        if (variations.length > 1) {
            variations[variations.length - 1].remove();
            updateDisabledOptions();
        }
    });

    // Lắng nghe sự thay đổi trong các dropdown
    document.addEventListener('change', (e) => {
        if (e.target.classList.contains('attribute-select')) {
            updateDisabledOptions();
        }
    });

    // Khởi tạo
    updateDisabledOptions();
</script> --}}
<script>
    let selectedCombinations = [];

    // Khóa các tùy chọn đã được chọn trong các dropdown
    function updateDisabledOptions() {
        selectedCombinations = [];

        // Lấy tất cả các variation đã chọn
        document.querySelectorAll('.variation').forEach(variation => {
            const size = variation.querySelector('.size-select').value;
            const color = variation.querySelector('.color-select').value;

            if (size && color) {
                selectedCombinations.push(`${size}-${color}`);
            }
        });

        // Cập nhật các tùy chọn bị khóa
        document.querySelectorAll('.variation').forEach(variation => {
            const sizeSelect = variation.querySelector('.size-select');
            const colorSelect = variation.querySelector('.color-select');

            if (sizeSelect && colorSelect) {
                colorSelect.querySelectorAll('option').forEach(option => {
                    const combination = `${sizeSelect.value}-${option.value}`;
                    option.disabled = selectedCombinations.includes(combination);
                });

                sizeSelect.querySelectorAll('option').forEach(option => {
                    const combination = `${option.value}-${colorSelect.value}`;
                    option.disabled = selectedCombinations.includes(combination);
                });
            }
        });
    }

    // Thêm biến thể mới
    document.getElementById('addVariation').addEventListener('click', () => {
        const newVariation = document.querySelector('.variation').outerHTML.replace(/\[0\]/g, `[${Date.now()}]`);
        document.getElementById('variations').insertAdjacentHTML('beforeend', newVariation);
        updateDisabledOptions();
    });

    // Xóa biến thể gần nhất
    document.getElementById('removeVariation').addEventListener('click', () => {
        const variations = document.querySelectorAll('.variation');
        if (variations.length > 1) {
            variations[variations.length - 1].remove();
            updateDisabledOptions();
        }
    });

    // Lắng nghe sự thay đổi trong các dropdown
    document.addEventListener('change', (e) => {
        if (e.target.classList.contains('attribute-select')) {
            updateDisabledOptions();
        }
    });

    // Khởi tạo
    updateDisabledOptions();
</script>
@endsection
