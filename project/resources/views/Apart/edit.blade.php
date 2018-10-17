@extends('static/master')
@section('content')
<div class="container p-5">
    
<form action="{{action('ApartController@update',$id)}}" method="post"  data-role="validator" action="javascript:">

        {{ csrf_field() }}

        <div class="form-group">
            <label>ชื่อหอ</label>
        <input type="text"  data-validate="required minlength=3" name="name"autocomplete="off" value="{{$ap['name']}}" />
            <span class="invalid_feedback">
                กรุณาใส่ชื่อจริง อย่างน้อย 3 ตัว
            </span>
        </div>
        <div class="form-group">
            <label>ชื่อย่อ</label>
            <input type="text" 
                data-validate="required minlength=2" 
                name="shname" 
                autocomplete="off" 
                value="{{$ap['shname']}}"
                onkeypress="return (/^[A-Za-z0-9]*$/.test(event.key))"
                />
            <span class="invalid_feedback">
                กรุณาใส่ชื่อย่อของหอ อย่างน้อย 2 ตัว
            </span>
        </div>

        <div class="form-group">
            <label>ค่าน้ำต่อหน่วย</label>
            <input type="number" data-validate="required" name="water" autocomplete="off" value="{{$ap['water']}}"/>
            <span class="invalid_feedback">
                กรุณาใส่ค่าน้ำต่อหน่วย
            </span>
        </div>

        <div class="form-group">
            <label>ค่าไฟต่อหน่วย</label>
            <input type="number" data-validate="required" name="elect" autocomplete="off" value="{{$ap['elect']}}"/>
            <span class="invalid_feedback">
                กรุณาใส่ค่าไฟต่อหน่วย
            </span>
        </div>
        
        <div class="form-group">
            <label>รายละเอียด</label>
            <textarea  name="detail" id="" cols="30" rows="10" data-validate="required minlength=3">{{$ap['detail']}}</textarea>
            <span class="invalid_feedback">
                กรุณาใส่รายละเอียด
            </span>
        </div>

        <div class="form-group text-center">
            <hr>
            <input type="hidden" name="_method" value="PATCH">
            <button class="button success" type="submit">บันทึก</button>
            <a type="button" class="button" href="/apart/" >ยกเลิก</a>
        </div>

    </form>

</div>
@endsection