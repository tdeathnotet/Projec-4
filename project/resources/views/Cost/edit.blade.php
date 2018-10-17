@extends('static/master')
@section('content')
<div class="container p-5">
    <form action="{{action('CostsController@update',$id)}}" method="post" data-role="validator" action="javascript:">
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
                            data-role="input" data-validate="required minlength:3" 
                            name="name" 
                            placeholder="ชื่อค่าใช้จ่าย 1"
                            autocomplete="off"
                            value="{{$cost['name']}}"
                            >
                        </td>
                        <td>
                            <input type="number" 
                            data-role="input" 
                            data-validate="required minlength:2 number" 
                            name="price" 
                            autocomplete="off"
                            placeholder="ราคาค่าใช้จ่าย 1"
                            value="{{$cost['price']}}"
                             >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group text-center">
            <hr>
            <input type="hidden" name="_method" value="PATCH">
            <button class="button success" type="submit">บันทึก</button>
            <a type="button" class="button" href="/cost/">ยกเลิก</a>
        </div>

    </form>

</div>
<script>
    add = () => {
        $('tbody')
        .append(`<tr>
                <td>
           
                    <input type="text"  
                            data-role="input" data-validate="required minlength:3" 
                            name="name[]" 
                            placeholder="ชื่อค่าใช้จ่าย ${$('table tbody tr').length+1}"
                            autocomplete="off">
                    </td>
                <td>
                    <input type="number" 
                            data-role="input" 
                            data-validate="required minlength:2 number" 
                            name="price[]" 
                            autocomplete="off"
                            placeholder="ราคาค่าใช้จ่าย ${$('table tbody tr').length+1}" >
                    </td>
            </tr>`)
    }
    del = () => {
        if ($('table tbody tr').length > 1)
            $('table tbody tr:last').remove()
    }
</script>

@endsection