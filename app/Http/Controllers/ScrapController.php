<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogue;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\rental;
use App\Models\Scrap;

class ScrapController extends Controller
{
    public function scrap()
    {
        $suppliers = Supplier::Has('scraps')->with(['scraps' => function ($query) {
            $query->orderBy('pay', 'asc')->orderBy('created_at', 'desc');
        }])->orderBy('created_at', 'desc')->paginate(3);

        $x = 1;
        $lists = catalogue::where('scrap', 'on')->get();

        $suppliers_scraps_all = Supplier::query()
        ->with('scraps')
        ->Has('scraps')
        ->get();
        $total_scrap = 0;
        foreach ($suppliers_scraps_all as $s) {
            foreach ($s->scraps as $p) {
                    $total_scrap += (int)$p->quantity * $p->price;
            }
        }
        $total_scrap_number = Scrap::sum('quantity');


        // dd($suppliers);
        return view('scrap.scrap', compact('suppliers', 'x', 'lists','total_scrap','total_scrap_number'));
    }

    public function add_scrap()
    {
        $scraps = catalogue::where('scrap', 'on')->get();
        return view('scrap.add_scrap', compact('scraps'));
    }

    public function store_scrap(Request $request)
    {
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' الهاتف فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];
        $validatedData = $request->validate([
            'supplier_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'pro_num' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:suppliers',
        ], $massage);
        $supplier = Supplier::where('name', $request->supplier_name)->first();

        if (!$supplier) {
            $supplier = Supplier::create([
                'name' => $request->supplier_name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
        // $scrap = scrap::where('pro_num', $request->pro_num)->first();
        $scrap = NULL;
        if ($scrap) {
            $scrap->number_of_scrap += $request->number_of_scrap;
            $scrap->save();
        } else {
            $lists = catalogue::where('scrap', 'on')->get();
            $cat_name = '';
            foreach ($lists as $li) {
                if ($li->code == $request->pro_num) {
                    $cat_name = $li->name;
                }
            }
            $scrap = Scrap::create([
                'pro_num' => $request->pro_num,
                'pro_name' => $cat_name,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);
        }
        $supplier->scraps()->attach($scrap->id);

        $supplier->save();
        $scrap->save();
        return back()->with('done', 'تمت الاضافة');

        // Redirect to a success page or perform other actions
        // return redirect()->route('add_scrap')->with('success', 'Data inserted successfully!');

    }

    public function edt_scrap($id, $pid)
    {
        $supplier = Supplier::with('scraps')->findorfail($id);
        $scrap = $supplier->scraps->find($pid);
        $pros = catalogue::where('scrap', 'on')->get();
        return view('scrap.edt_scrap', compact('supplier', 'scrap', 'pros'));
    }

    public function update_scrap(Request $request, $id, $pid)
    {
        $supplier = Supplier::find($id);
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' هذا الحقل فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];

        if ($request->phone == $supplier->phone) {
            $validatedData = $request->validate([
                'supplier_name' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'pro_num' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ], $massage);
        } else {
            $validatedData2 = $request->validate([
                'supplier_name' => 'required',
                'price' => 'required',
                'number_of_scrap' => 'required',
                'pro_num' => 'required',
                'address' => 'required',
                'phone' => 'required|unique:suppliers',
            ], $massage);
        }
        $supplier->update([
            'name' => $request->supplier_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $lists = catalogue::where('scrap', 'on')->get();
        $cat_name = '';
        foreach ($lists as $li) {
            if ($li->code == $request->pro_num) {
                $cat_name = $li->name;
            }
        }
        $scrap = $supplier->scraps()->find($pid);
        $scrap->update([
            'pro_name' => $cat_name,
            'pro_num' => $request->pro_num,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        $supplier->save();
        $scrap->save();
        return back()->with('edtdone', 'تم التعديل');
        // return redirect()->route('update_scrap')->with('success', 'scrap and supplier updated successfully!');
    }

    public function searchscrap(Request $request)
    {
        $scrap_keyword = $request->input('scrap_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $suppliers = Supplier::with([
            'scraps' => function ($query) use ($scrap_keyword, $from_date, $to_date) {
                $query->when($scrap_keyword,function ($subQuery) use ($scrap_keyword) {
                    $subQuery->where(function ($subQuery) use ($scrap_keyword) {
                        $subQuery->where('pro_name', 'like', '%' . $scrap_keyword . '%')
                            ->orWhere('pro_num', $scrap_keyword);
                    });
                });

                $query->when($from_date, function ($subQuery) use ($from_date) {
                    $subQuery->whereDate('scraps.created_at', '>=', $from_date);
                });

                $query->when($to_date, function ($subQuery) use ($to_date) {
                    $subQuery->whereDate('scraps.created_at', '<=', $to_date);
                });

            }
        ])->get();
        $x = 1;
        $total_number_scrap = 0;
        foreach ($suppliers as $supplier) {
            foreach ($supplier->scraps as $scrap) {
                $total_number_scrap += $scrap->quantity;
            }
        }
        $total_scrap_price= 0;
        foreach ($suppliers as $supplier) {
            foreach ($supplier->scraps as $scrap) {
                $total_scrap_price += $scrap->price* $scrap->quantity;
            }
        }
        $data_view = view('scrap.ajax.scrap_search', compact('suppliers', 'total_number_scrap','x','total_scrap_price'))->render();
        // return view('scrap.ajax.scrap_search', compact('suppliers'), compact('x'));
        return response()->json([
            'data_view' => $data_view,
            'total_number_scrap' => $total_number_scrap,
            'total_scrap_price' => $total_scrap_price
        ]);
    }

    public function scrappdf()
    {
        $suppliers = Supplier::with('scraps')->get();
        $x = 1;
        return view('scrap.scrappdf', compact('suppliers'), compact('x'));
    }

    public function collect_scrap($id)
    {
        $scrap = Scrap::find($id);
        $scrap->pay = 1;
        $scrap->update();
        return back()->with('collected', 'تم التحصيل');
    }

}
