<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\BoardModel;

class BoardController extends Controller
{

    public function index()
    {
        $boards = DB::table('board_models')->paginate(20);
        #dd($boards);
        return view('Board/list',compact('boards'));
    }

    
    public function create()
    {
        return view('Board/add');
    }

    
    public function store(Request $request)
    {
        $board = new BoardModel([
            'topic'   => $request->get('topic'),
            'detail' => $request->get('detail'),
            'user_id' => Session::get('user_data')['id']
        ]);
        if($board->save()){
            $message = 'บันทึกสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'บันทึกล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('board')->with(['message'=>$message]);
    }

    public function list()
    {
        $boards = DB::table('board_models')->paginate(20);
        return view('Board/view_list',compact('boards'));
    }

    public function show($id)
    {
        $board = BoardModel::find($id)->toArray();
        $boards = BoardModel::where('id','!=',$id)->orderBy('created_at', 'desc')->take(5)->get();
        return view('Board/view',compact('board','id','boards'));
    }

   
    public function edit($id)
    {
        $board = BoardModel::find($id);
        return view('Board/edit',compact('board','id'));
    }

    
    public function update(Request $request, $id)
    {
        $board = BoardModel::find($id);
        $board->topic   = $request->get('topic');
        $board->detail = $request->get('detail');
        $board->user_id = Session::get('user_data')['id'];
        if($board->save()){
            $message = 'แก้ไขสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'แก้ไขล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('board')->with(['message'=>$message]);
    }

    public function destroy($id)
    {
        $board = BoardModel::find($id);
        if($board->delete()){
            $message = 'ลบสำเร็จ';
            Session::flash('class', 'green');
            Session::flash('icon', 'checkmark');
        }else{
            $message = 'ลบล้มเหลว';
            Session::flash('class', 'red');
            Session::flash('icon', 'cross');
        }
        Session::flash('message', $message); 
        return redirect('board');
    }
}
