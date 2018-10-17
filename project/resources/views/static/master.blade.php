<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{empty($title)?'':$title}}
    </title>
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js?v=2"></script>
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js?v=2"></script>
</head>

<body style="font-family: 'Prompt', sans-serif !important;">
    <aside class="sidebar pos-fixed z-2" data-role="sidebar" data-toggle="#sidebar-toggle-3" id="sb3" data-shift=".shifted-content">
        <div class="sidebar-header" style="height:100px">
            <span class="title fg-black" style="top:50px;"><b> {{Session::get('user_data')['name']}}</b></span>
        </div>
        <ul class="sidebar-menu">
            @if (Session::get('user_data')['status']=='admin')
            <li class="group-title">จัดการหอ</li>
            <li>
                <a href="/apart/">
                    <span class="mif-cog icon"></span>รายการหอพัก
                </a>
            </li>
            <li>
                <a href="/room/">
                    <span class="mif-home icon"></span>จัดการห้อง
                </a>
            </li>
            <li>
                <a href="/cost/">
                    <span class="mif-devices icon"></span>ค่าอุปกรณ์
                </a>
            </li>
            <li class="divider"></li>
            <li class="group-title">รายการบิล</li>
            <li>
                <a href="/bill/">
                    <span class="mif-floppy-disk icon"></span>รายการค่าหอ
                </a>
            </li>
            <li class="divider"></li>
            <li class="group-title">จัดการผู้ใช้</li>
            <li>
                <a href="/usermg/">
                    <span class="mif-users icon"></span>รายการผู้ใช้
                </a>
            </li>
            <li>
                <a href="/usermg/create">
                    <span class="mif-user-plus icon"></span>เพิ่มผู้ใช้
                </a>
            </li>
            <li class="divider"></li>
            <li class="group-title">จัดการบอร์ดข่าวสาร</li>
            <li>
                <a href="/board/">
                    <span class="mif-news icon"></span>รายการข่าวสาร
                </a>
            </li>
            <li>
                <a href="/board/create">
                    <span class="mif-plus icon"></span>เพิ่มข่าวสาร
                </a>
            </li>
            @endif
            @if (Session::get('user_data')['status']=='user')
            <li>
                <a href="/board/list/1">
                    <span class="mif-news icon"></span>บอร์ดข่าวสาร
                </a>
            </li>
            @endif
            <li class="divider"></li>
            <li>
                <a class="mt-5 mb-3" href="/login/logout">
                    <span class="mif-exit icon"></span>ออกจากระบบ
                </a>
            </li>
        </ul>
    </aside>

    <div class="shifted-content h-100 p-ab">
        <div class="app-bar pos-absolute bg-red z-1" data-role="appbar">
            <button class="app-bar-item c-pointer fg-white" id="sidebar-toggle-3">
                <b><span class="mif-menu mif-2x"></span></b>
            </button>
        </div>

        <div class="h-100 p-4">
            @yield('content')
            <script>
                $(function () {
                    ch = function () {
                        $(this).attr('placeholder', $(this).val())
                        $(this).val('')
                    }
                    $('.number input').focus(ch).click(ch).blur(function () {
                        if (this.value == '') $(this).val($(this).attr('placeholder'))
                    })
                })
                @if(Session::has('message'))
                Metro.dialog.create({
                    title: `<div class='fg-{{ Session::get('class') }}'>
                        <i class='mif-{{ Session::get('icon') }}'></i> 
                        {{ Session::get('message') }}
                        </div>`,
                    content: ''
                });
                @endif
            </script>
        </div>
    </div>
</body>

</html>