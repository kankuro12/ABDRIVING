<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
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
            $std->time     =$request->time     ;
            $std->startfrom    =$request->startfrom    ;
            $std->Program    =$request->Program    ;
            if($request->hasFile('image')){
                $std->image=$request->image->store('data');
            }
            $std->save();
            return redirect()->route('students.show',['std'=>$std->id])->with('message',"Student Added Sucessfully");

        }else{
            return view('student.add');
        }
    }

    public function index(){
        $list=Student::where('complete',0)->get();
        $old=Student::where('complete',1)->get();
        return view('student.index',compact('list','old'));

    }
    public function show(Student $std,Request $request){
        if($request->getMethod()=="POST"){
           
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
            $std->time     =$request->time     ;
            $std->startfrom    =$request->startfrom    ;
            $std->Program    =$request->Program    ;
            if($request->hasFile('image')){
                $std->image=$request->image->store('data');
            }
            $std->save();
            return redirect()->route('students.show',['std'=>$std->id])->with('message',"Student Added Sucessfully");
        }else{
            return view('student.show',compact('std'));
        }
    }
}
