<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
    public function add(Request $request){
        if($request->getMethod()=="POST"){
            $std=new Student();
            $std->name=$request->name;
            $std->fname      =$request->fname      ;
            $std->mname      =$request->mname      ;
            $std->paddress   =$request->paddress   ;
            $std->caddress   =$request->caddress   ;
            $std->phone      =$request->phone      ;
            $std->email      =$request->email      ;
            $std->bloodgroup =$request->bloodgroup ;
            $std->Program    =$request->Program    ;
            $std->dob    =$request->dob    ;
            $std->age    =$request->age    ;
            $std->citino    =$request->citino    ;
            $std->gender    =$request->gender    ;
            $std->mstatus    =$request->mstatus    ;
            $std->ftype    =$request->ftype    ;
            $std->education    =$request->education    ;
            $std->occupation    =$request->occupation    ;
            $std->fmember    =$request->fmember    ;
            $std->dealamount    =$request->dealamount    ;
            $std->balance    =$request->dealamount    ;
            $std->time     =$request->time??"";
            $std->startfrom    =$request->startfrom    ;
            $std->Program    =$request->Program??""    ;
            $std->course_id=$request->course_id;
            $std->slot_id=$request->slot_id;
            $std->nextpayattendance=1;
            if($request->hasFile('image')){
                $std->image=$request->image->store('data');
            }
            $std->save();

            $pay=new Payment();
            $pay->amount=$request->amount;
            $pay->date=$request->date;
            $pay->billno=$request->billno;
            $pay->student_id=$std->id;
            $pay->currentattendance=0;
            $pay->nextpayattendance=1;
            $pay->user_id=Auth::user()->id;
            $pay->netpaydate = $request->nextpaydate;
            $pay->save();

            $std->balance=$std->balance-$pay->amount;
            $std->save();

            return redirect()->route('students');
            // return redirect()->route('students.show',['std'=>$std->id])->with('message',"Student Added Sucessfully");

        }else{
            return view('student.add');
        }
    }

    public function index(){
            $list=Student::where('complete',0)->get();
            $old=Student::where('complete',1)->get();
            return view('student.index',['list'=>$list,'old'=>$old]);
    }

    public function changeTimeSheet(Request $request, $id){
        if($request->isMethod('post')){

        }else{
            $std = Student::find($id);
            return view('student.changetimesheet',compact('std'));
        }
    }


    public function show(Student $std,Request $request){
        if($request->getMethod()=="POST"){
            // dd($request->all());
            $std->name=$request->name;
            $std->fname      =$request->fname      ;
            $std->mname      =$request->mname      ;
            $std->paddress   = $request->paddress   ;
            $std->caddress   =$request->caddress   ;
            $std->phone      =$request->phone      ;
            $std->email      =$request->email      ;
            $std->bloodgroup =$request->bloodgroup ;
            $std->Program    =$request->Program    ;
            $std->dob    =$request->dob    ;
            $std->age    =$request->age    ;
            $std->citino    =$request->citino    ;
            $std->gender    =$request->gender    ;
            $std->mstatus    =$request->mstatus    ;
            $std->ftype    =$request->ftype    ;
            $std->education    =$request->education    ;
            $std->occupation    =$request->occupation    ;
            $std->fmember    =$request->fmember    ;
            $std->dealamount    =$request->dealamount    ;
            $payment = Payment::where('student_id',$std->id)->sum('amount');
            // dd($payment);
            $std->balance=$std->dealamount-$payment;
            // $std->balance    =$request->dealamount    ;
            $std->time     =$request->time??""     ;
            $std->startfrom    =$request->startfrom    ;
            $std->Program    =$request->Program  ??""  ;
            $std->course_id=$request->course_id;
            $std->slot_id=$request->slot_id;

            if($request->hasFile('image')){
                $std->image=$request->image->store('data');
            }
            $std->save();

            $std->save();
            return redirect()->route('students.show',['std'=>$std->id])->with('message',"Student Added Sucessfully");
        }else{
            return view('student.show',compact('std'));
        }
    }

    public function ledger(Student $std){
        return view('student.ledger',compact('std'));
    }
    public function attendance(Student $std){
        return view('student.attendance',compact('std'));
    }

    public function passout(Student $std){
        $std->complete=1;
        $std->save();

        return redirect()->back()->with('message','Student Marked As Passout');
    }

    public function passoutCancel(Student $std){
        $std->complete=0;
        $std->save();

        return redirect()->back()->with('message','Student Marked as passout cancle');
    }



    public function getStudentByCustomeDate(Request $request){
        $year=$request->year;
        $month=$request->month;
        $dates=[];
        for ($i=1; $i < 33; $i++) {
            array_push($dates,$year."-".($month<10?"0".$month:$month)."-".($i<10?"0".$i:$i));
        }
        // dd($dates);
        $list = Student::whereIn('startfrom',$dates)->where('complete',0)->get();
        $old = Student::whereIn('startfrom',$dates)->where('complete',1)->get();
        return view('student.index',['list'=>$list,'old'=>$old]);
    }
}
