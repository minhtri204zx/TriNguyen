@include('layout.header')
<body style="background-color: #1A376B">
    
<div style="background-color:#fff;color: #1A376B; width: 400px; margin: 0 auto; border-radius: 20px; margin-top: 50px">

<div class="container pt-5 pb-5">
    <h1 class="text-center">Đăng ký</h1>
<form action="" class="" method="POST">
    @csrf
    <label for="">Tên tài khoản</label>
    <input type="text" name="email" class="form-control">
    @error('email')
        <div style="color: red">{{ $message }}</div>
    @enderror
    <label for="">Mật khẩu</label>
    <input type="password" name="password" class="form-control">
    @error('password')
        <div style="color: red">{{ $message }}</div>
    @enderror

    <p class="mt-3">Đã có tài khoản? <a style="color:blue; margin:0" href="login">Đăng nhập</a></p>
    <div class="text-center">
        <input type="submit" value="Đăng ký" class="btn btn-primary mt-4">
    </div>
</form>
</div>
</div>

</body>
</html>
