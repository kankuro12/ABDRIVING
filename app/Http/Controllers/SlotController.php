<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot;
class SlotController extends Controller
{
    public function index(){
        return view('slots.index',['list'=>Slot::all()]);
    }

    public function add(Request $request){
        $request->validate([
            'time'=>'required'
        ]);

        $slot=new Slot();
        $slot->time=$request->time;
        $slot->save();
        return redirect()->route('slots')->with('message',"Slot Added sucessfully");

    }
    public function edit(Slot $slot,Request $request){
        $request->validate([
            'time'=>'required'
        ]);

        $slot->time=$request->time;
        $slot->save();
        return redirect()->route('slots')->with('message',"Slot Updated sucessfully");

    }
    public function delete(Slot $slot,Request $request){
        $slot->delete();
        return redirect()->route('slots')->with('message',"Slot Deleted sucessfully");

    }
}
