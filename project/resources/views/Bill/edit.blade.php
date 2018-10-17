@extends('static/master')
@section('content')
<div class="container p-5">
    
<form action="{{action('RoomsController@update',$id)}}" method="post"  data-role="validator" action="javascript:">

        {{ csrf_field() }}

        <div class="form-group">
            <label>ชื่อหอ : </label>
            {{$room['ap_name']}}
        </div>
        <div class="form-group">
            <label>หมายเลขห้อง</label>
            <input type="number" data-validate="required minlength=2 number" 
            name="room_id" autocomplete="off"
            value="{{$room['id']}}"/>
            <span class="invalid_feedback">
                กรุณาใส่หมายเลขห้อง
            </span>
        </div>
        <div class="form-group">
                <label>จำนวนผู้พัก</label>
                <input type="number" data-validate="required number" name="roomer" 
                autocomplete="off"
                value="{{$room['roomer']}}"/>
                <span class="invalid_feedback">
                    กรุณาใส่จำนวนผู้พัก
                </span>
        </div>

        <div class="form-group">
            <label>ค่าเช่า(บาท)</label>
            <input type="number" data-validate="required number" 
            name="rent" 
            autocomplete="off"
            value="{{$room['rent']}}"
            />
            <span class="invalid_feedback">
                กรุณาใส่ค่าเช่า
            </span>
        </div>

        <div class="form-group">
            <label>ค่าใช้จ่ายอื่นๆ</label>
            <select data-role="select" title="" multiple name="cost[]">
                @foreach ($cost_list as $c)
                    <option value="{{$c['id']}}" {{in_array($c['id'],$room['cost'])?'selected':''}} >{{$c['name']}}</option>
                @endforeach
            </select>
            <span class="invalid_feedback">
                กรุณาใส่ค่าเช่า
            </span>
        </div>

        <div class="form-group text-center">
            <hr>
            <input type="hidden" name="_method" value="PATCH">
            <button class="button success" type="submit">บันทึก</button>
            <a type="button" class="button" href="/bill/" >ยกเลิก</a>
        </div>

    </form>

</div>
@endsection