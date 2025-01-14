@extends($layout)
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Chỉnh sửa thông tin cá nhân</h2>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                {!! Form::open(['url' => route('profile-update', ['role' => 'admin']), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                <!-- Avatar -->
                <div class="mb-3">
                    {!! Form::label('avatar', 'Avatar', ['class' => 'form-label']) !!}
                    {!! Form::file('avatar', ['class' => 'form-control']) !!}
                </div>
                ảnh hiện tại:
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}"
                    alt="Avatar"
                    class="rounded-circle border border-primary mb-4"
                    style="width: 150px; height: 150px;">

                <!-- Username -->
                <div class="mb-3">
                    {!! Form::label('name', 'Username', ['class' => 'form-label']) !!}
                    {!! Form::text('name', old('name', $user->name ?? ''), ['class' => 'form-control', 'placeholder' => 'Enter your username']) !!}
                </div>
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <!-- Email -->
                <div class="mb-3">
                    {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                    {!! Form::email('email', old('email', $user->email ?? ''), ['class' => 'form-control', 'placeholder' => 'Enter your email', 'disabled' => true]) !!}
                </div>
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <!-- Phone
                <div class="mb-3">
                    {!! Form::label('phone', 'Phone', ['class' => 'form-label']) !!}
                    {!! Form::text('phone', old('phone', $user->phone ?? ''), ['class' => 'form-control', 'placeholder' => 'Enter your phone number']) !!}
                </div>
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
                @enderror -->

                <!-- Date of Birth -->
                <div class="mb-3">
                    {!! Form::label('birthday', 'Date of Birth', ['class' => 'form-label']) !!}
                    {!! Form::date('birthday', old('birthday', $user->birthday ?? ''), ['class' => 'form-control']) !!}
                </div>
                @error('birthday')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <!-- Gender -->
                <div class="mb-3">
                    <!-- Male -->
                    {!! Form::radio('gender', 1, old('gender', $user->gender ?? '') === 1, ['id' => 'male']) !!}
                    {!! Form::label('male', 'Nam', ['class' => 'form-check-label me-3']) !!}

                    <!-- Female -->
                    {!! Form::radio('gender', 0, old('gender', $user->gender ?? '') === 0, ['id' => 'female']) !!}
                    {!! Form::label('female', 'Nữ', ['class' => 'form-check-label me-3']) !!}
                </div>
                @error('gender')
                <small class="text-danger">{{ $message }}</small>
                @enderror


                <!-- Address -->
                <div class="mb-3">
                    {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
                    {!! Form::textarea('address', old('address', $user->address ?? ''), ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter your address']) !!}
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
