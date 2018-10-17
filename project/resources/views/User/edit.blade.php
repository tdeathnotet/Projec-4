@extends('static/master')
@section('content')
<div class="container p-5">
    <form action="{{action('UserMgController@update',$id)}}" method="post" data-validate="validator" action="javascript:">
        {{ csrf_field() }}
        <div class="form-group">
            username :
            <input type="text" name="username" value="{{$user['name']}}" data-validate="required minlength=3">
        </div>
        <div class="form-group">
            password :
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <hr>
            <input type="hidden" name="_method" value="PATCH">
            <button class="button success" type="submit">บันทึก</button>
            <a type="button" class="button" href="/usermg/">ยกเลิก</a>
        </div>
    </form>
</div>
@endsection