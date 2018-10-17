<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\UserModel;

class UserController extends Controller
{

    public function index()
    {

    }

    public function bill(Request $request){
        $bill_id = $request->get('id');
        $bill_id = explode(',',$bill_id);
        $ap_id = $request->get('ap');
        $ap_detail = json_decode(json_encode(DB::select('SELECT `name`, `shname`, `detail`, `elect`, `water` from aparts WHERE id=?', [$ap_id])[0]),true);
        $d = [];
        foreach($bill_id as $b){
            $de = $this->get_detail($b,$ap_id);
            if(!empty($de['ap_id']) && $de['ap_id']==$ap_id) $d[] = $de;
        }
        if(count($d)>0){
            $title = $ap_detail['name'].'_'.$month.'_'.$year;
            return view('bill/print',compact('title','d','ap_detail'));
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    private function get_detail($id,$ap_id){
        $re = BillModel::find($id);
        if($re){
            $re = $re->toArray();
            if($re['ap_id']==$ap_id and $re['ap_id']['room_id']==Session::get('user_data')['room_id']){
            $re['room_detail'] = DB::select('SELECT `id`, `roomer`, `cost`, `rent`, `ap_id` 
            FROM `rooms` WHERE id=? and ap_id=?', [$re['room_id'],$re['ap_id']]);
            if(!empty($re['room_detail'])){
                $re['room_detail'] = $re['room_detail'][0];
                $re['cost'] = DB::select('SELECT `name`, `price` FROM `costs`WHERE id in ('.$re['room_detail']->cost.')');
                $re = json_decode(json_encode($re),true);
            }else{
                $re = [];
            }
            #echo '<pre>'.print_r($re,1).'</pre>';
            return $re;
        }else{
            return $re;
        }}
        else{
            return $re;
        }
    }



}
