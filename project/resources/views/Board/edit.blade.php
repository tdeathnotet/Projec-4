@extends('static/master')
@section('content')
<div class="container p-5">
    <form action="{{action('BoardController@update',$id)}}" method="post" data-role="validator" action="javascript:">
        {{ csrf_field() }}
        <div class="form-group">
            <label>หัวข้อ</label>
            <input type="text" data-validate="required minlength=3" 
            name="topic" autocomplete="off"
            value="{{$board['topic']}}"
            />
            <span class="invalid_feedback">
                กรุณาใส่หัวข้อประกาศ
            </span>
        </div>
        <div class="form-group">
            <br>
            <label>รายละเอียด</label>
            <textarea data-validate="required minlength=2" data-role="textarea" rows="15" name="detail" autocomplete="off">{{$board['detail']}}</textarea>
            <span class="invalid_feedback">
                กรุณาใส่รายละเอียดประกาศ
            </span>
        </div>
        <div class="form-group text-center">
            <hr>
            <input type="hidden" name="_method" value="PATCH">
            <button class="button success">บันทึก</button>
            <a type="button" class="button" href="/board/">ยกเลิก</a>
        </div>
    </form>
</div>
@endsection