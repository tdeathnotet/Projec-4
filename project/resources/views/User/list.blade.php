@extends('static/master')
@section('content')
<div class="container p-5">
    <div>
        <a href="{{action('UserMgController@create')}}">
            <button class="button success">
                + เพิ่มผู้ใช้
            </button>
        </a>
    </div>
    <hr>
    <table class="table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>สถานะ</th>
                <th>แก้ไข/ดู</th>
                <th>ลบ</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $i=>$u)
                <tr>
                <td>{{$i+1}}</td>
                <td>{{$u['name']}}</td>
                <td>{{$u['status']}}</td>
                <td style="width:10%">
                    @if ($u['status']=='admin')
                        <a  class="button primary"  href="{{action('UserMgController@edit',$u['id'])}}" >
                            <span class="mif-pencil"></span>
                        </a>
                    @endif
                    @if ($u['status']=='user')
                        <a  class="button warning"  href="{{action('UserMgController@show',$u['id'])}}" >
                            <span class="mif-eye"></span>
                        </a>
                    @endif
                </td>
                <td style="width:5%">
                    <form action="{{action('UserMgController@destroy',$u['id'])}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  class="button alert" type="submit" onclick="return confirm('ต้องการลบ {{$u['name']}} ?')" >
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