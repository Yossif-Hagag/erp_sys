<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScrapOperation;


class ScrapOperationContoller extends Controller
{
    public function operation_scrap()
    {
        $OperationgScrape = ScrapOperation::orderBy('created_at', 'desc')->paginate(7);
        $sellOperations = ScrapOperation::where('operation_type', 'بيع')->get();
        $totalSellPrice = $sellOperations->sum('cost');
        $buyOperations = ScrapOperation::where('operation_type', 'شراء')->get();
        $totalbuyPrice = $buyOperations->sum('cost');

        $profit = $totalSellPrice - $totalbuyPrice;

        $loss = $totalbuyPrice - $totalSellPrice;


        return view('operationgScrape.operatingScrape', compact('OperationgScrape', 'totalSellPrice', 'totalbuyPrice', 'profit', 'loss'));
    }
    public function add_operation_scrap(Request $request)
    {
        return view('operationgScrape.addNewOperation');
    }
    public function store_operation_scrap(Request $request)
    {
        $validatedData = $request->validate([
            'operation_type' => 'required',

            'operation_document' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
            'client_name' => [
                'required',
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

        $operation = new ScrapOperation();
        $operation->operation_type = $request->input('operation_type');
        $operation->operation_document = $request->file('operation_document')
            ->storeAs('/Operating', $request->file('operation_document')->getClientOriginalName());

        $operation->client_name = $request->input('client_name');
        $operation->address = $request->input('address');
        $operation->cost = $request->input('cost');
        $operation->save();

        return back()->with('done', 'Operation created successfully');
    }

    public function edt_operation_scrap($id)
    {
        $operation_scrape = ScrapOperation::findOrFail($id);

        return view('operationgScrape.editOperationscrape ', compact('operation_scrape'));
    }




    public function update_operation_scrap(Request $request, $id)
    {

        $operation_scrape = ScrapOperation::findOrFail($id);

        $request->validate([
            'operation_type' => 'required',
            'client_name' => 'required',
            'address' => 'required|string',
            'cost' => 'required|numeric|gt:0',
            'operation_document' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
        ]);



        // Update the fixed supplies
        $operation_scrape->update([
            'operation_type' => $request->operation_type,
            // 'operation_document' => $request->operation_document,
            'client_name' => $request->client_name,
            'address' => $request->address,
            'cost' => $request->cost,
        ]);


        if ($request->hasFile('operation_document')) {
            \Storage::delete($operation_scrape->operation_document);
            $operation_scrape->update([
                'operation_document' => $request->file('operation_document')->storeAs('/Operating', $request->file('operation_document')->getClientOriginalName()),
            ]);
        }

        // Save the changes\

        $operation_scrape->save();

        return back()->with('done', 'Fixed supplies updated successfully!');



    }

    public function operatingScrapepdfd()
    {
        $OperationgScrape = ScrapOperation::orderBy('created_at', 'desc')->get();
        $sellOperations = ScrapOperation::where('operation_type', 'بيع')->get();
        $totalSellPrice = $sellOperations->sum('cost');
        $buyOperations = ScrapOperation::where('operation_type', 'شراء')->get();
        $totalbuyPrice = $buyOperations->sum('cost');

        $profit = $totalSellPrice - $totalbuyPrice;

        $loss = $totalbuyPrice - $totalSellPrice;


        return view('operationgScrape.operatingScrapepdfd', compact(
            'OperationgScrape',
            'totalSellPrice',
            'totalbuyPrice',
            'profit',
            'loss'
        )
        );
    }

    public function searchOperation_scrap(Request $request)
    {
        $operation_scrap_keyword = $request->input('operation_scrap_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $OperationgScrape = ScrapOperation::where(function ($query) use ($operation_scrap_keyword, $from_date, $to_date) {

            $query->when($operation_scrap_keyword, function ($subQuery) use ($operation_scrap_keyword) {
                $subQuery->where('client_name', 'like', '%' . $operation_scrap_keyword . '%')
                    ->orWhere('operation_type', 'like', '%' . $operation_scrap_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;

        $sellOperations = $OperationgScrape->where('operation_type', 'بيع');
        $totalSellPrice = $sellOperations->sum('cost');
    
        // Calculate buy operations total price
        $buyOperations = $OperationgScrape->where('operation_type', 'شراء');
        $totalbuyPrice = $buyOperations->sum('cost');
    
        // Calculate profit and loss
        $profit = $totalSellPrice - $totalbuyPrice;
        $loss = $totalbuyPrice - $totalSellPrice;

         $data_view = view('operationgScrape.ajax.operatingscraptable', compact('OperationgScrape','totalSellPrice', 'totalbuyPrice', 'profit', 'loss'), compact('x'))->render();;

 
        return response()->json([
            'data_view' => $data_view,
            'totalSellPrice' => $totalSellPrice,
            'totalbuyPrice' => $totalbuyPrice,
          
        ]);
       

    }


}
