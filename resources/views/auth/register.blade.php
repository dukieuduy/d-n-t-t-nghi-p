@extends('app')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->


    <!-- customer login start -->
    <div class="customer_login mt-32">
        <div class="container">
            <div class="row">
                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h2>Đăng ký</h2>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <p>
                                <label>Tên đầy đủ <span>*</span></label>
                                <input type="text" name="name" >
                                @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                                
                            </p>
                            <p>
                                <label>Email <span>*</span></label>
                                <input type="text" name="email" >
                                @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            </p>
                            <p>
                                <label>Số điện thoại <span>*</span></label>
                                <input type="text" name="phone">
                                @if ($errors->has('phone'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </p>
                            
                            <p>
                                <label>Mật khẩu <span>*</span></label>
                                <input type="password" name="password" >
                                @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif

                            </p>
                            <p>
                                <label>Xác nhận mật khẩu <span>*</span></label>
                                <input type="password" name="password_confirmation" >
                            </p>
                            <div class="login_submit">
                                
                                <button type="submit">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div>
@endsection