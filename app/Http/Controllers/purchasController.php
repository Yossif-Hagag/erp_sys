<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchas;
use App\Models\Supplier;
use App\Models\rental;
use App\Models\catalogue;
use Barryvdh\DomPDF\Facade\Pdf;

class purchasController extends Controller
{
    public function purchas()
    {
        $purchas = Purchas::orderBy('created_at', 'desc')->paginate(7);
        $x = 1;
        $total_purchas = Purchas::query()->sum('total_price');
        $total_number_product = Purchas::query()->sum('num_of_products');
        return view('purchas.purchas', compact('purchas', 'x', 'total_purchas','total_number_product'));
    }

    public function store_purchas(Request $request)
    {
        $massage = [
        ];
        $validatedData = $request->validate([
            'supply_file' => 'required|mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
            'num_of_products' => 'required',
            'total_price' => 'required',
        ], $massage);

        $purchas = Purchas::create([
            'supply_file' => $request->file('supply_file')->storeAs('/purchas', $request->file('supply_file')->getClientOriginalName()),
            'num_of_products' => $request->num_of_products,
            'total_price' => $request->total_price,
        ]);

        $purchas->save();
        return back()->with('done', 'تمت الاضافة');
    }

    public function edt_purchas($id)
    {
        $purchas = purchas::find($id);
        return view('purchas.edt_purchas', compact('purchas'));
    }

    public function update_purchas(Request $request, $id)
    {
        $purchas = purchas::find($id);
        $massage = [
        ];
        $validatedData = $request->validate([
            'supply_file' => 'mimes:pdf,jpeg,png,jpg,gif,svg|max:10000',
            'num_of_products' => 'required',
            'total_price' => 'required',
        ], $massage);


        $purchas->update([
            // 'supply_file' => $request->file('supply_file')->storeAs('/purchas', $request->file('supply_file')->getClientOriginalName()),
            'num_of_products' => $request->num_of_products,
            'total_price' => $request->total_price,
        ]);

        // dd($request->supply_file);
        if ($request->hasFile('supply_file')) {
            Storage::delete($purchas->supply_file);
            $purchas->update([
                'supply_file' => $request->file('supply_file')->storeAs('/purchas', $request->file('supply_file')->getClientOriginalName()),
            ]);
        }
        // dd($purchas);



        $purchas->save();
        return back()->with('edtdone', 'تم التعديل');
    }

    // public function send($id, $sid, Request $request)
    // {
    //     $supplier = Supplier::findOrFail($sid);
    //     $purchas = $supplier->purchas()->find($id);

    //     $massage = [
    //         'required' => 'هذا الحقل مطلوب ',
    //         'unique' => ' الهاتف فريد لا يمكن تكراره',
    //         'max' => 'الهاتف 10 ارقام فقط'
    //     ];
    //     $validatedData = $request->validate([
    //         'Tenant_phone' => 'required',
    //     ], $massage);

    //     if ($purchas->number_of_product == request('number_of_product')) {
    //         $rental = new rental();
    //         $rental->store_name = 'purchas';
    //         $rental->pro_name = $purchas->pro_name;
    //         $rental->pro_num = $purchas->pro_num;
    //         // $rental->pro_photo = request('pro_photo');
    //         $rental->number_of_product = request('number_of_product');
    //         $rental->rent_period = request('rent_period');
    //         $rental->rent_price = request('rent_price');
    //         $rental->Tenant_name = request('Tenant_name');
    //         $rental->Tenant_phone = request('Tenant_phone');
    //         $rental->Tenant_address = request('Tenant_address');
    //         $rental->supplier_id = $supplier->id;
    //         $rental->purchas_id = $purchas->id;
    //         $rental->purchas_sup_price = $purchas->price;
    //         $purchas->number_of_product = 0;

    //         $rental->save();
    //         $purchas->save();
    //         $purchas->delete();
    //         return back()->with('done', "تمت عملية التأجير");

