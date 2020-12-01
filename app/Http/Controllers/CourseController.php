<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
    public function index(){
        return view('course.index',['list'=>Course::all()]);
    }

    public function add(Request $request){
        $request->validate([
                'name'=>'required',
                'rate'=>'required|integer'
            ]);
        $c=new Course();
        $c->name=$request->name;
        $c->rate=$request->rate;
        $c->save();
        return redirect()->route('courses')->with('message',"New Course Added Sucessfylly");
    }
    public function edit(Request $request,Course $c){
        $request->validate([
                'name'=>'required',
                'rate'=>'required|integer'
            ]);
        
        $c->name=$request->name;
        $c->rate=$request->rate;
        $c->save();
        return redirect()->route('courses')->with('message',$c->name . " Course Updated Sucessfylly");
    }
    public function delete(Course $c){
        $c->delete();
        return redirect()->route('courses')->with('message',"New Course Deleted Sucessfylly");

    }
}
