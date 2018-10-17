@extends('static/master')
@section('content')
<div class="container p-5">
    <div>
        <a href="{{action('ApartController@create')}}">
            <button class="button success">
                + เพิ่มหอ
            </button>
        </a>
    </div>
    <hr>
    <table class="table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อหอ</th>
                <th>ชื่อย่อ</th>
                <th>รายละเอียด</th>
                <th>ค่าน้ำต่อหน่วย</th>
                <th>ค่าไฟต่อหน่วย</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($apart as $i=>$ap)
                <tr>
                <td>{{$i+1}}</td>
                <td>{{$ap['name']}}</td>
                <td>{{$ap['shname']}}</td>
                <td style="width:20%">{{$ap['detail']}}</td>
                <td style="width:10%;text-align:center;">{{$ap['water']}}</td>
                <td style="width:10%;text-align:center;">{{$ap['elect']}}</td>
                <td style="width:5%">
                    <a  class="button primary"  href="{{action('ApartController@edit',$ap['id'])}}" >
                        <span class="mif-pencil"></span>
                    </a>
                </td>
                <td style="width:5%">
                    <form action="{{action('ApartController@destroy',$ap['id'])}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  class="button alert" type="submit" onclick="return confirm('ต้องการลบหอ {{$ap['name']}} ?')" >
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