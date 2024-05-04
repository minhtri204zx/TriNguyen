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
    
    <div class="row">
        <div class="col-3">
            <h5>Quốc gia</h5>
            <select class="form-select" id="list" onchange="change()">
                <option value="">Chưa chọn </option>

                @foreach ($countries as $country)
                    <option class="position-relative" @if (request()->input('country') == $country['country']) {{ 'selected' }} @endif
                        value="{{ request()->fullUrlWithQuery([
                            'country' => $country['country'],
                        ]) }}">
                        {{ $country['country'] }} ({{$country->abc}})  </option>
                @endforeach

            </select>
        </div>
        <div class="col-3">
            <h5>Thiết bị</h5>
            <select class="form-select" id="list2" onchange="change2()">
                <option value="">Chưa chọn</option>
              
                @foreach ($devices as $device)
                <option @if (request()->input('device') == $device['device']) {{ 'selected' }} @endif
                    value="{{ request()->fullUrlWithQuery([
                        'device' => $device['device'],
                    ]) }}">
                    {{ $device['device'] }}</option>
            @endforeach

            </select>
        </div>
        <div class="col-5" >
            <h5>Thời gian</h5>
            <form action="" style="display: flex; align-items: center">
                <label for="" style=" margin-right: 15px">Từ</label>
                <input type="date" @if(request()->input('created_at')!=null)
                value="{{request()->input('created_at')}}"
                @endif   id="date1" style="width: 400px;" class="form-control" onchange="change3()">
                <label for=""  style=" margin-left: 15px"> Đến</label>
                <input type="date" @if(request()->input('end')!=null)
                value="{{request()->input('end')}}"
                @endif   id="date2" style="width: 400px; margin-left: 10px" onchange="change4()" class="form-control">

            </form>
        </div>
    </div>
    <div  style="height: 400px">
        <table class="table table-striped">
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
                        <td>{{ $loop->iteration }} </td>
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
    </div>
    <?php
    $pages = ceil($viewers->total() / 8);
    ?>
    @for ($i = 1; $i <= $pages; $i++)
        <a id="pages" style="<?php
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        if ($_GET['page'] == $i) {
            echo 'background-color: rgba(6, 16, 109, 0.753);color: white;font-weight: 700;';
        } ?>"
            href="{{ request()->fullUrlWithQuery([
                'page' => $i,
            ]) }}">{{ $i }}</a>
    @endfor
</div>

<script>
    function change() {
        var selectedValue = document.getElementById("list").value;
        if (selectedValue) {
            window.location.href = selectedValue;
        }else{
            let urlDate = `{{ request()->fullUrlWithQuery([
                        'country' => '',
                    ]) }}`;
            let url = urlDate.replace(/country=/gi, '');
            let urlAfter = url.replace(/&amp;/gi, '&');
            console.log(urlAfter);
            window.location.href = urlAfter
        }
    }

    function change2() {
        var selectedValue = document.getElementById("list2").value;
        if (selectedValue) {
            window.location.href = selectedValue;
        }else{
            let urlDate = `{{ request()->fullUrlWithQuery([
                        'device' => '',
                    ]) }}`;
            let url = urlDate.replace('device=', '');
            let urlAfter = url.replace(/&amp;/gi, '&');
            window.location.href = urlAfter
        }
    } 
    
    function change3() {
        var selectedValue = document.getElementById("date1").value;
        if (selectedValue) {
            console.log(selectedValue);
            let urlDate = `{{ request()->fullUrlWithQuery([
                        'created_at' => 'ac',
                    ]) }}`;
            let url = urlDate.replace('ac', selectedValue);
            let urlAfter = url.replace(/&amp;/gi, '&');
            window.location.href = urlAfter
        }else{
            let urlDate = `{{ request()->fullUrlWithQuery([
                        'created_at' => '',
                    ]) }}`;
            let url = urlDate.replace(/created_at=/gi, '');
            let urlAfter = url.replace(/&amp;/gi, '&');
            console.log(urlAfter);
            window.location.href = urlAfter
        }
    }

    function change4() {
        var selectedValue = document.getElementById("date2").value;
        if (selectedValue) {
            console.log(selectedValue);
            let urlDate = `{{ request()->fullUrlWithQuery([
                        'end' => 'ac',
                    ]) }}`;
            let url = urlDate.replace('ac', selectedValue);
            let urlAfter = url.replace(/&amp;/gi, '&');
            window.location.href = urlAfter
        }else{
            let urlDate = `{{ request()->fullUrlWithQuery([
                        'end' => '',
                    ]) }}`;
            let url = urlDate.replace(/end=/gi, '');
            let urlAfter = url.replace(/&amp;/gi, '&');
            console.log(urlAfter);
            window.location.href = urlAfter
        }
    }
</script>

@endsection
