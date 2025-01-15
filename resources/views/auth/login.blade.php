@extends('app')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">Trang chủ</a></li>
                            <li>Đăng nhập</li>
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
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form">
                        <h2>login</h2>
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>	
                                    <strong>{{ $message }}</strong>
                            </div>

                            @endif
                        <form action="{{ route('login')}}" method="POST" >
                            @csrf
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
                                <label>Mật khẩu <span>*</span></label>
                                <input type="password" name="password" >
                                @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            </p>
                            <div class="login_submit">
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('quên mật khẩu?') }}
                                    </a>
                                    @endif

                                <a href="{{route('register')}}" class="text-primary hover:text-danger" style="margin-left: 2%">Register</a>
                                <label for="remember">
                                    <input id="remember" type="checkbox">
                                    Remember me
                                </label>
                                <button type="submit">Đăng nhập</button>

                            </div>

                        </form>
                    </div>
                </div>
                <!--login area start-->

                <!--register area start-->
                {{-- <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h2>Register</h2>
                        <form action="#">
                            <p>
                                <label>Email address <span>*</span></label>
                                <input type="text">
                            </p>
                            <p>
                                <label>Passwords <span>*</span></label>
                                <input type="password">
                            </p>
                            <div class="login_submit">
                                <button type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <!--register area end-->
            </div>
        </div>
    </div>
@endsection