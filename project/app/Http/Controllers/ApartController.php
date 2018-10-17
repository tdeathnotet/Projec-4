<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Models\ApartModel;

class ApartController extends Controller
{

    public function index()
    {
        $apart = ApartModel::all()->toArray();
        $title = "list";
        return view('Apart/list',compact('title','apart'));
    }

    public function create()
    {
        return view('Apart/add');
    }

    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','shname'=>'required']);
        $apart = new ApartModel([
            'name'   => $request->get('name'),
            'shname' => strtoupper($request->get('shname')),
            'detail' => $request->get('detail'),
            'elect'  => $request->get('elect'),
            'water'  => $request->get('water')
        ]);
        if($apart->save()){
            $message = 'บันทึกสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'บันทึกล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('apart')->with(['message'=>$message]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $ap = ApartModel::find($id);
        if($ap){
            $ap = $ap->toArray();
            return view('Apart/edit',compact('ap','id'));
        }
        else{
            return redirect('apart')->with(['message'=>'id not found']);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,['name'=>'required','shname'=>'required']);
        $apart = ApartModel::find($id);
        $message="";
        if($apart){
            $apart->name   = $request->get('name');
            $apart->shname = strtoupper($request->get('shname'));
            $apart->detail = $request->get('detail');
            $apart->detail = $request->get('detail');
            $apart->elect  = $request->get('elect');
            $apart->water  = $request->get('water');
            if($apart->save()){
                $message = 'ลบสำเร็จ';
                Session::flash('class', 'green');
                Session::flash('icon', 'checkmark');
            }else{
                $message = 'ลบล้มเหลว';
                Session::flash('class', 'red');
                Session::flash('icon', 'cross');
            }
            Session::flash('message', $message); 
        }
        return redirect('apart')->with(['message'=>$message]);
    }

    public function destroy($id)
    {
        $apart = ApartModel::find($id);
        if($apart->delete()){
            $message = 'ลบสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'ลบล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('apart');
    }
}
