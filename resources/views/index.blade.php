@include('layout.header')
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
                <a href="updateAccount">NÂNG CẤP TÀI KHOẢN</a>
                @auth
                    <a href="logout">
                        <p>ĐĂNG XUẤT</p>
                    </a>
                    <a href="manageAccount">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Microsoft_Account_Logo.svg/1200px-Microsoft_Account_Logo.svg.png" style="width:50px" alt="">
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
<div class="noti">
    <a href=""> BY.EDU.VN - RÚT GỌN LINK MIỄN PHÍ DÀNH RIÊNG CHO TỔ CHỨC GIÁO DỤC</a>
</div>


<div class="container">
    <div class="row" id="link">
        <div class="col-12">
            <h1 class="link-title">Rút gọn link</h1>
            <form action="/store" method="post">
                @csrf
                <label for="">Nhập link cần rút</label>
                <input type="text" class="form-control mt-2" name="Link">
                @error('Link')
                    <div style="color: red">{{ $message }}</div>
                @enderror
                <input class="btn btn-success mt-3" type="submit" value="Rút" name="submit">
            </form>
        </div>
    </div>

    <div>

        <?php 
        if (isset($listLinks )) {
         ?>
        <h3 class="text-center">Lịch sử rút gọn link</h3>
        @foreach ($listLinks as $row)
            <div class="history">
                <div class="row">
                    <div class="col-11">
                        <a href="{{ $row->link }}">{{ $row->link }}</a> <br>

                        @if ($id == $row->id)
                            <form action="/shortenLink/{{$row->id}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="text" id='gray' name="shorten" value="{{ $row->shorten }}">
                                <button type="submit" class="btn btn-danger" style="">Sửa</button>
                            </form>
                        @else
                            <a id='gray'
                                href="{{ $url }}/{{ $row->shorten }}/edit">{{ $url }}/{{ $row->shorten }}</a>
                            @auth
                                @if (Auth::user()->vip == 'vip' || Auth::user()->vip == 'vip_pro')
                                    <a href="/{{ $row->id }}/shorten">Sửa</a>
                                @endif
                            @endauth
                        @endif
                        || <i class="fa-solid fa-clock"></i> @php
                            $time = new DateTime($row->created_at);
                            echo $date->diff($time)->format('%H giờ %I phút %s');
                        @endphp giây trước

                    </div>
                    <div class="col-1">
                        <span style="">{{ $row->click }}</span>
                        <br>
                        <a href="{{ $url }}/{{ $row->shorten }}/edit"
                            class="badge text-bg-primary">Click</a>
                    </div>
                </div>
            </div>
        @endforeach
        <?php
        }
        ?>


    </div>


</div>
@include('layout.footer')
