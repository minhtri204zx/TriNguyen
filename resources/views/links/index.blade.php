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
        <option @isset($_GET['popular'])
        selected
   @endisset value="/links?popular=true">Phổ biến
            nhất</option>
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
                    <td>{{ $loop->iteration }}</td>
                    <td><a class='linkgoc' href="{{ $link->link }}">{{ $link->link }}</a></td>
                    <td><a class='linkgoc' href="{{ $link->url }}">{{ $link->url }}</a></td>
                    <td>
                        <span style="margin-left: 25px" class="badge text-bg-success">alive</span>
                    </td>
                    
                    <td><span style="margin-left: 35px" class="badge text-bg-primary">{{ $link->click }}</span></td>

                    <td>{{ $link->created_at->diff(now())->format('%H giờ %I phút %s giây') }}
                    <td>

                        <form action="{{ route('links.destroy', $link) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 7px ">Xoá</button>
                            <a href="links/{{ $link->id }}" class="btn btn-info">Xem chi tiết</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
</script>

@endsection
