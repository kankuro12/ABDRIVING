<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'date'=>"required",
            'amount'=>'required|integer',
            "student_id"=>"required|integer"
        ]);

        $std=Student::find($request->student_id);
        $pay=new Payment();
        $pay->amount=$request->amount;
        $pay->date=$request->date;
        $pay->billno=$request->billno;
        $pay->student_id=$std->id;
        $pay->currentattendance=$std->attendances->count();
        $pay->nextpayattendance=$request->nextpayment;
        $pay->user_id=Auth::user()->id;
        $pay->student_id=$request->student_id;
        $pay->netpaydate = $request->nextpaydate;
        $pay->save();

        $pay->currentattendance=$std->attendances->count();
        $pay->nextpayattendance=$request->nextpayment;
        $std->balance=$std->balance-$pay->amount;
        $std->save();
        return redirect()->route('students.show',['std'=>$pay->student_id])->with('message',"Payment Added sucessfully");
    }

    public function edit(Request $request,Payment $pay){
        $request->validate([
            'date'=>"required",
            'amount'=>'required|number',
            "student_id"=>"required|integer"
        ]);


        $std=Student::find($pay->student_id);
        $std->balance=$std->balance+$pay->amount-$request->amount;
        $std->save();
        $pay->amount=$request->amount;
        $pay->billno=$request->billno;
        $pay->date=$request->date;
        $pay->save();
        return redirect()->route('students.show',['std'=>$pay->student_id])->with('message',"Payment Updated sucessfully");
    }

    public function delete(Payment $pay){
        $std=Student::find($pay->student_id);
        $std->balance=$std->balance+$pay->amount;
        $std->save();

        $pay->delete();
        return redirect()->route('students.show',['std'=>$pay->student_id])->with('message',"Payment Deleted sucessfully");

    }

    public function plan(Course $course ){
        return view('course.plan',compact('course'));
    }

    public function planAdd(Request $request){
        $plan=new Plan();
        $plan->amount=$request->amount;
        $plan->day=$request->day;
        $plan->course_id=$request->course_id;
        $plan->save();
        return redirect()->route('payment.plan',['course'=>$request->course_id]);
    }

    public function planEdit(Plan $plan,Request $request){
        $plan->amount=$request->amount;
        $plan->day=$request->day;
        $plan->save();
        return redirect()->route('payment.plan',['course'=>$plan->course_id]);
    }
    public function planDel(Plan $plan){
        $id=$plan->course_id;
        $plan->delete();
        return redirect()->route('payment.plan',['course'=>$id]);
    }
}
