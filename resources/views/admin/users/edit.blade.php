@extends('admin.app')

@section('content')
<div class="container mt-5">
    <!-- <h2>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h2> -->
    <h2>Sửa thông tin người dùng</h2>
    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('user.store') }}">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Tên người dùng</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}">
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}">
            @error('email')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Vai trò</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('name', $user->type ?? '') }}">
            @error('type')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
