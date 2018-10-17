@extends('static/master')
@section('content')
<div class="container p-5">
    <div>
        <form action="{{url('cost')}}" method="post" data-role="validator" action="javascript:">
            {{ csrf_field() }}
            <div class="form-group">
                <table class="table striped">
                    <thead>
                        <tr>
                            <th>ชื่อค่าใช้จ่าย</th>
                            <th>ราคา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text"  
                                data-role="input" 
                                data-validate="required minlength:3" 
                                name="name" 
                                placeholder="ชื่อค่าใช้จ่าย 1"
                                autocomplete="off"
                                >
                            </td>
                            <td>
                                <input type="number" 
                                data-role="input" 
                                data-validate="required minlength:2 number" 
                                name="price" 
                                autocomplete="off"
                                placeholder="ราคาค่าใช้จ่าย 1" 
                                >
                            </td>
                            <td>
                                <button class="button success" type="submit">
                                    <i class="mif-plus"></i> เพิ่ม
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <hr>
    <table class="table striped">
        <thead>
            <tr>
                <th>ชื่อค่าใช้จ่าย</th>
                <th>ราคา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            </thead>
            <tbody> 
                @foreach ($costs as $i=>$c)
                    <tr>
                        <td>
                            {{$c['name']}}
                        </td>
                        <td style="width:20%">
                            {{$c['price']}}
                        </td>
                        <td style="width:5%">
                            <a  class="button primary"  href="{{action('CostsController@edit',$c['id'])}}" >
                                <span class="mif-pencil"></span>
                            </a>
                        </td>
                        <td style="width:5%">
                            <form action="{{action('CostsController@destroy',$c['id'])}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button  class="button alert" type="submit" onclick="return confirm('ต้องการลบ {{$c['name']}} ?')" >
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