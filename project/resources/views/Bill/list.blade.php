@extends('static/master')
@section('content')
<div class="container p-5">
        <form action="{{action('BillsController@index')}}" method="get" data-role="validator" action="javascript:">
                <div class="container">
                    <div class="grid">
                        <div class="row">
                            <div class="cell-sm-12 cell-lg-3">
                                <label for="select">เดือน</label>
                                <select data-role="select" name="m">
                                    @for($i=1;$i<=12;$i++) 
                                        <option value="{{$i}}" 
                                        {{$i==$month?'selected':''}}
                                        >{{ $th_month[$i] }} </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="cell-sm-12 cell-lg-3">
                                <label for="select">ปี</label>
                                <select data-role="select" name="y">
                                    @for ($i = date('Y')+543;$i>date('Y')+543-10 ; $i--)
                                    <option value="{{$i}}"
                                    {{$i==$year?'selected':''}}
                                    >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="cell-sm-12 cell-lg-3">
                                <label for="select">หอพัก</label>
                                <select data-validate="required" name="ap" autocomplete="off">
                                    @foreach ($ap_list as $a)
                                    <option value="{{$a['id']}}"
                                    {{$a['id']==$ap?'selected':''}}
                                    >{{$a['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="cell-sm-12 cell-lg-3">
                                <br>
                                <button class="button info block mif-search" type="submit"> ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    <hr>
    <div class="container">
            <a href="{{action('BillsController@create')}}">
                <button class="button success">
                    + เพิ่มบิล
                </button>
            </a>
            <a href="javascript:printBill()">
                    <button class="button warning float-right">
                        <span class="mif-printer"></span>
                        ดูใบเสร็จ
                    </button>
            </a>
        </div>
        <hr>
    <table class="table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อห้องพัก</th>
                <th>จำนวนหน่วยน้ำ</th>
                <th>จำนวนหน่วยไฟ</th>
                <th>แก้ไข</th>
                <th style="width:5%;">
                    <input type="checkbox" data-role="checkbox" data-caption="ทั้งหมด" onclick="checkAll(this)">
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($bills as $i=>$b)
                <tr>
                <td>
                    {{$i+1}}
                </td>
                <td>
                    {{$b['room_id']}}
                </td>
                <td style="width:20%">
                    {{$b['water_number']}}
                </td>
                <td style="width:20%;">
                    {{$b['elect_number']}}
                </td>
                <td style="width:5%">
                    <a  class="button primary"  
                    href="bill/create?ap={{$ap}}&m={{$month}}&y={{$year}}" >
                        <span class="mif-pencil"></span>
                    </a>
                </td>
                <td>
                    <input type="checkbox" data-role="checkbox" value="{{$b['id']}}">
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="print"></div>
<script>

checkAll = (e)=>{
    $('table tbody td input[type="checkbox"]').prop('checked',$(e).prop('checked'))
}

printBill = ()=>{
    let ap = "{{$ap}}"
    let id = $('table tbody td input[type="checkbox"]')
    .filter(function(){return $(this).prop('checked')})
    .map(function(){return $(this).val()}).toArray()
    if(id.length>0){
        id = id.join(',')
        window.open("/bill/print/1?id="+id+'&ap='+ap,"new");
    }else{
        alert('กรุณาเลือกห้อง')
    }
}

</script>
@endsection