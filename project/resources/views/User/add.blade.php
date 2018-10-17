@extends('static/master')
@section('content')
<div class="container p-5">

    <form action="{{url('usermg')}}" method="post" data-role="validator" action="javascript:">

        {{ csrf_field() }}

        <div class="form-group">
            ห้อง :
            <select name="room" data-validate="required">
                <option value="-">-</option>
                @foreach ($room_list as $r)
                <option value="{{$r['r_id']}}">{{$r['r_id']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            username :
            <input type="text" name="username">
        </div>
        <div class="form-group">
            password :
            <input type="password" name="password">
        </div>
        <div class="form-group">
            สถานะ :
            <select name="status" data-validate="required">
                @foreach (['user','admin'] as $r)
                <option value="{{$r}}">{{$r}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button class="button success">บันทึก</button>
            <a type="button" class="button" href="/usermg/">ยกเลิก</a>
        </div>
    </form>
</div>
@endsection