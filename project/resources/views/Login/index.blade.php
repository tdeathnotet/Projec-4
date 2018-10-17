<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Login
    </title>
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js?v=2"></script>
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js?v=2"></script>
</head>

<body>
<style>
.cover{
    background-color: rgba(22, 22, 22, 0.842);
    color: aliceblue;
    border-radius: 10px;
}
.bg{
    width:100%;
    position:fixed;
}
@media only screen and (max-width: 600px) {
    .bg{
        display: none;
    }
    body{
        background-color: rgb(88, 162, 226);
    }
}
</style>
<img src="http://www.sabsetejkhabar.com/wp-content/uploads/2018/03/the-veridian-apartments-building-7.jpg" class="bg">
    <div class="container">
        <div class="grid">
            <div class="row">
                <div class="cell-md-3 offset-md-5 mt-5 card p-5 cover" style="margin-top:12% !important;">
                    <div class="bg-grayBlue text-center rounded">
                        <h2>เข้าสู่ระบบหอพัก</h1>
                    </div>
                    <form action="/login/check" method="POST" data-role="validator" action="javascript:">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Username : </label>
                            <input type="text" name="username" placeholder="username" 
                            autocomplete="off"
                            data-validate="required minlength=3 pattern=[0-9A-Za-z]" />
                            <small class="text-muted">ใส่ได้เฉพาะเลข 0-9A-Za-z เท่านั้น</small>
                            <span class="invalid_feedback">
                                กรุณาใส่ Username
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Password : </label>
                            <input type="password"  name="password" placeholder="password" 
                            autocomplete="off"
                            data-validate="required minlength=3 pattern=[0-9A-Za-z]" />
                            <small class="text-muted">ใส่ได้เฉพาะเลข 0-9A-Za-z เท่านั้น</small>
                            <span class="invalid_feedback">
                                กรุณาใส่ Password ให้ถูกต้อง
                            </span>
                        </div>
                        <div class="form-group text-center">
                            @if (Session::has('login'))
                                <b class="bg-red p-1">{{Session::get('login')}}</b>
                            @endif
                            @if (Session::has('logout'))
                                <b class="bg-green p-1">{{Session::get('logout')}}</b>
                            @endif
                            <br><br>
                            <button class="button success">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>