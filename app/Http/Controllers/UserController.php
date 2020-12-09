<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
      
    }
    public function index(){
        return view('users.index',[
            'users'=>User::where('role',1)->get()
        ]);
    }

    public function add(Request  $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'center'=>'required'
        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->center=$request->center;
        $user->role=1;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect()->route('users');
    }

    public function edit(Request  $request,User $user){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'center'=>'required'
        ]);

        $user->name=$request->name;
        $user->email=$request->email;
        $user->center=$request->center;
        $user->save();
        return redirect()->route('users');
    }

    public function changepass(Request  $request){
        $request->validate([
            'password'=>'required',
            'id'=>'integer|required'
        ]);
        
        $user=User::find($request->id);
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json('password Update Sucessfully');
    }
}
