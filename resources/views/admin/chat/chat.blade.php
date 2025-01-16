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

            flex: 4;
            background-color: #fff;

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

        .actives {
            background-color: rgb(233, 233, 233);
            border-radius: 2px;
        }

        .header-mess {
            width: 100%;
            height: 91px;
            border-bottom: 1px solid lightgray;
        }

        .infor {
            display: flex;
            margin-left: 20px;
        }

        .infor img {
            border-radius: 50%;
        }

        .infor h3 {
            margin-left: 10px;
            margin-top: 20px;
        }

        .status {
            width: 10px;
            height: 10px;
            background-color: rgb(89, 145, 7);
            border-radius: 50%;
            margin-left: 30px;
            margin-top: 2px;
        }

        .box-status {
            display: flex;
            font-size: 10px;

        }

        .box-status span {
            margin-left: 10px;
        }

        .message-time {
            font-size: 12px;
            color: gray;
            margin-top: 5px;
            text-align: right;
            position: absolute;
            bottom: 0;
            right: 5px;
        }

        .box-messages-admin {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            height: 600px;
        }

        .message {
            max-width: 60%;
            padding: 10px 20px 20px 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            position: relative;
        }

        .sent {
            background: #F294A5;
            color: white;
            align-self: flex-end;
        }

        .received {
            background: #e4e6eb;
            color: black;
            align-self: flex-start;
        }

        .box-input-admin {
            padding: 10px;
            display: flex;
            align-items: center;
            background: #fff;
            border-top: 1px solid lightgray;
        }

        .input-message {
            flex: 1;
            padding: 10px;
            border: 1px solid lightgray;
            border-radius: 20px;
            outline: none;
            font-size: 16px;
        }

        .send-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            margin-left: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .send-button:hover {
            background: #0056b3;
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
                                    <li class="{{ $other->id == $user_select->id ? 'actives' : '' }}">
                                        <a href="{{ route('chat.sp', $other->id) }}" class="href">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Breezeicons-actions-22-im-user.svg/1200px-Breezeicons-actions-22-im-user.svg.png"
                                                width="45px" alt="">
                                            <h4>{{ $other->name }}</h4>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    <div class="right-sidebar">
                        <div class="header-mess">
                            <div class="infor">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Breezeicons-actions-22-im-user.svg/1200px-Breezeicons-actions-22-im-user.svg.png"
                                    width="60px" alt="">
                                <h3>{{ $user_select->name }}</h3>
                            </div>
                            <div class="box-status">
                                <div class="status"></div> <span>Đang hoạt động</span>
                            </div>
                        </div>
                        <div class="box-messages-admin" id="messages-admin">
                            @if (count($messages) > 0)
                                @foreach ($messages as $message)
                                    <div class="message {{ $message->id_user_send == auth()->id() ? 'sent' : 'received' }}">
                                        <span>{{ $message->message }}</span>
                                        <span class="message-time">{{ $message->created_at->format('H:i') }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="box-input-admin">
                            <input type="text" class="input-message" id="input-message" placeholder="Nhập tin nhắn...">
                            <button class="send-button" id="btn-submit-chat">Gửi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function scrollToBottom() {
            var messagesDiv = document.getElementById("messages-admin");
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        function createHTML(event, align = 'sent') {
            return `
          <div class="message ${align}">
            <span>${event.message}</span>
            <span class="message-time">10:50 AM</span>
           </div>`
        }
        const mess = document.querySelector('#input-message');
        document.querySelector('#btn-submit-chat').addEventListener('click', () => {
            if (mess.value == "") return;

            $.ajax({
                url: "{{ route('send.messages', $user_select->id) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    message: mess.value
                },
                success: function(response) {
                    scrollToBottom();
                    mess.value = '';

                }

            });

        })
    </script>
    <script type="module">
        Echo.private(`MessagesEvent.{{ Auth::id() }}.{{ $user_select->id }}`)
            .listen('MessagesEvent', event => {

                let html;


                html = createHTML(event, 'sent');

                document.querySelector('#messages-admin').insertAdjacentHTML('beforeend', html);
                scrollToBottom();
            });
        Echo.private(`MessagesEvent.{{ $user_select->id }}.{{ Auth::id() }}`)
            .listen('MessagesEvent', event => {

                let html;

                html = createHTML(event, 'received');

                document.querySelector('#messages-admin').insertAdjacentHTML('beforeend', html);
                scrollToBottom();
            });
    </script>
    </div>
@endsection
