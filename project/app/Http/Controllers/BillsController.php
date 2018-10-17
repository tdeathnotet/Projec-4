<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Http\Models\BillModel;
use App\Http\Models\ApartModel;
use App\Http\Models\CostModel;
use App\Http\Models\RoomModel;

class BillsController extends Controller
{

    public function index(Request $request)
    {
        $ap    = $request->get('ap');
        $month = $request->get('m');
        $year  = $request->get('y');
        $th_month = $this->th_month();
        $ap_list = ApartModel::all()->toArray();
        $bills = BillModel::where([
            ['ap_id','=',$ap],
            ['month','=',$month],
            ['year','=',$year]
        ])->orderBy('room_id','asc')
        ->get()->toArray();
        return view('Bill/list',compact('ap_list','ap','month','year','th_month','bills'));
    }


    public function create(Request $request)
    {
        $ap    = $request->get('ap');
        $month = $request->get('m');
        $year  = $request->get('y');
        $th_month = $this->th_month();
        $ap_list = ApartModel::all()->toArray();
        $cost_list = CostModel::all()->toArray();
        $room_list = RoomModel::select('id as r_id', 'roomer', 'cost', 'rent', 'ap_id')
        ->where('ap_id',$ap)->get()->toArray();
        $apart_detail = [];
        if($ap) {
            $apart_detail = ApartModel::find($ap)->toArray();
        }
        $bill = BillModel::select('water_number','elect_number','bwater_number','belect_number','note','id')
        ->where([
            ['ap_id','=',$ap],
            ['month','=',$month],
            ['year','=',$year]
        ])->orderBy('room_id','asc')
        ->get()->toArray();
        $before = [];
        foreach ($room_list as $key => $value) {
            $room_list[$key]['id'] = $value['r_id'];
            $m = $month;
            $y = $year ;
            if($month==1){
                $y = $year -1;
                $m = 12;
            }
            $before[$value['r_id']]= [];
            $be = $this->get_before($value['r_id'],$m-1,$y);
            if(!empty($be))
            $before[$value['r_id']] = $be[0];
        }
        return view('Bill/add',compact('ap_list','cost_list',
        'ap','month','year','apart_detail',
        'th_month','room_list','bill','before'));
    }


    public function store(Request $request)
    {
        $data    = [];
        $ap      = $request->get('ap_id');
        $m       = $request->get('month');
        $y       = $request->get('year');
        $room_id = $request->get('room_id');
        $water   = $request->get('water');
        $elect   = $request->get('elect');
        $bwater   = $request->get('bwater');
        $belect   = $request->get('belect');
        foreach($room_id as $r){
            $data[] = [
                'month'=>$m,
                'year'=>$y,
                'room_id'=>$r,
                'ap_id'=>$ap,
                'water_number'=>$water[$r],
                'elect_number'=>$elect[$r],
                'bwater_number'=>$bwater[$r],
                'belect_number'=>$belect[$r],
            ];
        }
        if(BillModel::insert($data)){
            $message = 'บันทึกสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'ลบล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('bill/create');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $data    = [];
        $ap      = $request->get('ap_id');
        $m       = $request->get('month');
        $y       = $request->get('year');
        $room_id = $request->get('room_id');
        $water   = $request->get('water');
        $elect   = $request->get('elect');
        $bill   = $request->get('bill');
        $bwater   = $request->get('bwater');
        $belect   = $request->get('belect');
        $succ = [];
        foreach($room_id as $i=>$r){
            $b = BillModel::find($bill[$r]);
            if($b){
                $b->month=$m;
                $b->year=$y;
                $b->room_id=$r;
                $b->ap_id=$ap;
                $b->water_number=$water[$r];
                $b->elect_number=$elect[$r];
                $b->bwater_number=$bwater[$r];
                $b->belect_number=$belect[$r];
                $succ[!!$b->save()][$r] = "";
            }else{
                BillModel::insert([[
                    'month'=>$m,
                    'year'=>$y,
                    'room_id'=>$r,
                    'ap_id'=>$ap,
                    'water_number'=>$water[$r],
                    'elect_number'=>$elect[$r],
                    'bwater_number'=>$bwater[$r],
                    'belect_number'=>$belect[$r],
                ]]);
            }
        }
        $message = 'อัพเดตสำเร็จ';
        Session::flash('class', '');
        Session::flash('icon', 'checkmark');
        Session::flash('message', $message); 
        return back();
    }

    public function destroy($id)
    {
        //
    }

    public function get_bill(Number $ap,Number $month,Number $year)
    {
        $data = BillModel::where([
            ['ap_id','=',$ap],
            ['month','=',$month],
            ['year','=',$year]
        ])
        ->get()
        ->toArray();
    }

    private function th_month(){
        return ['','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน', 
                    'กรกฎาคม','สิงหาคม','กันยายน ','ตุลาคม','พฤศจิกายน', 'ธันวาคม'];
    }

    public function print(Request $request){
        $bill_id = $request->get('id');
        $bill_id = explode(',',$bill_id);
        $month = $request->get('m');
        $year = $request->get('y');
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
            return "no data";
        }
    }

    private function get_detail($id,$ap_id){
        $re = BillModel::find($id);
        if($re){
            $re = $re->toArray();
            if($re['ap_id']==$ap_id){
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

    private function get_before($room_id,$m,$y){
        $re = BillModel::where([
            ['room_id','=',$room_id],
            ['month','=',$m],
            ['year','=',$y]
        ])
        ->get()
        ->toArray();
        return $re;
    }

}
