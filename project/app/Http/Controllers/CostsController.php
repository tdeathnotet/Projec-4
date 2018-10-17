<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Models\CostModel;
use App\Http\Models\ApartModel;

class CostsController extends Controller
{

    public function index()
    {
        $costs = CostModel::all()->toArray();
        //dd($costs);
        $title = "list";
        return view('Cost/list',compact('title','costs'));
    }

    public function create()
    {
        $ap_list = ApartModel::all()->toArray();
        return view('Cost/add',compact('ap_list'));
    }

    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','price'=>'required']);
        $cost = new CostModel([
            'name'=>$request->get('name'),
            'price'=>$request->get('price')
        ]);
        if($cost->save()){
            $message = 'บันทึกสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'บันทึกล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message);
        return redirect('cost');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cost   = CostModel::find($id);
        if($cost){
            return view('Cost/edit',compact('cost','id'));
        }
        else{
            return redirect('cost')->with(['message'=>'id not found']);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,['name'=>'required','price'=>'required']);
        $cost = CostModel::find($id);
        $message="";
        if($cost){
            $cost->name = $request->get('name');
            $cost->price = $request->get('price');
            if($cost->save()){
                $message = 'แก้ไขสำเร็จ';
                Session::flash('class', 'green');
                Session::flash('icon', 'checkmark');
            }else{
                $message = 'แก้ไขล้มเหลว';
                Session::flash('class', 'red');
                Session::flash('icon', 'cross');
            }
        }
        Session::flash('message', $message); 
        return redirect('cost');
    }

    public function destroy($id)
    {
        $cost = CostModel::find($id);
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
        return redirect('cost')->with(['message'=>$message]);
    }
}
