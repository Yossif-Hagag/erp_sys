<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\rental;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Po;
use App\Models\purchas;
use App\Models\User;
use App\Models\Scrap;
use App\Models\Worker;
use OwenIt\Auditing\Models\Audit;

class PoController extends Controller
{
    //
    public function po()
    {
        $pos = Po::where('status', 0)->orderBy('collection_date', 'ASC')->paginate(8);
        $agents = Agent::all();
        $x = 1;
        
        // today()->setTestNow("2024-01-29");
        return view('po.po', compact('pos', 'x','agents'));
    }

    public function add_po()
    {
        $agents = Agent::all();
        return view('po.add_po',compact('agents'));
    }
    public function edt_po($id)
    {
        $po = Po::find($id);
        $agents = Agent::all();
        return view('po.edt_po', compact('po','agents'));
    }

    public function store_po(Request $request)
    {
        $massage = [
        ];
        $validatedData = $request->validate([
            'snum' => ['required', 'string', 'max:500', 'unique:' . Po::class],
            'from' => ['required'],
            'po_value' => ['required', 'numeric'],
            'collection_date' => ['required', 'after_or_equal:' . date(DATE_ATOM)],
            'po_file' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
            'sale_present_file' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
        ], $massage);

        $po = Po::create([
            'snum' => $request->snum,
            'from' => $request->from,
            'po_value' => $request->po_value,
            'collection_date' => $request->collection_date,
            'po_file' => $request->file('po_file')->storeAs('/po', $request->file('po_file')->getClientOriginalName()),
            'sale_present_file' => $request->file('sale_present_file')->storeAs('/sale_presents', $request->file('sale_present_file')->getClientOriginalName()),
        ]);

        $po->save();
        return back()->with('done', 'تمت الاضافة');
    }
    public function update_po($id, Request $request)
    {
        $po = Po::find($id);
        $massage = [
        ];
        if ($po->snum == $request->snum) {
            $request->validate([
                'snum' => ['required', 'string', 'max:500'],
            ], $massage);
        } else {
            $request->validate([
                'snum' => ['required', 'string', 'max:500', 'unique:' . Po::class],
            ], $massage);
        }

        $request->validate([
            'from' => ['required', 'string', 'max:255'],
            'po_value' => ['required', 'numeric'],
            'collection_date' => ['required', 'after_or_equal:' . date(DATE_ATOM)],
            'po_file' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
            'sale_present_file' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
        ], $massage);

        $po->update([
            'snum' => $request->snum,
            'from' => $request->from,
            'po_value' => $request->po_value,
            'collection_date' => $request->collection_date,
        ]);

        if ($request->hasFile('po_file')) {
            Storage::delete($po->po_file);
            $po->update([
                'po_file' => $request->file('po_file')->storeAs('/po', $request->file('po_file')->getClientOriginalName()),
            ]);
        }
        if ($request->hasFile('sale_present_file')) {
            Storage::delete($po->sale_present_file);
            $po->update([
                'sale_present_file' => $request->file('sale_present_file')->storeAs('/sale_presents', $request->file('sale_present_file')->getClientOriginalName()),
            ]);
        }

        $po->update();
        return back()->with('edtdone', 'تم التعديل');
    }

    public function collect_po($id)
    {
        $po = Po::find($id);
        $po->status = 1;
        $po->update();
        return back()->with('collected', 'تم التحصيل');
    }

    public function searchPo(Request $request)
    {
        $po_keyword = $request->input('po_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $pos = Po::where(function ($query) use ($po_keyword, $from_date, $to_date) {

            $query->when($po_keyword, function ($subQuery) use ($po_keyword) {
                $subQuery->where('snum', 'like', '%' . $po_keyword . '%')
                    ->orWhere('po_value', 'like', '%' . $po_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->where('status', 0)->orderBy('collection_date', 'ASC')->get();

        $agents = Agent::all();
        $x = 1;
        return view('po.ajax.search', compact('pos', 'x','agents'));

    }

    public function popdf()
    {
        $pos = Po::where('status', 0)->orderBy('collection_date', 'ASC')->get();
        $agents = Agent::all();
        $x = 1;
        return view('po.popdf', compact('pos', 'x','agents'));
    }

    public function po_collected()
    {
        $pos = Po::where('status', 1)->orderBy('collection_date', 'ASC')->paginate(8);
        $agents = Agent::all();
        $x = 1;
        // today()->setTestNow("2024-01-29");
        return view('po.po_collected', compact('pos', 'x','agents'));
    }
    public function searchPo_collection(Request $request)
    {
        $po_collection_keyword = $request->input('po_collection_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $pos = Po::where(function ($query) use ($po_collection_keyword, $from_date, $to_date) {

            $query->when($po_collection_keyword, function ($subQuery) use ($po_collection_keyword) {
                $subQuery->where('snum', 'like', '%' . $po_collection_keyword . '%')
                    ->orWhere('po_value', 'like', '%' . $po_collection_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });


        })->where('status', 1)->orderBy('collection_date', 'ASC')->paginate(8);

        $agents = Agent::all();
        $x = 1;
        return view('po.ajax.search_po_collection', compact('pos', 'x','agents'));

    }

    public function po_collection_pdf()
    {
        $pos = Po::where('status', 1)->orderBy('collection_date', 'ASC')->get();
        $agents = Agent::all();
        $x = 1;
        return view('po.po_collection_pdf', compact('pos', 'x','agents'));
    }

}
