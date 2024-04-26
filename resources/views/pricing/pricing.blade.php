@if (!Auth::check())
    <h1>Bạn chưa đăng nhập</h1>
@else
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
                <div class="nav col-4 ">
                    <a href="updateAccount">NÂNG CẤP TÀI KHOẢN</a>
                    @auth
                        <a href="logout">
                            <p>ĐĂNG XUẤT</p>
                        </a>
                        <a href="Account">
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

    <div class="container mt-5">
        <h2 class="text-center">Lựa chọn loại phù hợp với bạn</h2>

        <div class="selected row mt-3">
            <div class="btn-left col-6">
                Hàng năm
            </div>
            <div class="btn-right col-6">
                Vĩnh viễn
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-4 pb-3" style="background-color: #DEE2EA; height: 100%; ">

                <h5 class="text-center mt-3" style="color:#7087B0 ">Loại thường</h5>

                <h4 class="text-center mt-3">Miễn phí vĩnh viễn</h4>
                <ul class="mt-4">
                    <li> URLs rút gọn: Không giới hạn.</li>
                    <li> Lượt Click/tháng: Không giới hạn.</li>
                    <li> Thời gian lưu giữ link: không thời hạn. (*)</li>
                    <li> Số trang Splash: 05.</li>
                    <li> Tùy biến QR Code.</li>
                    <li> Số trang Overlay: 05.</li>
                    <li> Target theo vị trí địa lý.</li>
                    <li> Target theo thiết bị.</li>
                    <li> Bundles & Link Rotator.</li>
                    <li> Bí danh tùy chỉnh.</li>
                    <li> Tạo link cho App Mobile.</li>
                    <li> Nhắm mục tiêu Facebook Pixels.</li>
                    <li> Campaign URL Builder.</li>
                    <li> Thống kê truy cập.</li>
                    <li> Có quảng cáo.</li>
                    <li> Support: Qua Email by@hap.vn</li>


                </ul>






            </div>
            <div class="col-4 pb-3"
                @if (Auth::user()->vip == 'vip') data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-custom-class="custom-tooltip" data-bs-title="Đang dùng." @endif
                style="background-color: #fdfdfd; height: 100%;    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); ">

                <h5 class="text-center mt-3" style="color:#4268aa ">Loại Vip</h5>

                <h4 class="text-center mt-3"><span style="color: rgb(155, 38, 38)">99.000Đ <del>234.000Đ</del></span>
                </h4>
                <ul class="mt-4">
                    <li> URLs rút gọn: Không giới hạn.</li>
                    <li> Lượt Click/tháng: Không giới hạn.</li>
                    <li> Thời gian lưu giữ link: không thời hạn. (*)</li>
                    <li> Số trang Splash: 05.</li>
                    <li> Tùy biến QR Code.</li>
                    <li> Số trang Overlay: 05.</li>
                    <li> Target theo vị trí địa lý.</li>
                    <li> Target theo thiết bị.</li>
                    <li> Bundles & Link Rotator.</li>
                    <li> Bí danh tùy chỉnh.</li>
                    <li> Tạo link cho App Mobile.</li>
                    <li> Nhắm mục tiêu Facebook Pixels.</li>
                    <li> Campaign URL Builder.</li>
                    <li> Thống kê truy cập.</li>
                    <li> Có quảng cáo.</li>
                    <li> QR Code động.</li>
                    <li> Xóa, sửa link rút gọn.</li>
                    <li> Không vô hiệu hóa link dù không có truy cập.</li>
                    <li> Team Member: 05 thành viên.</li>
                    <li> Cập nhật link gốc: Không giới hạn.</li>
                    <li> Tên miền con: https://ten-ban.g2.by: 01 (**)</li>
                    <li> Tên miền tùy chỉnh: 01 (**)</li>
                    </form>
                    @if (Auth::user()->vip != 'vip')
                        <div class="text-center mt-5">

                            <form action="/updateAccount/{{ Auth::id() }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name='vip' value='vip'>
                                <button type="submit" style="margin-right: 40px" class="btn btn-success">Đăng
                            </form>
                            ký</button>
                        </div>
                    @endif
                    <form>
                </ul>

            </div>
            <div class="col-4 pb-3"
                @if (Auth::user()->vip == 'vip_pro') data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-custom-class="custom-tooltip" data-bs-title="Đang dùng." @endif
                style="background-color: #fdfdfd; height: 100%;   box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); ">

                <h5 class="text-center mt-3" style="color:#4268aa ">Loại Vip Pro Max </h5>

                <h4 class="text-center mt-3"><span style="color: rgb(155, 38, 38)">199.000Đ <del>567.000Đ</del></span>
                </h4>
                <ul class="mt-4">
                    <li> URLs rút gọn: Không giới hạn.</li>
                    <li> Lượt Click/tháng: Không giới hạn.</li>
                    <li> Thời gian lưu giữ link: không thời hạn. (*)</li>
                    <li> Số trang Splash: 05.</li>
                    <li> Tùy biến QR Code.</li>
                    <li> Số trang Overlay: 05.</li>
                    <li> Target theo vị trí địa lý.</li>
                    <li> Target theo thiết bị.</li>
                    <li> Bundles & Link Rotator.</li>
                    <li> Bí danh tùy chỉnh.</li>php
                    <li> Tạo link cho App Mobile.</li>
                    <li> Nhắm mục tiêu Facebook Pixels.</li>
                    <li> Campaign URL Builder.</li>
                    <li> Thống kê truy cập.</li>
                    <li> Có quảng cáo.</li>
                    <li> QR Code động.</li>
                    <li> Xóa, sửa link rút gọn.</li>
                    <li> Không vô hiệu hóa link dù không có truy cập.</li>
                    <li> Team Member: 05 thành viên.</li>
                    <li> Cập nhật link gốc: Không giới hạn.</li>
                    <li> Tên miền con: https://ten-ban.g2.by: 01 (**)</li>
                    <li> Xuất dữ liệu.</li>
                    <li> Developer API.</li>
                    <li> Chrome Extension cho tên miền tùy chỉnh.</li>
                    <li> Tên miền tùy chỉnh: 01 (**)</li>
                    <li> Xuất dữ liệu.</li>
                    <li> Developer API.</li>
                    <li> Chrome Extension cho tên miền tùy chỉnh.</li>
                    <li> Tên miền tùy chỉnh: 01 (**)</li>
                    </form>

                    @if (Auth::user()->vip != 'vip_pro')
                        <div class="text-center mt-5">

                            <form action="/updateAccount/{{ Auth::id() }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name='vip' value='vip_pro'>
                                <button type="submit" style="margin-right: 40px" class="btn btn-success"> Đăng
                                    ký</button>
                        </div>
                    @endif

                </ul>
            </div>
        </div>
    </div>
@endif


<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
