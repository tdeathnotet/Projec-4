@extends('static/master')
@section('content')
<div class="container p-5">
    <div>
        <a href="{{action('RoomsController@create')}}">
            <button class="button success">
                + เพิ่มห้องพัก
            </button>
        </a>
    </div>
    <hr>
    <table class="table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อห้องพัก</th>
                <th>ค่าเช่า</th>
                <th>ค่าอื่นๆ</th>
                <th>จำนวนผู้พัก</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $i=>$r)
                <tr>
                <td>
                    {{$i+1}}
                </td>
                <td>
                    {{$r['room_id']}}
                </td>
                <td style="width:20%">
                    {{$r['rent']}}
                </td>
                <td style="width:20%;">
                    {{$r['costs']}}
                </td>
                <td style="width:10%;text-align:center;">
                    {{$r['roomer']}}
                </td>
                <td style="width:5%">
                    <a  class="button primary"  href="{{action('RoomsController@edit',$r['room_id'])}}" >
                        <span class="mif-pencil"></span>
                    </a>
                </td>
                <td style="width:5%">
                    <form action="{{action('RoomsController@destroy',$r['room_id'])}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  class="button alert" type="submit" onclick="return confirm('ต้องการลบหอ {{$r['room_id']}} ?')" >
                            <span class="mif-cross"></span>
                        </button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection