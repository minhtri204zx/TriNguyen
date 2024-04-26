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
                <a href="/pricing">NÂNG CẤP TÀI KHOẢN</a>
                @auth
                    <a href="logout">
                        <p>ĐĂNG XUẤT</p>
                    </a>
                    <a href="dashboard">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Microsoft_Account_Logo.svg/1200px-Microsoft_Account_Logo.svg.png"
                            style="width:50px" alt="">
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
            <form action="/links" method="post">
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
        if (isset($links)) {
         ?>
        <h3 class="text-center">Lịch sử rút gọn link</h3>
        @foreach ($links as $link)
            <div class="history">
                <div class="row">
                    <div class="col-11">
                        <a href="{{ $link->link }}">{{ $link->link }}</a> <br>
                        <div id="form{{ $link->id }}">
                            <a id='gray{{ $link->id }}' style="color: gray; font-weight: normal"
                                href="{{$link ->url}}">{{$link ->url}}</a>
                            @auth
                                @if (Auth::user()->vip == 'vip' || Auth::user()->vip == 'vip_pro')
                                    <button class="btn btn-info" onclick="convernInput({{ $link->id }})">Sửa</button>
                                @endauth
                            @endif
                            || <i class="fa-solid fa-clock"></i> {{$link->created_at->diff(now())->format('%H giờ %I phút %s giây')}}  trước
                        </div>


                    </div>




                    <div class="col-1">
                        <span style="">{{ $link->click }}</span>
                        <br>
                        <a href="{{$link ->url}}" class="badge text-bg-primary">Click</a>
                    </div>
                </div>
            </div>
        @endforeach
        <?php
        }
        ?>
        <script>
            function convernInput(id) {
                let link = document.getElementById('gray' + id);
                let form = document.getElementById('form' + id);
                let arr = link.innerText.split('/');
                link.parentNode.removeChild(link);
                form.innerHTML = `
                @isset($link)
                @auth
                <form name="myForm" action="/links/${id}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="shorten" style="color: gray; font-weight: normal" value="${arr[3]}" required>
                                <button type="submit" class="btn btn-info" >Sửa</button>
                                || <i class="fa-solid fa-clock"></i> {{$link->created_at->diff(now())->format('%H giờ %I phút %s giây')}} trước
                    </form>  
                @endauth
                @endisset

                `


               
             
            }
        </script>

    </div>


</div>
@include('layout.footer')
