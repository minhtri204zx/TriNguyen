@extends('layouts.app')

@push('linkcss')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
@endpush
@php
$show=true
@endphp
@section('content')

<div class="col-9 mt-4">

    <h1 class="text-center mt-5">Lịch sử rút</h1>
    <select id="list" onchange="change()" class="form-select" style="width: 200px">
        <option @isset($_GET['sort'])
            @else selected
        @endisset value="/links">Mới nhất
        </option>
        <option  @isset($_GET['oldest'])
         selected
    @endisset value="/links?oldest=true">Cũ nhất
        </option>
    </select>
    <div style="height: 400px">
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
                        <td>{{ $loop->iteration }}</td>
                        <td><a class='linkgoc' href="{{ $link->link }}">{{ $link->link }}</a></td>
                        <td>
                            <div id="form{{ $link->id }}">
                                <a class='linkgoc' id="gray{{ $link->id }}"
                                    href="{{ $link->url }}">{{ $link->url }}</a>
                            </div>
                        </td>
                        <td>
                            <span style="margin-left: 20px"
                                class="badge text-bg-<?php if ($link->status == 'alive') {
                                    echo 'success';
                                } elseif ($link->status == 'die') {
                                    echo 'danger';
                                } else {
                                    echo 'warning text-light';
                                } ?> ?>">{{ $link->status }}</span>
                        </td>
                        
                        <td><span style="margin-left: 35px" class="badge text-bg-primary">{{ $link->click }}</span></td>
    
                        <td>{{ $link->created_at->diff(now())->format('%H giờ %I phút %s giây') }}
                        <td>
    
                            <form action="/links/{{$link->id}}/pass">
                                @csrf
                                <button class="btn btn-danger" style="margin-left: 7px ">Đặt mật khẩu</button>
                                <button type="button" class="btn btn-warning"
                                onclick="convernInput({{  $link->id }})" style="margin-left: 7px ">Sửa</button>
                                <a href="links/{{ $link->id }}" class="btn btn-info">Xem chi tiết</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  
    <div>
        <?php
        $pages = ceil($links->total() / 4);
        ?>
        @for ($i = 1; $i <= $pages; $i++)
            <a id="pages" style="<?php
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }
            if ($_GET['page'] == $i) {
                echo 'background-color: rgba(6, 16, 109, 0.753);color: white;font-weight: 700;';
            } ?>"
                href="/links?page={{ $i }}">{{ $i }}</a>
        @endfor

    </div>
</div>
<script>
    function change() {
        var selectedValue = document.getElementById("list").value;
        if (selectedValue) {
            window.location.href = selectedValue;
        }
    }

    function convernInput(id) {
            let link = document.getElementById('gray' + id);
            let form = document.getElementById('form' + id);
            let arr = link.innerText.split('/');
            link.parentNode.removeChild(link);
            form.innerHTML = ` <form name="myForm" action="/links/${id}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="shorten" style="color: gray; font-weight: normal" value="${arr[3]}" required>
                    </form>  
                `
        }

        document.getElementById("myForm").addEventListener("enter", function(event) {
            if (event.key === "Enter") {
                document.forms[0].submit();
            }
        });
</script>

@endsection
