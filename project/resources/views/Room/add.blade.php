@extends('static/master')
@section('content')
<div class="container p-5">
    
<form action="{{url('room')}}" method="post"  data-role="validator" action="javascript:">

        {{ csrf_field() }}

        <div class="form-group">
            <label>ชื่อหอ</label>
            <select data-validate="required" name="ap" autocomplete="off">
                @foreach ($ap_list as $ap)
                    <option value="{{$ap['id']}}">{{$ap['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>หมายเลขห้อง</label>
            <input type="text" data-role="input"
            data-validate="required minlength=2 number" name="room_id" autocomplete="off"
            data-prepend="<span>{{$ap['shname']}}</span>"
            />
            <span class="invalid_feedback">
                กรุณาใส่หมายเลขห้อง
            </span>
        </div>
        <div class="form-group">
                <label>จำนวนผู้พัก</label>
                <input type="number" data-validate="required number" name="roomer" autocomplete="off"/>
                <span class="invalid_feedback">
                    กรุณาใส่จำนวนผู้พัก
                </span>
        </div>

        <div class="form-group">
            <label>ค่าเช่า(บาท)</label>
            <input type="number" data-validate="required number" name="rent" autocomplete="off"/>
            <span class="invalid_feedback">
                กรุณาใส่ค่าเช่า
            </span>
        </div>

        <div class="form-group">
            <label>ค่าใช้จ่ายอื่นๆ</label>
            <select data-role="select" title="" multiple name="costs[]">
                @foreach ($cost_list as $c)
                    <option value="{{$c['id']}}">{{$c['name']}}</option>
                @endforeach
            </select>
            <span class="invalid_feedback">
                กรุณาใส่ค่าเช่า
            </span>
        </div>

        <div class="form-group text-center">
            <hr>
            <button class="button success" type="submit">บันทึก</button>
            <a type="button" class="button" href="/room/" >ยกเลิก</a>
        </div>

    </form>

</div>
@endsection