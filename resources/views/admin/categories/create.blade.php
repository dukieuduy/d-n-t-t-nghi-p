@extends('admin.app')

@section('content')
<div class="container mt-5">
    <h2>Thêm danh mục</h2>
    <form action="{{route('admin.categories.store') }}" method="POST">
        @csrf
        @if(isset($category))
            @method('POST')
        @endif

        <div class="mb-3">
            <label for="category_name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $category->name ?? '') }}" >
            @error('name') 
                <div class="alert alert-danger mt-2">{{ $message }}</div> 
            @enderror
        </div>



        <!-- <div class="mb-3"> 
            <label for="is_active" class="form-label">Trạng thái</label> 
            <select class="custom-select" name="is_active"> 
                <option value="1" selected>Show</option> 
                <option value="0">Hide</option> 
            </select> 
             @error('is_active') 
                <div class="alert alert-danger mt-2">{{ $message }}</div> 
            @enderror
        </div> -->

        <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update Category' : 'Create Category' }}</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
