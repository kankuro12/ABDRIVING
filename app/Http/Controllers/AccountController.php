<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Plan;
use App\Models\User;

class AccountController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('isadmin');
    // }

    public function daily(Request $request){
        // dd($request);
        if($request->getMethod()=="POST"){
            return view('Account.daily',
            [
                'transactions'=>Payment::where('date',$request->date)->get(),
                'date'=>$request->date
            ]
        );

        }else{
            if(old('date')){
                return view('Account.daily',[
                            'transactions'=>Payment::where('date',old('date'))->get(),
                            'date'=>old('date')
                        ]);
            }else{

                return view('Account.daily',['transactions'=>[]]);
            }
        }
    }


    public function accept(Request $request){
        $request->validate(['id'=>'integer','accept'=>'required|boolean']);
        $payment =Payment::find($request->id);
        $payment->accecpted=$request->accept;
        $payment->save();
    }


    public function acceptall(Request $request){
        $request->validate(['date'=>'required']);
        $payment =Payment::where('date',$request->date)->update([
            'accecpted'=>true
        ]);
        return redirect()->route('account.daily')->withInput($request->all());
    }

    public function dailyTransactionRequest(Request $request){
        if($request->isMethod('post')){
            $user = User::where('role','!=',0)->get();
            $payment = Payment::where('date',$request->date)->whereIn('user_id',$user)->get();
            // dd($payment);
            $expense = Expense::where('date',$request->date)->whereIn('user_id',$user)->get();
            // dd($expense);
            return view('Account.request',['date'=>$request->date,'payment'=>$payment,'expense'=>$expense,'user'=>$user]);
        }else{
            if(old('date')){
                $user = User::where('role','!=',0)->get();
                $payment = Payment::where('date',old('date'))->whereIn('user_id',$user)->get();
                $expense = Expense::where('date',old('date'))->whereIn('user_id',$user)->get();
                return view('Account.request',['payment'=>$payment,'expense'=>$expense,'user'=>$user]);
            }else{
                return view('Account.request',['payment'=>[],'expense'=>[],'user'=>[]]);
            }
        }
    }


    public function due(Request $request){
        $students=Student::where('complete',0)->get();
        // dd($students);
        $arr=[];
        foreach($students as $student){
            $amount=Payment::where('student_id',$student->id)->sum('amount');
            if($student->dealamount>$amount){
                $student->amount=$amount;
                $student->dueamount=$student->dealamount-$amount;
                array_push($arr,$student->toArray());
            }
            // $plans=Plan::where('course_id',$student->course_id)->orderBy('day','desc')->get();
            // foreach($plans as $plan){
            //         if($amount<$plan->amount){
            //             // echo $plan->amount.",".$amount."<hr>";
            //             $student->amount=$amount;
            //             $student->dueamount=$plan->amount-$amount;
            //             array_push($arr,$student->toArray());
            //         }
            // }
        }
        // dd($arr);
        return view('Account.due',compact('arr'));


        // if($request->getMethod()=='POST'){

        // }else{
        // }
    }
}
