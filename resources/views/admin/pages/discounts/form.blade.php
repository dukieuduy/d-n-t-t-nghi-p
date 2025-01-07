@extends("admin.app")
@section("content")
    <div class="container mt-4">
        <h1 class="mb-4">{{ !isset($isShow) ? isset($discount) ? "Cập nhật mã giảm giá" : "Thêm mã giảm giá" : "Chi tiết mã giảm giá" }}</h1>

        @if(isset($discount))
            {!! Form::model($discount, ['route' => ['admin.discounts.update', $discount->id], 'method' => 'PUT']) !!}
        @else
            {!! Form::open(['route' => 'admin.discounts.store', 'method' => 'POST']) !!}
        @endif

        <div class="mb-3">
            {!! Form::label('code', 'Mã giảm giá', ['class' => 'form-label']) !!}
            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Nhập mã giảm giá', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {!! Form::label('value', 'Giá trị giảm', ['class' => 'form-label']) !!}
            {!! Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Nhập giá trị giảm', 'step' => '0.01', 'min' => '0', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('value')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {!! Form::label('type', 'Loại giảm giá', ['class' => 'form-label']) !!}
            {!! Form::select('type', [
                'percentage' => 'Phần trăm',
                'fixed' => 'Số tiền cố định',
                'shipping' => 'Miễn phí vận chuyển'
            ], null, ['class' => 'form-control', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {!! Form::label('start_date', 'Ngày bắt đầu', ['class' => 'form-label']) !!}
            {!! Form::datetimeLocal('start_date', isset($discount) ? $discount->start_date->format('Y-m-d\TH:i') : null, ['class' => 'form-control', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('start_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {!! Form::label('end_date', 'Ngày kết thúc', ['class' => 'form-label']) !!}
            {!! Form::datetimeLocal('end_date', isset($discount) ? $discount->end_date->format('Y-m-d\TH:i') : null, ['class' => 'form-control', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('end_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {!! Form::label('min_purchase_amount', 'Số tiền mua tối thiểu', ['class' => 'form-label']) !!}
            {!! Form::number('min_purchase_amount', null, ['class' => 'form-control', 'placeholder' => 'Nhập số tiền tối thiểu', 'step' => '0.01', 'min' => '0', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('min_purchase_amount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {!! Form::label('max_purchase_amount', 'Số tiền giảm tối đa', ['class' => 'form-label']) !!}
            {!! Form::number('max_purchase_amount', null, ['class' => 'form-control', 'placeholder' => 'Nhập số tiền giảm tối đa', 'step' => '0.01', 'min' => '0', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('max_purchase_amount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {!! Form::label('quantity', 'Số lượng', ['class' => 'form-label']) !!}
            {!! Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => 'Số lượng', 'step' => '1', 'min' => '0', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            @error('quantity')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check form-switch mb-3">
            {!! Form::hidden('is_active', 0) !!}

            {!! Form::checkbox('is_active', 1, isset($discount) ? $discount->is_active : true, ['class' => 'form-check-input', 'id' => 'flexSwitchCheckChecked', 'disabled' => isset($isShow) ? 'disabled' : null]) !!}
            {!! Form::label('is_active', 'Kích hoạt', ['class' => 'form-check-label']) !!}

            @error('is_active')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            @if(isset($isShow) && $isShow)
                <a href="{{route('admin.discounts.edit', $discount)}}" class="btn btn-warning">Chỉnh sửa</a>
            @else
                {!! Form::submit(isset($discount) ? 'Cập nhật' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
            @endif
            <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary">Trở lại</a>
        </div>

        {!! Form::close() !!}
    </div>
@endsection
