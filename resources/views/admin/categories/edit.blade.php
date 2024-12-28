@extends('admin.app')

@section('content')
<div class="container mt-5">
    <h2>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h2>
    <form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('categories.store') }}">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name ?? '') }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

         <!-- <div class="mb-3">
            <label for="is_active" class="form-label">Is active</label>
            <select class="custom-select" name="is_active">
                <option value="1" {{ $category->is_active == 1 ? 'selected' : '' }}>Show</option>
                <option value="0" {{ $category->is_active == 0 ? 'selected' : '' }}>Hide</option>
            </select>
            @error('is_active')
                <div class="alert alert-danger mt-2">{{ $message }}</div> 
            @enderror
        </div> -->

       

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
