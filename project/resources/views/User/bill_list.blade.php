@extends('static/master')
@section('content')
<div class="container p-5">
    <table class="table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อห้องพัก</th>
                <th>เดือน</th>
                <th>ดู</th>
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
                    <td style="width:5%">
                        <a  class="button primary"  
                        href="/bill/print/1?id="+{{$b['id']}}>
                            <span class="mif-pencil"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection