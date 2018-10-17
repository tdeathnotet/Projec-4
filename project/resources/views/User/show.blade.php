@extends('static/master')
@section('content')
<div class="container p-5">
    <hr>
<center>
    <table class="table striped cell-border" style="width:30%">
        <tbody>
            <tr align="right">
                <td><b>username</b> : </td>
                <td>{{$user['name']}}</td>
            </tr>
            <tr align="right">
                <td><b>password</b> : </td>
                <td>{{$user['password']}}</td>
            </tr>
            <tr align="right">
                <td><b>status</b> : </td>
                <td>{{$user['status']}}</td>
            </tr>
            <tr align="right">
                <td><b>ห้อง</b> : </td>
                <td>{{$user['room_id']}}</td>
            </tr>
            <tr align="right">
                    <td><b>วันที่สร้าง</b> : </td>
                    <td>{{$user['created_at']}}</td>
                </tr>
        </tbody>
    </table>
    <a href="/usermg"><< กลับ</a>
</center>
</div>
@endsection