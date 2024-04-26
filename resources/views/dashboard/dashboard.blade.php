@include('layout.header')

<head>
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
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
            <div class="col-7"></div>
            <div class="nav col-3">
                <a href="/pricing">NÂNG CẤP TÀI KHOẢN</a>
                @auth
                    <a href="logout">
                        <p>ĐĂNG XUẤT</p>
                    </a>
                @else
                    <a href="login">ĐĂNG NHẬP</a>
                    <a href="signup">ĐĂNG KÝ</a>
                @endauth
            </div>
        </div>
        </nav>
    </div>
</header>

@include('layout.navbar')

<div class="col-9 mt-4">
    <div style="height: 150px; border: 1px solid rgb(204, 203, 203); border-radius: 20px">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-1">
                        <img src="https://pic.onlinewebfonts.com/thumbnails/icons_378608.svg" alt=""
                            style="width: 50px; margin-left: 20px; margin-top: 11px ">
                    </div>
                    <div class="col-10">
                        <form action="/links" method="post">
                            @csrf
                            <input type="text" name='Link'
                                style="border: none; margin-top: 20px; outline: none; margin-left: 20px; font-size: 20px; width: 100%;"
                                placeholder="Link cần rút gọn">
                    </div>
                </div>

                <hr>
                <span style="font-size: 16px">
                    ㊄ Bằng việc bấm vào nút RÚT GỌN LINK, đồng nghĩa với việc bạn đồng ý với Điều khoản sử dụng
                </span>
            </div>
            <div class="col-4">
                <button class="nut_btn">Rút</button>
                </form>
            </div>
        </div>
    </div>

    <h1 class="text-center mt-5">Lịch sử rút</h1>
    <select id="list" onchange="change()">
        <option @isset($_GET['sort'])
                @else selected
            @endisset
            value="/dashboard">Mới nhất</option>
        <option @isset($_GET['oldest'])
             selected
        @endisset
            value="/dashboard?oldest=true">Cũ nhất</option>
        <option @isset($_GET['popular'])
            selected
       @endisset
            value="/dashboard?popular=true">
            Phổ biến nhất</option>
    </select>
    <table class="table">
        <thead>
            <th>STT</th>
            <th>Link gốc</th>
            <th>Link sau khi rút</th>
            <th>Trạng thái</th>
            <th>Số lần click</th>
            <th>Thời gian đã tạo</th>
            <th>Thao tác</th>
        </thead>
        <tbody>
            @foreach ($links as $link)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a class='linkgoc' href="{{ $link->link }}">{{ $link->link }}</a></td>
                    <td><a class='linkgoc'
                            href="{{$link->url}}">{{$link->url}}</a>
                    </td>
                    <td><span style="margin-left: 20px" class="badge text-bg-{{ $link->status[0] }} ">{{ $link->status[1] }} </span></td>
                    <td><span style="margin-left: 35px" class="badge text-bg-primary">{{ $link->click }}</span></td>
                
                    <td>@php
                        $time = new DateTime($link->created_at);
                        echo $link->created_at->diff(now())->format('%H giờ %I phút %s giây');
                    @endphp</td>
                    <td>
                        <form action="/links/{{ $link->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 7px ">Xoá</button>
                            <a href="links?detail={{$link->id}}" class="btn btn-info">Xem chi tiết</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<script>
    function change() {
        var selectedValue = document.getElementById("list").value;
        if (selectedValue) {
            window.location.href = selectedValue;
        }
    }
</script>
