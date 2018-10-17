@extends('static/master')
@section('content')
<div class="container p-5">

    <form action="{{action('BillsController@create')}}" method="get" data-role="validator" action="javascript:">
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
                        <a class="button warning ml-3" href="{{url('bill')}}">< กลับ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <form action="{{empty($bill)?action('BillsController@store'):url('bill/update')}}" method="post" data-role="validator" action="javascript:">
        <div class="container">
            @if ($apart_detail)
                <b>ชื่อหอพัก</b> : {{$apart_detail['name']}} <br>
                <b>ค่าน้ำ</b> : {{number_format($apart_detail['water'],2,".",",")}} บาท/หน่วย <br>
                <b>ค่าไฟ</b> : {{number_format($apart_detail['elect'],2,".",",")}} บาท/หน่วย <br>
                <input type="hidden" name="ap_id" value="{{$apart_detail['id']}}">
                <input type="hidden" name="month" value="{{$month}}">
                <input type="hidden" name="year" value="{{$year}}">
            @endif
        </div>
        <hr>
        {{ csrf_field() }}
        <div class="">
        <table class="table striped cell-border">
            @if (!empty($room_list))
            <thead>
                <tr>
                    <th rowspan="2">ห้อง</th>
                    <th colspan="2" style="text-align:center">เลขมิเตอร์น้ำ</th>
                    <th colspan="2" style="text-align:center">เลขมิเตอร์ไฟ</th>
                    <th rowspan="2" style="text-align:center">หมายเหตุ</th>
                </tr>
                <tr>
                        <th style="text-align:center">ก่อน</th>
                        <th style="text-align:center">ปัจจุบัน</th>
                        <th style="text-align:center">ก่อน</th>
                        <th style="text-align:center">ปัจจุบัน</th>
                    </tr>
            </thead>
            @endif
            <tbody>
                @foreach ($room_list as $i=>$r)
                <?php 
                if(empty($before[$r['id']]['water_number']))
                $before[$r['id']]['water_number'] = 0;
                if(empty($before[$r['id']]['elect_number']))
                $before[$r['id']]['elect_number'] = 0;
                    $bw = empty($bill[$i]['bwater_number'])?$before[$r['id']]['water_number']:$bill[$i]['bwater_number'];
                    $be = empty($bill[$i]['belect_number'])?$before[$r['id']]['elect_number']:$bill[$i]['belect_number'];
                ?>
                <tr>
                    <td>
                        {{ $r['id'] }}
                        <input type="hidden" name="room_id[]" value="{{ $r['id'] }}">
                        @if (!empty($bill))
                        <input type="hidden" name="bill[{{$r['id']}}]"  
                        value="{{@$bill[$i]['id']}}"
                        >
                        @endif
                    </td>
                    <td class="bg-lightGray">
                        <input type="text" data-validate="required minlength=2 number"
                        name="bwater[{{$r['id']}}]"
                        placeholder="เลขมิเตอร์น้ำห้อง {{ $r['id'] }}"
                        value="{{$bw}}"
                         autocomplete="off"
                         @if (!empty($bw)))
                        class="bg-gray"
                        readonly
                        @endif
                        >
                        <span class="invalid_feedback">
                             {{"กรุณาใส่ เลขมิเตอร์น้ำห้อง ".$r['id']}}
                        </span>
                    </td>
                    <td>
                            <input type="text" data-validate="required min={{$bw}} number" 
                            name="water[{{$r['id']}}]"
                            placeholder="เลขมิเตอร์น้ำห้อง {{ $r['id'] }}"
                            value="{{@$bill[$i]['water_number']}}"
                            autocomplete="off"
                            min="{{$bw}}"
                            >
                            <span class="invalid_feedback">
                                 {{"กรุณาใส่ เลขมิเตอร์น้ำห้อง ".$r['id'].' และมีค่ามากกว่า '.$bw}}
                            </span>
                        </td>
                    <td class="bg-lightGray">
                        <input type="text" data-validate="required minlength=2 number" 
                            name="belect[{{$r['id']}}]"
                         placeholder="เลขมิเตอร์ไฟห้อง {{$r['id']}}"
                         value="{{$be}}"
                         autocomplete="off"
                         @if (!empty($be) ))
                         class="bg-gray"
                         readonly
                         @endif
                         
                         >
                        <span class="invalid_feedback">
                             {{"กรุณาใส่ เลขมิเตอร์ไฟห้อง ".$r['id']}}
                        </span>
                    </td>
                    <td>
                            <input type="text" data-validate="required min={{$be}} number"
                            name="elect[{{$r['id']}}]"
                             placeholder="เลขมิเตอร์ไฟห้อง {{$r['id']}}"
                             value="{{@$bill[$i]['elect_number']}}"
                             autocomplete="off"
                             >
                            <span class="invalid_feedback">
                                 {{"กรุณาใส่ เลขมิเตอร์ไฟห้อง ".$r['id'].' และมีค่ามากกว่า '.$be}}
                            </span>
                        </td>
                    <td>
                        <input type="text"
                        name="note[{{$r['id']}}]"
                        placeholder="หมายเหตุห้อง {{$r['id']}}"
                        value="{{@$bill[$i]['note']}}"
                        >
                    </td>
                </tr>
                @endforeach
                @if (empty($room_list))
                    <tr>
                        <td style="text-align:center;background-color:rgb(252, 178, 159);"  colspan="4">
                            <b>ไม่พบห้องพัก</b>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
        <hr>
        @if ($room_list)
            @if (!empty($bill))
                <input type="hidden" name="_method" value="PATCH">
            @endif
            <center>
                <button class="button success mif-{{empty($bill)?'floppy-disk':'pencil'}}" type="submit">
                    {{empty($bill)?'บันทึก':'อัพเดต'}}
                </button>
                <a class="button alert mif-cross" href="{{url('bill/create/')}}" type="submit">
                    ยกเลิก
                </a>
            </center>
        @endif
    </form>
</div>
@endsection