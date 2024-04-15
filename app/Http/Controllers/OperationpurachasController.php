<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operationgpurchas;
use Illuminate\Contracts\Validation\Rule;


class OperationpurachasController extends Controller
{
    public function operation_purchas()
    {
        $OperationgPurchas = Operationgpurchas::orderBy('created_at', 'desc')->paginate('7');
        // $sellOperations = Operationgpurchas::where('operation_type', 'بيع')->get();
        // $totalSellPrice = $sellOperations->sum('cost');
        // $buyOperations = Operationgpurchas::where('operation_type', 'شراء')->get();
        $totalsellPrice = $OperationgPurchas->sum('cost');

        // $profit = $totalSellPrice - $totalbuyPrice;

        // $loss = $totalbuyPrice - $totalSellPrice;




        return view(
            'OperatingPurchas.operatingPurchas',
            compact(
                'OperationgPurchas',
                'totalsellPrice',
                 
            )
        );
    }
    public function add_operation_purchas(Request $request)
    {
        return view('OperatingPurchas.addNewOperation');
    }
    public function store_operation_purchas(Request $request)
    {
        $validatedData = $request->validate([
            // 'operation_type' => 'required',
            'operation_document' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
            'client_name' => 'required','string',
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

        $operation = new Operationgpurchas();
        $operation->operation_type = "شراء";
        $operation->operation_document = $request->file('operation_document')
            ->storeAs('/Operating', $request->file('operation_document')->getClientOriginalName());
        $operation->client_name = $request->input('client_name');
        $operation->address = $request->input('address');
        $operation->cost = $request->input('cost');
        $operation->save();

        return back()->with('done', 'Operation created successfully');
    }

    public function edt_operation_purchas($id)
    {
        $Operationgpurchas = Operationgpurchas::findOrFail($id);
        return view('OperatingPurchas.editOperationPurchas', compact('Operationgpurchas'));
    }

    public function update_operation_purchas(Request $request, $id)
    {
        $Operationgpurchas = Operationgpurchas::findOrFail($id);

        $request->validate([
            // 'operation_type' => 'required',
            'client_name' => 'required',
            'address' => 'required|string',
            'cost' => 'required|numeric|gt:0',
            'operation_document' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
        ]);



        // Update the fixed supplies
        $Operationgpurchas->update([
            'operation_type' => "شراء",
            // 'operation_document' => $request->operation_document,
            'client_name' => $request->client_name,
            'address' => $request->address,
            'cost' => $request->cost,
        ]);


        if ($request->hasFile('operation_document')) {
            \Storage::delete($Operationgpurchas->operation_document);
            $Operationgpurchas->update([
                'operation_document' => $request->file('operation_document')->storeAs('/Operating', $request->file('operation_document')->getClientOriginalName()),
            ]);
        }

        // Save the changes\

        $Operationgpurchas->save();

        return back()->with('done', 'Fixed supplies updated successfully!');


    }


    public function operation_purchas_pdf()
    {
        $OperationgPurchas = Operationgpurchas::orderBy('created_at', 'desc')->get();
        $sellOperations = Operationgpurchas::where('operation_type', 'بيع')->get();
        $totalSellPrice = $sellOperations->sum('cost');
        $buyOperations = Operationgpurchas::where('operation_type', 'شراء')->get();
        $totalbuyPrice = $buyOperations->sum('cost');

        $profit = $totalSellPrice - $totalbuyPrice;

        $loss = $totalbuyPrice - $totalSellPrice;




        return view(
            'OperatingPurchas.operation_purchas_pdf',
            compact(
                'OperationgPurchas',
                'totalSellPrice',
                'totalbuyPrice',
                'profit',
                'loss'
            )
        );
    }


    public function searchOperation_purchas(Request $request)
    {
        $operation_purchas_keyword = $request->input('operation_purchas_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $OperationgPurchas = Operationgpurchas::where(function ($query) use ($operation_purchas_keyword, $from_date, $to_date) {

            $query->when($operation_purchas_keyword, function ($subQuery) use ($operation_purchas_keyword) {
                $subQuery->where('client_name', 'like', '%' . $operation_purchas_keyword . '%')
                    ->orWhere('cost', 'like', '%' . $operation_purchas_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;
       
        $totalSellPrice = $OperationgPurchas->sum('cost');
    
        // Calculate profit and loss
   

        // return view('OperatingManagement.ajax.operatingtable', compact('OperationgStocks'), compact('x'));
        $data_view = view('OperatingPurchas.ajax.operatingPurchastable', compact('OperationgPurchas','totalSellPrice'), compact('x'))->render();

 
        return response()->json([
            'data_view' => $data_view,
            'totalSellPrice' => $totalSellPrice,
            
          
        ]);

    }

    public function delete_operation_purchas($id){
        $Operationgpurchas = Operationgpurchas::findOrFail($id);
        $Operationgpurchas->delete();
        return back()->with('done', 'تم الحذف');
    }


}
