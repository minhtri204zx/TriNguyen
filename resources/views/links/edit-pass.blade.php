<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="background: linear-gradient(#141e30, #243b55);">
    
<div style="background-color:#fff;color: #1A376B; width: 500px; margin: 0 auto; border-radius: 20px; margin-top: 50px; height:500px">
    <div class="container pt-5 pb-5" >
        <h1 class="text-center">Đặt mật khẩu</h1>
        <form action="/links/{{$link->id}}/pass" method="POST">
            @csrf
            @method('PATCH')
            <label  style="margin-top: 10px" for="">Đường link</label>
            <input style="margin-top: 10px" type="text" value="{{$link->link}}" name="email" class="form-control" disabled>
         
            <label  style="margin-top: 10px" for="">Mật khẩu</label>
            <input style="margin-top: 10px" type="text" name="pass" value="{{$link->pass}}" class="form-control">
            @error('pass')
                <div style="color: red">{{ $message }}</div>
            @enderror
            <div class="text-center">
                <input type="submit" value="Submit" name="btn" class="btn btn-primary mt-4">
            </div>
        </form>
    </div>
</div>
</body>
</html>
