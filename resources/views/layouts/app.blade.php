<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rút gọn link</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    @stack('linkcss')
</head>

<body>

    <head>
    </head>
    <header>
        <div class="container">
            <div class="row pt-3">
                <div class="col-2">
                    <a class="navbar-brand" href="http://127.0.0.1:8000/">
                        <img src="https://api-muakey.cdn.vccloud.vn/storage/media/oAUQhXzfIhT1iAQ2Udx40GHYF0BArAEj52QXd2XV.jpg?hash=bff4bb67"
                            alt="Logo" class="d-inline-block align-text-top" width="50px">
                        <p class="text-light" style="padding-left: 10px ">Muakey.com</p>
                    </a>
                </div>
                <div class="col-6"></div>
                <div class="nav col-4">
                    <a href="/pricing">NÂNG CẤP TÀI KHOẢN</a>
                    @auth
                        <a href="logout">
                            <p>ĐĂNG XUẤT</p>
                        </a>
                        <a href="/dashboard">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Microsoft_Account_Logo.svg/1200px-Microsoft_Account_Logo.svg.png"
                                style="width:50px" alt="">
                        </a>


                        <span class="navbar-dark">
                            <button class="navbar-toggler" type="button" id="myButton">
                                <i class="fa-solid fa-bell"></i>
                                <span id="number">
                                    <div> {{$counts}}</div>
                                 </span>
                            </button>
                        </span>
                        <div id="thongbao">
                          @foreach ($notis as $noti)
                           <div>{{$noti->data['content']}}</div>
                          @endforeach
                        </div>
                    @else
                        <a href="login">ĐĂNG NHẬP</a>

                        <a href="signup">ĐĂNG KÝ</a>
                    @endauth

                </div>
            </div>
            </nav>

        </div>
    </header>
    <main>
        @isset($show)
            @section('sidebar')
                <div class="row">
                    <div class="col-2">
                        <div style="height: 700px; background-color: #030D1E">
                            <ul>
                                <a href="/dashboard" class="navbar">
                                    <li>Trang chủ</li>
                                </a>
                                <a href="/links" class="navbar">
                                    <li>Danh sách các links</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                @show
            @endisset
            </sidebar>
            @yield('content')
    </main>

    <footer>

    </footer>
    <script>
        document.getElementById("myButton").addEventListener("click", function() {
            let thongbao = document.getElementById("thongbao");
            if (thongbao.style.display == "block") {
                thongbao.style.display = "none";
            }else{
                thongbao.style.display = "block";
            }

        });
    </script>
</body>

</html>
