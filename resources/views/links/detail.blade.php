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
                <a href="pricing">NÂNG CẤP TÀI KHOẢN</a>
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

    <h1 class="text-center mt-5">Lịch sử rút</h1>
    <div class="row">
        <div class="col-3">
            <h5>Thời gian</h5>
            <select class="form-select" id="list" onchange="change()">
                <option value="">Chưa chọn</option>
                <option value="">Mới nhất</option>
                <option value="oldest=true">Cũ nhất</option>
            </select>
        </div>
        <div class="col-3">
            <h5>Thành phố</h5>
            <select class="form-select" id="list2" onchange="change()">
                <option value="">Chưa chọn</option>
                <option value="{{route ('link.show' ,$id, '123123') }}">Việt Nam</option>
                <option value="/links/{{ $id }}?country=hanquoc">Hàn Quốc
                </option>
            </select>
        </div>
        <div class="col-3">
            <h5>Thiết bị</h5>
            <select class="form-select" id="list3" onchange="change()">
                <option value="">Chưa chọn</option>
                <option value="/links/{{ $id }}?device=Computer">Máy tính</option>
                <option value="/links/{{ $id }}?device=mobile">Điện thoại
                </option>
            </select>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>STT</th>
            <th>Thời gian click</th>
            <th>Thiết bị</th>
            <th>Phương tiện</th>
            <th>Hệ điều hành</th>
            <th>Quốc gia</th>
            <th>Thành phố</th>
            <th>Địa chỉ IP</th>
        </thead>
        <tbody>
            @foreach ($viewers as $viewer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $viewer->created_at }}</td>
                    <td>{{ $viewer->device }}</td>
                    <td>{{ $viewer->media }}</td>
                    <td>{{ $viewer->platform }}</td>
                    <td>{{ $viewer->country }}</td>
                    <td>{{ $viewer->city }}</td>
                    <td>{{ $viewer->ip }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <?php
    $pages = ceil($viewers->total() / 4);
    ?>
    @for ($i = 1; $i <= $pages; $i++)
        <a id="pages" style="<?php
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        if ($_GET['page'] == $i) {
            echo 'background-color: rgba(6, 16, 109, 0.753);color: white;font-weight: 700;';
        } ?>"
            href="/links/{{ $id }}?page={{ $i }}">{{ $i }}</a>
    @endfor

</div>
<script>
    function change() {
        var selectedValue = document.getElementById("list").value;
        var selectedValue2 = document.getElementById("list2").value;
        var selectedValue3 = document.getElementById("list3").value;

        if (selectedValue) {
            window.location.href = selectedValue;
        }
        if (selectedValue2) {
            window.location.href = selectedValue2;
        }
        if (selectedValue3) {
            window.location.href = selectedValue3;
        }
    }
</script>
