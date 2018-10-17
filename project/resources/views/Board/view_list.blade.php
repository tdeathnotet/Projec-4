@extends('static/master')
@section('content')
<style>
    ul.pagination li {
        padding-left: 10px !important;
        font-size: 20px;
    }
</style>
<div class="container p-5">
    <h1>
        <span class="mif-news"></span> ประกาศจากหอพัก
    </h1>
        <center> {{ $boards->links() }}</center>
    <hr>
    <table class="table striped">
        @foreach ($boards->items() as $i=>$ap)
        <tr>
            <td>
                <a href="/board/view/{{$ap->id}}">
                    <div>
                        <h5>{{$ap->topic}}</h5>
                        <small>{{date('d-m-Y H:i:s',strtotime($ap->created_at))}}</small>
                    </div>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    <hr>
    <center> {{ $boards->links() }}</center>
</div>
@endsection