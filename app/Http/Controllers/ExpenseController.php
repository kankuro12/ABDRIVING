<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Request $request){

        if($request->isMethod('post')){
            $exp = new Expense();
            $exp->title = $request->title;
            $exp->amount = $request->amount;
            $exp->date = $request->date;
            $exp->user_id = Auth::user()->id;
            $exp->save();
            return redirect()->back()->with('message',"Expense added successfully");
        }else{
            $expense = Expense::where('user_id',Auth::user()->id)->get();
            return view('expense.index',compact('expense'));
        }
    }
}
