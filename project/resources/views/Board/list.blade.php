@extends('static/master')
@section('content')
<style>
    ul.pagination li{
        padding-left:10px !important;
        font-size: 20px;
    }
</style>
<div class="container p-5">
    <div>
        <a href="{{action('BoardController@create')}}">
            <button class="button success">
                + เพิ่มประกาศ
            </button>
        </a>
        <a href="/board/list/1">
            <button class="button primary">
                <span class="mif-list"></span> ดูรายการประกาศ
            </button>
        </a>
    </div>
    <hr>
    <table class="table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>หัวข้อ</th>
                <th>วันที่ประกาศ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($boards->items() as $i=>$ap)
                <tr>
                <td>{{$i+1}}</td>
                <td>{{$ap->topic}}</td>
                <td>{{$ap->created_at}}</td>
                <td style="width:5%">
                    <a  class="button primary"  href="{{action('BoardController@edit',$ap->id)}}" >
                        <span class="mif-pencil"></span>
                    </a>
                </td>
                <td style="width:5%">
                    <form action="{{action('BoardController@destroy',$ap->id)}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  class="button alert" type="submit" onclick="return confirm('ต้องการลบ {{$ap->topic}} ?')" >
                            <span class="mif-cross"></span>
                        </button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <center>{{ $boards->links() }}</center>
</div>
@endsection