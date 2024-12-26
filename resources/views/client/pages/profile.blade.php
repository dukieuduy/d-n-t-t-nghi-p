@extends('app')
@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm" style="width: 22rem;">
            <!-- Ảnh đại diện -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body text-center">
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}"
                    alt="Avatar"
                    class="rounded-circle border border-primary mb-4"
                    style="width: 150px; height: 150px;">
                <h5 class="card-title">{{ $user['name'] }}</h5>
                <p class="card-text text-muted">{{ $user['email'] }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <!-- Địa chỉ -->
                <li class="list-group-item">
                    <strong>Địa chỉ:</strong>
                    <p class="mb-0">{{ $user['address'] }}</p>
                </li>
                <!-- Giới tính -->
                <li class="list-group-item">
                    <strong>Giới tính:</strong>
                    <p class="mb-0">{{ $user['gender'] ? 'Nam' : "Nữ" }}</p>
                </li>
                <!-- Ngày sinh -->
                <li class="list-group-item">
                    <strong>Ngày sinh:</strong>
                    <p class="mb-0">{{ $user['birthday'] }}</p>
                </li>
            </ul>
            <div class="card-body text-center">
                <a href="{{route('profile-edit')}}" class="btn btn-primary">Chỉnh sửa</a>
            </div>
        </div>
    </div>

@endsection
