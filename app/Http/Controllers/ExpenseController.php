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
            $expense = Expense::where('user_id',Auth::user()->id)->latest()->get();
            return view('expense.index',compact('expense'));
        }
    }

    public function expenseUpdate(Request $request, $id){
            $exp = Expense::where('id',$id)->first();
            $exp->title = $request->title;
            $exp->amount = $request->amount;
            $exp->date = $request->date;
            $exp->user_id = Auth::user()->id;
            $exp->save();
            return redirect()->back()->with('message',"Expense update successfully");
    }

    public function expenseDelete($id){
        $exp = Expense::where('id',$id)->first();
        $exp->delete();
        return redirect()->back()->with('message',"Expense deleted successfully");
    }
}
