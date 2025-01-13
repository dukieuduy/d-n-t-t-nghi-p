@extends("admin.app")
@section("content")
    @php
        $roleName = $role == 'admin' ? 'quản trị viên' : 'khách hàng';
    @endphp
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h1 class="mb-4">Danh sách {{ $roleName }}</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Ảnh</th>
                    <th>Tên {{$roleName}}</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    @if($role == 'member')
                        <th>Số lượng đơn hàng</th>
                    @endif
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><img src="{{ Storage::url($user->avatar) }}" alt="{{$user->name}}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                        <td>{{ $user->birthday}}</td>
                        @if($role == 'member')
                            <th><a href="{{route('admin.user.orderByUser', $user->id)}}" class="btn btn-info">{{ count($user->orders) }}</a></th>
                        @endif
{{--                        <td class="d-flex gap-2 text-nowrap">--}}
{{--                            {{ Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) }}--}}
{{--                            <button type="submit" class="btn btn-outline-danger" title="Xóa"--}}
{{--                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">--}}
{{--                                <i class="bi bi-trash-fill"></i>--}}
{{--                            </button>--}}
{{--                            {{ Form::close() }}--}}

{{--                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
