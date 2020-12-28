<?php

namespace App\Http\Controllers;

use App\Models\Dailytransation;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyController extends Controller
{
    public function index(Request $request){
        if($request->getMethod()=="POST"){
            $Payment = Payment::where('user_id',Auth::user()->id)->where('date',$request->date)->get();
            $expense = Expense::where('user_id',Auth::user()->id)->where('date',$request->date)->get();
            return view('daily.index',['date'=>$request->date,'payment'=>$Payment,'expense'=>$expense]);
        }else{
            if(old('date')){
                $Payment = Payment::where('user_id',Auth::user()->id)->where('date',old('date'))->get();
                $expense = Expense::where('user_id',Auth::user()->id)->where('date',old('date'))->get();
                return view('daily.index',['date'=>$request->date,'payment'=>$Payment,'expense'=>$expense]);
            }else{
                return view('daily.index',['payment'=>[],'expense'=>[]]);
            }
        }
    }


    public function sendRequest(Request $request){
        if($request->date == null || $request->total_exp == 0){
            return redirect()->back()->with('message','Please load transaction first !');
        }else{
            $daily = Dailytransation::where('date',$request->date)->where('user_id',Auth::user()->id)->count();
            if($daily>0){
                $daily = Dailytransation::where('date',$request->date)->where('user_id',Auth::user()->id)->first();
                $daily->total_exp = $request->total_exp;
                $daily->total_payment = $request->total_payment;
                $daily->save();
                return redirect()->back()->with('message','Your request already sent !');
            }else{
                $t = new Dailytransation();
                $t->total_exp = $request->total_exp;
                $t->total_payment = $request->total_payment;
                $t->user_id = Auth::user()->id;
                $t->isaccepted = 0;
                $t->date = $request->date;
                $t->branch = Auth::user()->name;
                $t->save();
                return redirect()->back()->with('message','Your request has been sent !');
            }
        }

    }

    public function seeRequest(Request $request){
        if($request->isMethod('post')){
           $daily = Dailytransation::where('date',$request->date)->where('isaccepted',0)->get();
           return view('daily.see_request',['daily'=>$daily,'date'=>$request->date]);
        }else{
            if(old('date')){
                $daily = Dailytransation::where('date',old('date'))->where('isaccepted',0)->get();
                return view('daily.see_request',['daily'=>$daily,'date'=>$request->date]);
            }else{
                $daily = Dailytransation::where('isaccepted',0)->get();
                return view('daily.see_request',['daily'=>$daily]);
            }
        }
    }

    public function allAcceptedRequest(Request $request){
        if($request->isMethod('post')){
            $daily = Dailytransation::where('date',$request->date)->where('isaccepted',1)->get();
            return view('daily.accepted_request',['daily'=>$daily,'date'=>$request->date]);
         }else{
             if(old('date')){
                 $daily = Dailytransation::where('date',old('date'))->where('isaccepted',1)->get();
                 return view('daily.accepted_request',['daily'=>$daily,'date'=>$request->date]);
             }else{
                $daily = Dailytransation::where('isaccepted',1)->get();
                 return view('daily.accepted_request',['daily'=>$daily]);
             }
         }
    }

    public function acceptRequest($id){
        $daily = Dailytransation::where('id',$id)->first();
        $daily->isaccepted = 1;
        $daily->save();
        return redirect()->back()->with('message',' '.$daily->branch.' request has been accepted !');
    }


}
