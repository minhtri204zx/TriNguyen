<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="background-color: #1A376B">
    
<div style="background-color:#fff;color: #1A376B; width: 400px; margin: 0 auto; border-radius: 20px; margin-top: 50px">
    <div class="container pt-5 pb-5" >
        <h1 class="text-center">Đăng nhập</h1>
        <form action="login" method="POST" class="">
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
        
            <p class="mt-3">Chưa có tài khoản? <a style="color:blue; margin:0" href="signup">Đăng ký</a></p>
            <div class="text-center">
                <input type="submit" value="Đăng nhập" name="btn" class="btn btn-primary mt-4">
            </div>
        </form>
    </div>
</div>

</body>
</html>
