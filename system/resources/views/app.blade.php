<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--1、 引入支持 Bootstrap 的 CSS 样式文件 -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="navbar">
                    <router-view class="view nav" name="Nav"></router-view>
                </div>
            </div>
        </div>

        <router-view></router-view>

    </div>
</div>

<!-- 2、引入支持Vue框架和Vue组件的app.js文件 -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
