<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use App\Models\Custody;
use App\Models\Expense;
use OwenIt\Auditing\Models\Audit;

class CustodyController extends Controller
{
    public function custody()
    {
        $x=1;
        $custody_test = Custody::first();
        $expenses = Expense::orderBy('created_at', 'DESC')->paginate(8);
        $custody = (!$custody_test) ? "0" : $custody_test->value ;
        return view('custody.custody', compact('x','custody','expenses'));
    }

    public function add_custody(Request $request)
    {
        $request->validate(['value' => 'required|numeric']);
        $custody_test = Custody::first();
        // dd($request->input('value'));
        if($request->input('value') >= 0){
            if (!$custody_test) {
                Custody::create(['value' => $request->value]);
            } else {
                $custody_test->update(['value' => $custody_test->value + $request->value]);
            }
            return back()->with('done', 'تمت الاضافة');
        }else{
            return back()->with('error', 'القيمة المضافة للعهدة أقل من الصفر  !!');
        }
    }

    public function custodypdf(){
        $expenses = Expense::all();
        $x = 1;
        return view('custody.custodypdf', compact('expenses'),compact('x'));
    }

    public function reset_custody(){
        $custody_test = Custody::first();
        $custody_test->update(['value' => 0 ]);
        return back()->with('done', 'تمت التهيئة');
    }

}
