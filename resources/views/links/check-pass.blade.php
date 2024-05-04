<head>
  <link rel="stylesheet" href="{{asset('css/style2.css')}}">
</head>
<div class="login-box">
    <h2>Điền mật khẩu</h2>
    <form action="{{route('shorten.show',$shorten)}}" method="POST">
      @csrf
      <div class="user-box">
        <input type="text" name="" required="" value="{{route('shorten.show',$shorten)}}" disabled>
      </div>
      <div class="user-box">
        <input type="password" name="pass">
        <label>Password</label>
        @error('pass')
        <div style="color: red">{{ $message }}</div>
        @enderror
      </div>
     <button type="submit">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Submit</button>
    </form>
  </div>
