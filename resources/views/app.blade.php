<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            /* Đảo chiều để xử lý hover */
            justify-content: flex-start; /* Canh lề trái */
            align-items: center; /* Canh giữa theo chiều dọc (nếu cần) */
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

        /* Hover hiệu ứng: từ ngôi sao hiện tại đến tất cả các ngôi sao phía trước */
        .rating label:hover,
        .rating label:hover~label {
            color: gold;
            /* Màu vàng khi hover */
        }

        /* Đổi màu các ngôi sao đã chọn */
        .rating input[type="radio"]:checked~label {
            color: gold;
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
    </main>
    <footer>
        @include('client.inc.footer')
        @include('client.inc.script')
        @yield('script')
    </footer>
</body>

</html>