<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Plan;
class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }

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

    public function due(Request $request){
        $students=Student::where('complete',0)->get();
        $arr=[];
        foreach($students as $student){
            $amount=Payment::where('student_id',$student->id)->sum('amount');
            $plans=Plan::where('course_id',$student->course_id)->orderBy('day','desc')->get();
            $att=Attendance::where('student_id',$student->id)->where('attend',1)->count();
            foreach($plans as $plan){
                if($plan->day<=$att){
                    if($amount<$plan->amount){
                        // echo $plan->amount.",".$amount."<hr>";
                        $student->amount=$amount;
                        $student->att=$att;
                        $student->dueamount=$plan->amount-$amount;

                        // echo '<pre>';
                        // print_r($student->toArray());
                        // echo '</pre><hr>';
                        array_push($arr,$student->toArray());
                    }
                }
            }
        }
        return view('Account.due',compact('arr'));


        // if($request->getMethod()=='POST'){

        // }else{
        // }
    }
}
