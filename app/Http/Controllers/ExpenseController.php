<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use App\Models\Custody;
use App\Models\Expense;
use OwenIt\Auditing\Models\Audit;

class ExpenseController extends Controller
{
    public function add_expense(Request $request)
    {
        $request->validate(['amount' => 'required|numeric', 'reason' => 'required|string', 'recipient' => 'required|string']);
        $custody_test = Custody::first();
        if ($request->amount > 0) {
            if (!$custody_test) {
                return back()->with('error', 'العهدة فارغة !');
            } else if ($custody_test->value < $request->amount) {
                return back()->with('error', 'المبلغ أكبر من العهدة !');
            } else {
                Expense::create(['amount' => $request->amount, 'reason' => $request->reason, 'recipient' => $request->recipient]);
                $custody_test->update(['value' => $custody_test->value - $request->amount]);
                return back()->with('done', 'تمت الاضافة');
            }
        } else {
            return back()->with('error', 'القيمة المضافة أقل من او تساوي الصفر  !!');
        }
    }

    public function edt_expense(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric', 'reason' => 'required|string', 'recipient' => 'required|string']);
        $expense = Expense::find($id);
        $custody_test = Custody::first();
        if ($request->amount > 0) {
            if (!$custody_test) {
                return back()->with('error', 'العهدة فارغة !');
            } else if ($custody_test->value < $request->amount) {
                return back()->with('error', 'المبلغ أكبر من العهدة !');
            } else {
                $custody_test->update(['value' => ($custody_test->value + $expense->amount) - $request->amount]);
                $expense->update(['amount' => $request->amount, 'reason' => $request->reason, 'recipient' => $request->recipient]);
                return back()->with('done', 'تم التعديل');
            }
        } else {
            return back()->with('error', 'القيمة المضافة أقل من او تساوي الصفر  !!');
        }
    }
    public function searchExpenses(Request $request)
    {
        $expenses_keyword = $request->input('expenses_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // $allData = rental::where('pro_name', 'like', '%' . $expenses_keyword . '%')->get();
        $expenses = Expense::where(function ($query) use ($expenses_keyword, $from_date, $to_date) {

            $query->when($expenses_keyword, function ($subQuery) use ($expenses_keyword) {
                $subQuery->where('amount', 'like', '%' . $expenses_keyword . '%')
                    ->orWhere('recipient', 'like', '%' . $expenses_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;
        return view('custody.ajax.search', compact('expenses', 'x'));

    }

}
