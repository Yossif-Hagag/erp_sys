<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchas;
use App\Models\Quotation;
use App\Models\Operationgpurchas;
use App\Models\Supplier;
use App\Models\rental;
use App\Models\catalogue;

class QuotationsController extends Controller
{
    public function quotations()
    {
        $quotations = Quotation::orderBy('price', 'desc')->orderBy('created_at', 'desc')->paginate(7);
        $x = 1;
        $total_price = Quotation::query()->get()->map(fn(Quotation $quotation) => $quotation->price)->sum();
        return view('quotations.quotations', compact('quotations', 'x','total_price'));
    }

    public function store_quotation(Request $request)
    {
        $massage = [
        ];
        $validatedData = $request->validate([
            'client' => ['required', 'string'],
            'address' => ['required', 'string'],
            'price' => ['nullable', 'numeric', 'gt:0'],
            'quotation_file' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
        ], $massage);

        $quotation = Quotation::create([
            'client' => $request->client,
            'address' => $request->address,
            'price' => $request->price,
            'quotation_file' => $request->file('quotation_file')->storeAs('/quotations', $request->file('quotation_file')->getClientOriginalName()),
        ]);

        $quotation->save();
        return back()->with('done', 'تمت الاضافة');
    }

    public function update_quotation($id, Request $request)
    {
        $quotation = Quotation::find($id);
        $massage = [
        ];
        $request->validate([
            'client' => ['required', 'string'],
            'address' => ['required', 'string'],
            'price' => ['nullable', 'numeric', 'gt:0'],
            'quotation_file' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
        ], $massage);

        $quotation->update([
            'client' => $request->client,
            'address' => $request->address,
            'price' => $request->price,
        ]);

        if ($request->hasFile('quotation_file')) {
            \Storage::delete($quotation->quotation_file);
            $quotation->update([
                'quotation_file' => $request->file('quotation_file')->storeAs('/quotations', $request->file('quotation_file')->getClientOriginalName()),
            ]);
        }

        $quotation->update();
        return back()->with('edtdone', 'تم التعديل');
    }

    public function pricing($id , Request $request)
    {
        $request->validate([
            'price' => ['numeric', 'gt:0'],
        ]);
        $quotation = Quotation::find($id);
        $request->validate(['price_add' => ['required','numeric', 'gt:0'],]);
        $quotation->price = $request->price_add;

        $quotation->save();
        return back()->with('priced', 'تم التسعير');
    }

    public function agree($id , Request $request)
    {
        $request->validate([
            'final_price' => ['numeric', 'gt:0'],
        ]);

        $quotation = Quotation::find($id);

        $operation = new Operationgpurchas();
        $operation->operation_type = "شراء";
        $operation->client_name = $quotation->client;
        $operation->address = $quotation->address;
        $operation->code = $quotation->id;
        $operation->cost = $request->final_price;
        $operation->start_price = $quotation->price;
        $file_path = '/Operating'.'/'. substr($quotation->quotation_file, 11);
        \Storage::disk('public')->copy($quotation->quotation_file,$file_path);
        $operation->operation_document = $file_path;
        $operation->save();

        $quotation->delete();

        return back()->with('agree', 'تمت الموافقة');
    }
    public function quotationpdf()
    {
        $quotations = Quotation::orderBy('price', 'desc')->orderBy('created_at', 'desc')->get();
        $x = 1;
        return view('quotations.quotationpdf', compact('quotations', 'x'));
    }

    public function quotations_search(Request $request)
    {
        $quotation_keyword = $request->input('quotation_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // $allData = rental::where('pro_name', 'like', '%' . $quotation_keyword . '%')->get();
        $quotations = Quotation::where(function ($query) use ($quotation_keyword, $from_date, $to_date) {

            $query->when($quotation_keyword, function ($subQuery) use ($quotation_keyword) {
                $subQuery->where('client', $quotation_keyword)
                    ->orWhere('address', 'like', '%' . $quotation_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('price', 'desc')->orderBy('created_at', 'desc')->get();
        $x = 1;
        $total_price = $quotations->sum('price');
        $data_view = view('quotations.ajax.search', compact('quotations', 'x','total_price'))->render();

        return response()->json([
            'data_view'=>$data_view,
            'total_price'=>$total_price,
        ]);

    }

    public function delete_quotation($id){
        $quotation = Quotation::find($id);
        $quotation->delete();
        return back()->with('done', 'تم الحذف');
    }

}
