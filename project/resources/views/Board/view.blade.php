@extends('static/master')
@section('content')
<style>
    ul.pagination li {
        padding-left: 10px !important;
        font-size: 20px;
    }
</style>
<div class="container p-5">
    <div class="grid">
        <div class="row">
            <div class="cell-md-9 cell-sm-12 p-5 rounded" style="min-height: 600px;
            background-color: whitesmoke;">
            <div class="text-right">
                <a href="/board/list/1" class="button primary"><< กลับ</a>
            </div>
                <h1>{{$board['topic']}}</h1>
                <small>เวลาที่ประกาศ {{date('d-m-Y H:i:s',strtotime($board['created_at']))}}</small>
                
                <hr style="border-top: rgb(110, 110, 110) 2px solid;">
                <p>
                    {{$board['detail']}}
                </p>
            </div>
            <div class="cell-md-3 cell-sm-12 p-5 rounded" style="background-color: rgb(224, 224, 224);">
                <h3> <span class="mif-alarm-on"></span> ประกาศล่าสุด</h3>
                    <table class="table striped rounded">
                        @foreach ($boards as $i=>$ap)
                        <tr >
                            <td>
                                <a href="/board/view/{{$ap->id}}"  style="color:black !important;">
                                    <div>
                                        <h5>{{$ap->topic}}</h5>
                                        <small>{{date('d-m-Y H:i:s',strtotime($ap->created_at))}}</small>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection