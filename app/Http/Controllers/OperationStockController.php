<?php

namespace App\Http\Controllers;

use App\Models\OperationgStock;
use Illuminate\Validation\Rule;


use Illuminate\Http\Request;

class OperationStockController extends Controller
{
    public function operationStock()
    {
        $OperationgStocks = OperationgStock::orderBy('created_at', 'desc')->paginate(7);
        $sellOperations = OperationgStock::where('operation_type', 'بيع')->get();
        $totalSellPrice = $sellOperations->sum('cost');
        $buyOperations = OperationgStock::where('operation_type', 'شراء')->get();
        $totalbuyPrice = $buyOperations->sum('cost');

        $profit = $totalSellPrice - $totalbuyPrice;

        $loss = $totalbuyPrice - $totalSellPrice;


        return view('OperatingManagement.operatingStock', compact('OperationgStocks', 'totalSellPrice', 'totalbuyPrice', 'profit', 'loss'));
    }
    public function addNewOperationStock(Request $request)
    {
        return view('OperatingManagement.addNewOperationStock');
    }
    public function storeStockOperation(Request $request)
    {
        $validatedData = $request->validate([
            'operation_type' => 'required',

            'operation_document' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
            'client_name' => [
                'required',
                Rule::notIn([null, '', 0]), // Ensure it's not null, empty string, or zero
                'string',
            ],
            'address' => 'required|string',
            'cost' => 'required|numeric|gt:0',
        ], [
            'operation_type.required' => 'حقل نوع العملية مطلوب',
            'operation_document.required' => 'حقل مستند العملية مطلوب',
            'client_name.required' => 'حقل اسم العميل مطلوب',
            'client_name.string' => 'يجب أن يكون اسم العميل نصًا',
            'address.required' => 'حقل العنوان مطلوب',
            'address.string' => 'يجب أن يكون العنوان نصًا',
            'cost.required' => 'حقل التكلفة مطلوب',
            'cost.numeric' => 'يجب أن تكون التكلفة رقمًا',
            'cost.gt' => 'يجب أن تكون التكلفة أكبر من صفر',
        ]);

        $operation = new OperationgStock();
        $operation->operation_type = $request->input('operation_type');
        $operation->operation_document = $request->file('operation_document')
            ->storeAs('/Operating', $request->file('operation_document')->getClientOriginalName());

        $operation->client_name = $request->input('client_name');
        $operation->address = $request->input('address');
        $operation->cost = $request->input('cost');
        $operation->save();

        return redirect()->route('operationStock.index')->with('done', 'Operation created successfully');
    }
    // public function filter(Request $request)
    // {
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');
    //     $OperationgStocks = OperationgStock::wheredate('created_at', '>=', $start_date)->wheredate('created_at', '<=', $end_date)->get();
    //     $sellOperations = $OperationgStocks->where('operation_type', 'بيع');
    //     $totalSellPrice = $sellOperations->sum('cost');
    //     $buyOperations = OperationgStock::where('operation_type', 'شراء')->get();
    //     $totalbuyPrice = $buyOperations->sum('cost');
    //     $profit = $totalSellPrice - $totalbuyPrice;

    //     $loss = $totalbuyPrice - $totalSellPrice;
    //     return view('OperatingManagement.operatingStock', compact('OperationgStocks', 'totalSellPrice', 'totalbuyPrice', 'profit', 'loss'));
    // }

    public function searchOperationStock(Request $request)
    {
        $operation_stock_keyword = $request->input('operation_stock_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $OperationgStocks = OperationgStock::where(function ($query) use ($operation_stock_keyword, $from_date, $to_date) {

            $query->when($operation_stock_keyword, function ($subQuery) use ($operation_stock_keyword) {
                $subQuery->where('client_name', 'like', '%' . $operation_stock_keyword . '%')
                    ->orWhere('operation_type', 'like', '%' . $operation_stock_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;
        $sellOperations = $OperationgStocks->where('operation_type', 'بيع');
        $totalSellPrice = $sellOperations->sum('cost');
    
        // Calculate buy operations total price
        $buyOperations = $OperationgStocks->where('operation_type', 'شراء');
        $totalbuyPrice = $buyOperations->sum('cost');
    
        // Calculate profit and loss
        $profit = $totalSellPrice - $totalbuyPrice;
        $loss = $totalbuyPrice - $totalSellPrice;

        // return view('OperatingManagement.ajax.operatingtable', compact('OperationgStocks'), compact('x'));
        $data_view = view('OperatingManagement.ajax.operatingtable', compact('OperationgStocks','totalSellPrice', 'totalbuyPrice', 'profit', 'loss'), compact('x'))->render();

 
        return response()->json([
            'data_view' => $data_view,
            'totalSellPrice' => $totalSellPrice,
            'totalbuyPrice' => $totalbuyPrice,
          
        ]);

    }

    public function operation_stockpdf()
    {
        $OperationgStocks = OperationgStock::orderBy('created_at', 'desc')->get();
        $sellOperations = OperationgStock::where('operation_type', 'بيع')->get();
        $totalSellPrice = $sellOperations->sum('cost');
        $buyOperations = OperationgStock::where('operation_type', 'شراء')->get();
        $totalbuyPrice = $buyOperations->sum('cost');

        $profit = $totalSellPrice - $totalbuyPrice;

        $loss = $totalbuyPrice - $totalSellPrice;


        return view('OperatingManagement.operation_stockpdf', compact('OperationgStocks', 'totalSellPrice', 'totalbuyPrice', 'profit', 'loss'));
    }

    public function edit_operatingStock($id)
    {
        $OperationgStocks = OperationgStock::findOrFail($id);

        return view('OperatingManagement.editOperationStock', compact('OperationgStocks'));
    }




    public function update_operatingStock(Request $request, $id)
    {
        $OperationgStocks = OperationgStock::findOrFail($id);

        $request->validate([
            'operation_type' => 'required',
            'client_name' => 'required',
            'address' => 'required|string',
            'cost' => 'required|numeric|gt:0',
            'operation_document' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
        ]);



        // Update the fixed supplies
        $OperationgStocks->update([
            'operation_type' => $request->operation_type,
            // 'operation_document' => $request->operation_document,
            'client_name' => $request->client_name,
            'address' => $request->address,
            'cost' => $request->cost,
        ]);


        if ($request->hasFile('operation_document')) {
            \Storage::delete($OperationgStocks->operation_document);
            $OperationgStocks->update([
                'operation_document' => $request->file('operation_document')->storeAs('/Operating', $request->file('operation_document')->getClientOriginalName()),
            ]);
        }

        // Save the changes\

        $OperationgStocks->save();

        return back()->with('done', 'Fixed supplies updated successfully!');



    }


}
