@extends('admin.app')

@section('content')
    <style>
        .box-chat-admin {
            display: flex;
            width: 100%;
            height: 750px;

        }

        .left-siderbar {
            flex: 1;
            background-color: #fff;
            padding: 10px;
            border-right: 1px solid lightgray;

        }

        .right-sidebar {
            display: flex;
            flex: 4;
            background-color: #fff;
            padding-left: 100px;
            padding-top: 100px;
        }
        .right-sidebar img{
            border-radius: 50%;
        }

        .header {
            display: flex;
            border-bottom: 1px solid lightgrey;

        }

        .header img {
            border-radius: 50%;
        }

        .header h2 {
            margin-left: 10px;
            margin-top: 15px;
        }

        ul {
            list-style: none;
        }

        li {
            margin-top: 10px;
           padding: 10px 0 10px 5px;
        }

        li:hover {
            background-color: rgb(233, 233, 233);
            border-radius: 2px;
        }

        .href {
            display: flex;
            text-decoration: none;
            color: black;
        }

        .href:hover {
            text-decoration: none;
        }

        .href img {
            border-radius: 50%;
            box-shadow: 5px 5px 10px lightgray;

        }

        .href h4 {
            margin-left: 10px;
            margin-top: 12px;
        }
    </style>
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Quản lý
                    tin nhắn
                </h6>
            </div>
            <div class="card-body">
                <div class="box-chat-admin">
                    <div class="left-siderbar">
                        <div class="header">
                            <img src="https://img.freepik.com/free-vector/user-blue-gradient_78370-4692.jpg" width="80px"
                                alt="">
                            <h2>Admin</h2>
                        </div>
                        <div class="list-user">
                            <ul>
                                @foreach ($user as $other)
                                    <li>
                                        <a href="{{route('chat.sp',$other->id)}}" class="href"> <img
                                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Breezeicons-actions-22-im-user.svg/1200px-Breezeicons-actions-22-im-user.svg.png"
                                                width="45px" alt="">
                                            <h4>{{ $other->name }}</h4>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="right-sidebar">
                        <img src="{{asset('admin/img/mess-pink.jpg')}}" width="350px" height="350px" alt="">
                        <h2 style="margin-left: 10px; margin-top: 150px;">Quản lí tin nhắn của trang web bạn </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
