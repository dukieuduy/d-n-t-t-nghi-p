<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    @vite(['resources/js/app.js']);
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        body {
            position: relative;
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            /* Đảo chiều để xử lý hover */
            justify-content: flex-start;
            /* Canh lề trái */
            align-items: center;
            /* Canh giữa theo chiều dọc (nếu cần) */
        }

        .rating input[type="radio"] {
            display: none;
            /* Ẩn radio */
        }

        .rating label {
            font-size: 30px;
            color: gray;
            /* Màu mặc định */
            cursor: pointer;
            transition: color 0.3s;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: gold;
            /* Màu vàng khi hover */
        }

        .rating input[type="radio"]:checked~label {
            color: gold;
        }

        .box {
            width: 1000px;
            height: 700px;
            background-color: #ffff;
            border-radius: 4px;
            padding: 20px;
            display: none;
            position: fixed;
            z-index: 2000;
            right: 0;
            top: 60%;
            transform: translate(-50%, -50%);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .show-btn {
            background-color: #ffff;
            color: #F294A5;
            padding: 10px 20px;
            border: 2px solid #F294A5;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: fixed;
            right: 20px;
            bottom: 10px;

        }

        .header-chat {
            justify-content: space-between;
            display: flex;
            width: 100%;
            height: 50px;
            border-bottom: 1px solid lightgrey;
        }

        .infor {
            display: flex;
        }

        .show-btn:hover {
            background-color: #F294A5;
            color: brown
        }

        .message {
            display: flex;
            flex-direction: column;
            max-width: 60%;
            margin-bottom: 15px;
        }

        .message.received {
            align-self: flex-start;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 10px;
            position: relative;
        }

        .body-messages {
            max-height: 700px;
            height: 700px;

        }

        .message.sent {
            margin-left: 500px;
            background-color: #F294A5;
            padding: 10px;
            border-radius: 10px;
            color: white;
            position: relative;
        }

        .message .text {
            margin: 0;
            font-size: 14px;
        }

        .message .time {
            font-size: 12px;
            color: gray;
            margin-top: 5px;
            align-self: flex-end;
        }

        .box-input {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid lightgrey;
        }

        .box-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .box-input button {
            padding: 10px 20px;
            background-color: #F294A5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <header>
        @include('client.inc.header')
        @include('client.inc.style')
    </header>
    <main class="content">
        @yield('content')

    </main> <button class="show-btn" onclick="toggleBox()"><i class='bx bx-message-detail'></i> Chat</button>

    <div class="box" id="box">
        <div class="header-chat">
            <div class="infor">
                <img width="50px"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/480px-User_icon_2.svg.png"
                    alt="">
                <h2 style="margin-top: 5px; margin-left: 20px">Admin</h2>
            </div>
            <button onclick="toggleBox()" class="btn-close"></button>
        </div>
        <div id="messages" class="body-messages" style="padding: 20px; max-height: 500px; overflow-y: auto;">
            @if (isset($messages))
                @foreach ($messages as $mess)
                    <div class="message {{ Auth::id() == $mess->id_user_send ? 'sent' : 'received' }}">
                        <p class="text">{{ $mess->message }}</p>
                        <span class="time">{{ $mess->created_at->format('H:i') }}</span>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="box-input">
            <input type="text" id="messageInput" placeholder="Nhập tin nhắn...">
            <button onclick="sendMessage()">Gửi</button>
        </div>
    </div>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script>
        function scrollToBottom() {
            var messagesDiv = document.getElementById("messages");
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }

        function toggleBox() {
            var box = document.getElementById("box");

            if (box.style.display === "none" || box.style.display === "") {
                box.style.display = "block";
                scrollToBottom();
            } else {
                box.style.display = "none";
            }
        }

        function createHTML(event, align = 'sent') {
            return `
            <div class="message ${align}">
                <p class="text">${event.message}</p>
                <span class="time">10:32 AM</span>
            </div>`
        }

        function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const messageText = messageInput.value.trim();




            $.ajax({
                url: "{{ route('send.messages', 5) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    message: messageText
                },
                success: function(response) {
                    messageInput.value = '';
                    scrollToBottom();

                }

            });

        }
    </script>
    <script type="module">
        Echo.private(`MessagesEvent.{{ Auth::id() }}.5`)
            .listen('MessagesEvent', event => {

                let html;



                html = createHTML(event, 'sent');
                document.querySelector('#messages').insertAdjacentHTML('beforeend', html);
                scrollToBottom();

            });
        Echo.private(`MessagesEvent.5.{{ Auth::id() }}`)
            .listen('MessagesEvent', event => {

                let html;

                html = createHTML(event, 'received');

                document.querySelector('#messages').insertAdjacentHTML('beforeend', html);
                scrollToBottom();
            });
    </script>
    <footer>
        @include('client.inc.footer')
        @include('client.inc.script')
        @yield('script')
    </footer>
</body>

</html>
