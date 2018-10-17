<?php

namespace App\Http\Controllers;

use Session;

use Hash;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Models\UserModel;

class LoginController extends Controller
{

    public function index()
    {
        if(Session::has('user_data')){
            return redirect('/home');
            #Session::forget('user_data');
        }
        return view('Login/index');
    }

    public function check(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $check = UserModel::where([
            ['name','=',$username],
            ['password','=',$password]
        ])->limit(1)->get()->toArray();
        $login = false;
        if(empty($check)){
            $check2=UserModel::where([
                ['name','=',$username]
            ])->limit(1)->get()->toArray();
            if(!empty($check2) && Hash::check($password, $check2[0]['password'])){
                $check = $check2;
                $login = true;
            }
        }else{
            $login = true;
        }
        if($login){
            session(['user_data'=>$check[0]]);
            return redirect('/');
        }else{
            Session::flash('login','username หรือ password ไม่ถูกต้อง');
            return redirect('/login');
        }
    }

    private function checkU($username,$password){
        
        return $check;
    }
    
    public function logout(){
        Session::flush();
        Session::flash('logout','ออกจากระบบสำเร็จ');
        return redirect('/login');
    }

    public function home(){
        return view('home');
    }

}