    //     } elseif ($purchas->number_of_product > request('number_of_product')) {
    //         $rental = new rental();
    //         $rental->store_name = 'purchas';
    //         $rental->pro_name = $purchas->pro_name;
    //         $rental->pro_num = $purchas->pro_num;
    //         // $rental->pro_photo = request('pro_photo');
    //         $rental->number_of_product = request('number_of_product');
    //         $rental->rent_period = request('rent_period');
    //         $rental->rent_price = request('rent_price');
    //         $rental->Tenant_name = request('Tenant_name');
    //         $rental->Tenant_phone = request('Tenant_phone');
    //         $rental->Tenant_address = request('Tenant_address');
    //         $rental->supplier_id = $supplier->id;
    //         $rental->purchas_id = $purchas->id;
    //         $rental->purchas_sup_price = $purchas->price;
    //         $purchas->number_of_product -= request('number_of_product');

    //         $rental->save();
    //         $purchas->save();
    //         return back()->with('done', "تمت عملية التأجير");

    //     } elseif ($purchas->number_of_product < request('number_of_product')) {
    //         return back()->with('error', "خطأ ! الكمية المراد تأجيرها اكبر من المتاح");

    //     }

    // }
    // public function send_purchas_stock(Request $request, $id, $pid)
    // {
    //     $purchas = Purchas::findOrFail($pid);
    //     // dd($purchas);
    //     if ($purchas->number_of_product == (int) request('number_of_product')) {
    //         // Create a new Product instance and set its attributes
    //         $product = new Product();
    //         $product->pro_name = $purchas->pro_name;
    //         $product->pro_num = $purchas->pro_num;
    //         $product->price = $purchas->price;
    //         $product->number_of_product = $purchas->number_of_product;
    //         // Save the product to the products table
    //         $product->save();
    //         // Find the Supplier
    //         $supplier = Supplier::find($id);
    //         $supplier->products()->attach($product->id);
    //         $purchas->number_of_product = 0;
    //         $purchas->delete();

    //         return back()->with('done', "تم التخزين");

    //     } elseif ($purchas->number_of_product > (int) request('number_of_product')) {
    //         $product = new Product();
    //         $product->pro_name = $purchas->pro_name;
    //         $product->pro_num = $purchas->pro_num;
    //         $product->price = $purchas->price;
    //         $product->number_of_product = request('number_of_product');
    //         $product->save();

    //         $supplier = Supplier::find($id);
    //         $supplier->products()->attach($product->id);

    //         $purchas->number_of_product -= request('number_of_product');
    //         $purchas->save();

    //         return back()->with('done', "تم التخزين");
    //     } elseif ($purchas->number_of_product < request('number_of_product')) {
    //         return back()->with('error', 'خطأ ! الكمية المراد تخزينها اكبر من المتاح');
    //     }
    // }

    public function purchas_search(Request $request)
    {
        $purchas_search = $request->input('purchas_search');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // $allData = rental::where('pro_name', 'like', '%' . $purchas_search . '%')->get();
        $purchas = Purchas::where(function ($query) use ($purchas_search, $from_date, $to_date) {

            $query->when($purchas_search, function ($subQuery) use ($purchas_search) {
                $subQuery->where('total_price', 'like', '%' . $purchas_search . '%')
                    ->orWhere('num_of_products', 'like', '%' . $purchas_search . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;

        $total_price = $purchas->sum('total_price');
        $total_number_product = $purchas->sum('num_of_products');
 
        $data_view =  view('purchas.ajax.purchastable', compact('purchas','total_price','total_number_product'), compact('x'))->render();
        return response()->json([
            'data_view' => $data_view,
            'total_price' => $total_price,
            'total_number_product' => $total_number_product,
          
        ]);
    }

    public function purchaspdf()
    {
        $purchas = Purchas::orderBy('created_at', 'desc')->get();
        $x = 1;
        return view('purchas.purchaspdf', compact('purchas'), compact('x'));
    }
}

