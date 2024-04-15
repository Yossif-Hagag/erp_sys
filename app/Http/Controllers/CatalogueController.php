<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogue;

class CatalogueController extends Controller
{
    public function catalogue()
    {
        $catalogues = catalogue::orderBy('scrap', 'ASC')->orderBy('created_at', 'DESC')->paginate(8);
        $x = 1;
        return view('catalogue.catalogue', compact('catalogues', 'x'));
    }

    public function add_catalogue()
    {
        return view('catalogue.add_catalogue');
    }
    public function edt_catalogue($id)
    {
        $catalogue = catalogue::find($id);
        return view('catalogue.edt_catalogue', compact('catalogue'));
    }

    public function store_catalogue(Request $request)
    {
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' هذا الحقل فريد لا يمكن تكراره'
        ];
        $validatedData = $request->validate([
            'name' => 'required|unique:catalogues',
            'code' => 'required|unique:catalogues',

        ], $massage);
        // dd($request->scrap);
        $scrap = '';
        if ($request->scrap == NULL) {
            $scrap = '0';
        } else {
            $scrap = $request->scrap;
        }
        $catalogue = catalogue::create([
            'name' => $request->name,
            'suppliers' => $request->suppliers,
            'code' => $request->code,
            'scrap' => $scrap,
        ]);

        $catalogue->save();
        return back()->with('done', 'تمت الاضافة');

    }

    public function update_catalogue(Request $request, $id)
    {
        $catalogue = catalogue::find($id);
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' هذا الحقل فريد لا يمكن تكراره'
        ];
        if ($catalogue->code == $request->code && $catalogue->name != $request->name) {
            $validatedData = $request->validate([
                'code' => 'required',
                'name' => 'required|unique:catalogues',

            ], $massage);
        } else if ($catalogue->name == $request->name && $catalogue->code != $request->code) {
            $validatedData = $request->validate([
                'code' => 'required|unique:catalogues',
                'name' => 'required',

            ], $massage);
        } else if ($catalogue->code == $request->code && $catalogue->name == $request->name) {
            $validatedData = $request->validate([
                'name' => 'required',
                'code' => 'required',

            ], $massage);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|unique:catalogues',
                'code' => 'required|unique:catalogues',

            ], $massage);
        }

        $scrap = '';
        if ($request->scrap == NULL) {
            $scrap = '0';
        } else {
            $scrap = $request->scrap;
        }

        $catalogue->update([
            'code' => $request->code,
            'name' => $request->name,
            'suppliers' => $request->suppliers,
            'scrap' => $scrap,
        ]);

        $catalogue->save();
        return back()->with('edtdone', 'تم التعديل');
        // return redirect()->route('update_product')->with('success', 'Product and supplier updated successfully!');
    }

    public function searchCatalogue(Request $request)
    {
        $catalogue_keyword = $request->input('catalogue_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $catalogues = catalogue::where(function ($query) use ($catalogue_keyword, $from_date, $to_date) {

            $query->when($catalogue_keyword, function ($subQuery) use ($catalogue_keyword) {
                $subQuery->where('code', $catalogue_keyword)
                ->orWhere('name', 'like', '%' . $catalogue_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('scrap', 'ASC')->orderBy('created_at', 'DESC')->get();
        $x = 1;
        return view('catalogue.ajax.cataloguesearch', compact('catalogues', 'x'));
    }
    public function cataloguepdf()
    {
        $catalogues = catalogue::orderBy('scrap', 'ASC')->orderBy('created_at', 'DESC')->get();
        $x = 1;
        return view('catalogue.cataloguepdf', compact('catalogues'), compact('x'));
    }

}
