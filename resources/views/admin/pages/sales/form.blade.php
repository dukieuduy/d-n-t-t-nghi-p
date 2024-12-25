@extends("admin.app")
@section("content")
    <div class="container mt-4">
        <h1 class="mb-4">{{ isset($sale) ? "Cập nhật sản phẩm được giảm giá" : "Giảm giá sản phẩm" }}</h1>

        @if(isset($sale))
            {!! Form::model($sale, ['route' => ['admin.sales.update', $sale->id], 'method' => 'PUT']) !!}
        @else
            {!! Form::open(['route' => 'admin.sales.store', 'method' => 'POST']) !!}
        @endif

        <div class="row">
            <div class="col-6">
                <h4>Chọn sản phẩm</h4>
                <div class="accordion" id="productAccordion">
                    @foreach($categories as $category)
                        <div class="accordion-item">
                            <h2 class="accordion-header px-2" id="heading-{{ $category->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $category->id }}" aria-expanded="false"
                                        aria-controls="collapse-{{ $category->id }}">
                                    {!! Form::checkbox('category[]', $category->id, false, [
                                         'class' => 'form-check-input me-2 category-checkbox',
                                         'id' => 'category-' . $category->id,
                                         'disabled' => isset($isShow) ? 'disabled' : null
                                     ]) !!}

                                    <label for="category-{{ $category->id }}" class="m-0">{{ $category->name }}</label>
                                </button>
                            </h2>
                            <div id="collapse-{{ $category->id }}" class="accordion-collapse collapse"
                                 aria-labelledby="heading-{{ $category->id }}" data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    @foreach($category->products as $product)
                                        <div class="form-check mb-2">
                                            {!! Form::checkbox('products[]', $product->id, isset($sale) && in_array($product->id, $sale->products->pluck('id')->toArray()), [
                                                'class' => 'form-check-input product-checkbox',
                                                'id' => 'product-' . $product->id,
                                                'data-category-id' => $category->id,
                                                'disabled' => isset($isShow) ? 'disabled' : null
                                            ]) !!}
                                            {!! Form::label('product-' . $product->id, $product->name, ['class' => 'form-check-label']) !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="col-6">
                <div class="mb-3">
                    {!! Form::label('name', 'Tên chương trình giảm giá', ['class' => 'form-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nhập tên', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    {!! Form::label('percentage', 'Giá trị giảm', ['class' => 'form-label']) !!}
                    {!! Form::number('percentage', null, ['class' => 'form-control', 'placeholder' => 'Nhập phần trăm giảm', 'step' => '0.01', 'min' => '0', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
                    @error('percentage')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    {!! Form::label('issue_date', 'Ngày bắt đầu', ['class' => 'form-label']) !!}
                    {!! Form::datetimeLocal('issue_date', isset($sale) ? $sale->issue_date->format('Y-m-d\TH:i') : null, ['class' => 'form-control', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
                    @error('issue_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    {!! Form::label('expired_date', 'Ngày kết thúc', ['class' => 'form-label']) !!}
                    {!! Form::datetimeLocal('expired_date', isset($sale) ? $sale->expired_date->format('Y-m-d\TH:i') : null, ['class' => 'form-control', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
                    @error('expired_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check form-switch mb-3">
                    {!! Form::hidden('is_active', 0) !!}
                    {!! Form::checkbox('is_active', 1, isset($sale) ? $sale->is_active : true, ['class' => 'form-check-input', 'id' => 'flexSwitchCheckChecked', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
                    {!! Form::label('is_active', 'Kích hoạt', ['class' => 'form-check-label']) !!}
                    @error('is_active')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="d-flex gap-2">
            @if(isset($isShow) && $isShow)
                <a href="{{ route('admin.sales.edit', $sale) }}" class="btn btn-warning">Chỉnh sửa</a>
            @else
                {!! Form::submit(isset($sale) ? 'Cập nhật' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
            @endif
            <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">Trở lại</a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');

            categoryCheckboxes.forEach(categoryCheckbox => {
                categoryCheckbox.addEventListener('change', () => {
                    const categoryId = categoryCheckbox.id.split('-')[1];
                    const relatedProducts = document.querySelectorAll(`.product-checkbox[data-category-id="${categoryId}"]`);

                    relatedProducts.forEach(productCheckbox => {
                        productCheckbox.checked = categoryCheckbox.checked;
                    });
                });
            });

            productCheckboxes.forEach(productCheckbox => {
                productCheckbox.addEventListener('change', () => {
                    const categoryId = productCheckbox.dataset.categoryId;
                    const relatedCategory = document.querySelector(`#category-${categoryId}`);
                    const relatedProducts = document.querySelectorAll(`.product-checkbox[data-category-id="${categoryId}"]`);

                    const allChecked = Array.from(relatedProducts).every(checkbox => checkbox.checked);
                    relatedCategory.checked = allChecked;
                });
            });
        });

    </script>
@endpush
