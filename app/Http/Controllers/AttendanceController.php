<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Slot;
use App\Models\Attendance;


class AttendanceController extends Controller
{
    //

    public function index(){
        return view('attendance.index');
    }

    public function save(Request $request){
        foreach($request->student_id as $sid){
            $attendance=Attendance::where('student_id',$sid)->where('date',$request->date)->first();
            
            if($attendance==null){
                $attendance=new Attendance();
                $attendance->student_id=$sid;
                $attendance->date=$request->date;
            }
            $attendance->attend=$request->input('attend_'.$sid)??0;
            $attendance->save();
            
        }
        echo "Attendance Sucessfully Saved";
        // return redirect()->back();
    }

    public function  get(Request $request){
        
        // dd($request);
        // dd($request);
        $std=Student::where('complete','0');
        if($request->has('program')){
            if($request->program!=-11){

                $std=$std->where('Program',$request->program);
            }
        }
        if($request->has('time')){
            if($request->time!=-11){
                $std=$std->where('time',$request->slot);
            }
        }

        $at_arr=[];
        if($request->has('date')){
            if($request->date!=null){
                $d=$request->date;
                $stds=$std->select('name','id')->get();
                foreach($stds as $s){
                    $attendance=Attendance::where('student_id',$s->id)->where('date',$request->date)->first();
                    if($attendance==null){
                        $attendance=new Attendance();
                        $attendance->student_id=$s->id;
                        $attendance->name=$s->name;
                        $attendance->attend=0;
                        array_push($at_arr,$attendance);
                    }else{
                        $attendance->name=$s->name;
                        array_push($at_arr,$attendance);
                    }
                }
                return view('attendance.list',compact('at_arr','d'));
            }else{
            echo 'Please Select A Date';
                
            }
        }else{
            echo 'Please Select A Date';
        }
        
    }
}
