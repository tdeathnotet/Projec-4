<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;
use App\Http\Models\UserModel;
use App\Http\Models\RoomModel;

class UserMgController extends Controller
{

    public function index()
    {
        $users = UserModel::all()->toArray();
        return view('User/list',compact('users'));
    }


    public function create()
    {
        $room_list = RoomModel::select('id as r_id')->get()->toArray();
        return view('User/add',compact('room_list'));
    }

    public function store(Request $request)
    {
        $status = $request->get('status');
        $room = $request->get('room');
        if($status=='admin'){
            $username = $request->get('username');
            $password = Hash::make($request->get('password'));
        }
        else{
            $username = $room;
            $password = substr(md5($room.date('H:i:s')), 0,8);
        }
        $userMg = new UserModel([
            'name'   => $username,
            'password' => $password,
            'room_id' => $room,
            'status'  => $status
        ]);
        if($userMg->save()){
            $message = 'บันทึกสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'บันทึกล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('usermg');
    }

    public function show($id)
    {
        $user = UserModel::find($id)->toArray();
        #dd($user);
        return view('User/show',compact('user'));
    }

    public function edit($id)
    {
        $room_list = RoomModel::select('id as r_id')->get()->toArray();
        $user = UserModel::find($id);
        return view('User/edit',compact('room_list','id','user'));
    }

    
    public function update(Request $request, $id)
    {
        $adminpassword = $request->get('adminpassword');
        $userMg = UserModel::find($id);
        if($userMg)
        $userMg->name = $request->get('username');
        if(!empty($request->get('password')))
            $userMg->password = Hash::make($request->get('password'));
        if($userMg->save()){
            $message = 'บันทึกสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'บันทึกล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('usermg');
    }

    public function destroy($id)
    {
        $user = UserModel::find($id);
        if($user->delete()){
            $message = 'ลบสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'ลบล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('usermg');
    }
}
