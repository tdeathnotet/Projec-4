<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Models\RoomModel;
use App\Http\Models\ApartModel;
use App\Http\Models\CostModel;

class RoomsController extends Controller
{
    
    public function index()
    {
        $rooms = RoomModel::select('rooms.id as room_id','shname','rent','cost','roomer')
        ->join('aparts','aparts.id','=','rooms.ap_id')
        ->get()
        ->toArray();
        foreach($rooms as $i=>$r){
            $ex = explode(',',$r['cost']);
            $cost = CostModel::whereIn('id',$ex)->get()->toArray();
            $rooms[$i]['costs'] = implode(',',array_column($cost,'name'));
        }
        $title = "Rooms list";
        return view('Room/list',compact('title','rooms'));
    }

    
    public function create()
    {
        $ap_list = ApartModel::select('name','id','shname')->get()->toArray();
        $cost_list = CostModel::all()->toArray();
        return view('Room/add',compact('ap_list','cost_list'));
    }


    public function store(Request $request)
    {
        $this->validate($request,['room_id'=>'required','roomer'=>'required',
        'costs'=>'required','rent'=>'required']);
        $ap_name = ApartModel::find($request->get('ap'))->toArray()['shname'];
        $room_id = $ap_name.'_'.$request->get('room_id');
        $costs = $request->get('costs');
        $room = new RoomModel([
            'id'     => $room_id,
            'roomer' => $request->get('roomer'),
            'cost'   => implode(',',$costs),
            'rent'   => $request->get('rent'),
            'ap_id'  => $request->get('ap')
        ]);
        if($room->save()){
            $message = 'บันทึกสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'บันทึกล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }

        Session::flash('message', $message); 
        
        return redirect('room');
    }

    
    public function show($id)
    {   
        
    }

    
    public function edit($id)
    {
        $room = DB::select("select * from rooms where id='{$id}' ")[0];
        $room = json_decode(json_encode($room),true);
        $room['cost']    = explode(',',$room['cost']);
        $room['ap_name'] = ApartModel::where('id',$room['ap_id'])->get()->first()->toArray()['name'];
        $cost_list       = CostModel::all()->toArray();
        #dd($room);
        return view('Room/edit',compact('room','cost_list','id'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
        'room_id'=>'required',
        'roomer'=>'required',
        'cost'=>'required',
        'rent'=>'required']);
        #dd($request->all());
        $cost = $request->get('cost');
        $room = RoomModel::find($id);

        $room->roomer = $request->get('roomer');
        $room->cost   = implode(',',$cost);
        $room->rent   = $request->get('rent');

        if($room->save()){
            $message = 'แก้ไขสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'แก้ไขล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }

        Session::flash('message', $message); 

        return redirect('room');

    }

    
    public function destroy($id)
    {

        $cost = RoomModel::find($id);

        if($cost->delete()){
            $message = 'ลบสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'ลบล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }

        Session::flash('message', $message); 

        return redirect('room')->with(['message'=>$message]);

    }
}
