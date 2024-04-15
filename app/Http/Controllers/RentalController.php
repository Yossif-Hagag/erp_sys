<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rental;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\purchas;
use App\Models\catalogue;
use Barryvdh\DomPDF\Facade\Pdf;

class RentalController extends Controller
{
    public function rental()
    {
        $stock = rental::all()->where('store_name', 'stock');
        $purchas = rental::all()->where('store_name', 'purchas');
        $allData = rental::orderBy('created_at', 'desc')->paginate(5);
        $lists = catalogue::where('scrap', '0')->get();
        $x = 1;


        $rentals_all = rental::query()->get();

        $sum_rent_price = $rentals_all
        ->map(fn(rental $rental) => $rental->number_of_product * ($rental->rent_price) * $rental->rent_period)
        ->sum();

    $total_supply_pro_rent = $rentals_all
        ->map(fn(rental $rental) => $rental->number_of_product * ($rental->pro_sup_price))
        ->sum();
    $total_supply_purchas_rent = $rentals_all
        ->map(fn(rental $rental) => $rental->number_of_product * ($rental->purchas_sup_price))
        ->sum();

    $total_supply_rent = $total_supply_pro_rent + $total_supply_purchas_rent;
    $total_number_rent = rental::sum('number_of_product');


    return view('rental.rental', ['stock' => $stock, 'purchas' => $purchas, 'allData' => $allData,
     'lists' => $lists, 'x' => $x,'total_supply_rent' => $total_supply_rent,'sum_rent_price' => $sum_rent_price],compact('total_number_rent'));
    }

    public function edt_rental($id)
    {
        $rentals = rental::findOrFail($id);
        $pros = catalogue::where('scrap', '0')->get();
        return view('rental.edt_rental', ['rentals' => $rentals, 'pros' => $pros]);
    }

    public function update_rental(Request $request, $id)
    {
        $rental = rental::find($id);
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' الهاتف فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];

        if ($request->Tenant_phone == $rental->Tenant_phone) {
            $validatedData = $request->validate([
                'pro_num' => 'required',
                'rent_price' => 'required',
                'rent_period' => 'required',
                'Tenant_name' => 'required',
                'number_of_product' => 'required',
                'Tenant_address' => 'required',
                'Tenant_phone' => 'required',
            ], $massage);
        } else {
            $validatedData2 = $request->validate([
                'pro_num' => 'required',
                'rent_price' => 'required',
                'rent_period' => 'required',
                'Tenant_name' => 'required',
                'number_of_product' => 'required',
                'Tenant_address' => 'required',
                'Tenant_phone' => 'required|unique:rentals',
            ], $massage);
        }
        // $rental->pro_name = request('pro_name');
        $rental->pro_num = request('pro_num');
        // $rental->pro_photo = request('pro_photo');
        $rental->rent_price = request('rent_price');
        $rental->rent_period = request('rent_period');
        $rental->Tenant_name = request('Tenant_name');
        $rental->Tenant_phone = request('Tenant_phone');
        $rental->Tenant_address = request('Tenant_address');
        $rental->number_of_product = request('number_of_product');

        $rental->save();
        return back()->with('edtdone', 'تم التعديل');
    }


    public function back_to_stock($id)
    {
        $rental = Rental::findOrFail($id);
        $product = Product::where('id', $rental->pro_id)->first();

        if ($product && $rental->store_name = 'stock') {
            $product->number_of_product += $rental->number_of_product;
            $product->save();
            $rental->delete();

            return back()->with('done', "تم التخزين");
        } else {
            $supplier = Supplier::where('id', $rental->supplier_id)->first();
            $lists = catalogue::where('scrap', '0')->get();
            $cat_name = '';
            foreach ($lists as $li) {
                if ($li->code == $rental->pro_num) {
                    $cat_name = $li->name;
                }
            }
            $product = Product::create([
                'pro_num' => $rental->pro_num,
                'pro_name' => $cat_name,
                'price' => $rental->pro_sup_price,
                'number_of_product' => $rental->number_of_product,
            ]);

            $supplier->products()->attach($product->id);
            $supplier->save();
            $product->save();
            $rental->delete();
            return back()->with('done', "تم التخزين");
        }
    }

    public function back_to_purchas($id)
    {
        $rental = Rental::findOrFail($id);
        $purchas = purchas::where('id', $rental->purchas_id)->first();

        if ($purchas && $rental->store_name = 'purchas') {
            $purchas->number_of_product += $rental->number_of_product;
            $purchas->save();
            $rental->delete();

            return back()->with('done', "تم الإرجاع للمشتريات");
        } else {
            $supplier = Supplier::where('id', $rental->supplier_id)->first();
            $lists = catalogue::where('scrap', '0')->get();
            $cat_name = '';
            foreach ($lists as $li) {
                if ($li->code == $rental->pro_num) {
                    $cat_name = $li->name;
                }
            }
            $purchas = purchas::create([
                'pro_num' => $rental->pro_num,
                'pro_name' => $cat_name,
                'price' => $rental->purchas_sup_price,
                'number_of_product' => $rental->number_of_product,
            ]);

            $supplier->purchas()->attach($purchas->id);
            $supplier->save();
            $purchas->save();
            $rental->delete();
            return back()->with('done', "تم الإرجاع للمشتريات");
        }
    }

    public function sendtostock(Request $request, $id)
    {
        $rental = rental::findOrFail($id);

        if ($rental->number_of_product == (int) request('number_of_product')) {
            // Create a new Product instance and set its attributes
            $product = new Product();
            $product->pro_name = $rental->pro_name;
            $product->pro_num = $rental->pro_num;
            $product->price = $rental->purchas_sup_price;
            $product->number_of_product = $rental->number_of_product;
            // Save the product to the products table
            $product->save();
            // Find the Supplier
            $supplier = Supplier::find($rental->supplier_id);
            $supplier->products()->attach($product->id);

            $rental->number_of_product = 0;
            $rental->delete();

            return back()->with('done', "تم التخزين");

        } elseif ($rental->number_of_product > request('number_of_product')) {
            $product = new Product();
            $product->pro_name = $rental->pro_name;
            $product->pro_num = $rental->pro_num;
            $product->price = $rental->purchas_sup_price;
            $product->number_of_product = request('number_of_product');
            $product->save();

            $supplier = Supplier::find($rental->supplier_id);
            $supplier->products()->attach($product->id);

            $rental->number_of_product -= request('number_of_product');
            $rental->save();

            return back()->with('done', "تم التخزين");
        } elseif ($rental->number_of_product < request('number_of_product')) {
            return back()->with('error', 'خطأ ! الكمية المراد تخزينها اكبر من المتاح');
        }

    }

    public function search_rental(Request $request)
    {
        $rent_keyword = $request->input('rent_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // $allData = rental::where('pro_name', 'like', '%' . $rent_keyword . '%')->get();
        $allData = rental::where(function ($query) use ($rent_keyword, $from_date, $to_date) {

            $query->when($rent_keyword, function ($subQuery) use ($rent_keyword) {
                $subQuery->where('pro_num', $rent_keyword)
                    ->orWhere('pro_name', 'like', '%' . $rent_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;
        $sum_rent_price = $allData
        ->map(fn ($rental) => $rental->number_of_product * $rental->rent_price * $rental->rent_period)
        ->sum();

    $total_supply_pro_rent = $allData
        ->map(fn ($rental) => $rental->number_of_product * $rental->pro_sup_price)
        ->sum();

    $total_supply_purchas_rent = $allData
        ->map(fn ($rental) => $rental->number_of_product * $rental->purchas_sup_price)
        ->sum();

    $total_supply_rent = $total_supply_pro_rent + $total_supply_purchas_rent;
    $total_number_rent = $allData->sum('number_of_product');
    $data_view =  view('rental.ajax.search', compact('allData', 'x', 'sum_rent_price', 'total_supply_rent', 'total_number_rent', 'total_supply_pro_rent', 'total_supply_purchas_rent'))->render();
return response()->json([
    'data_view' => $data_view,
    'sum_rent_price' => $sum_rent_price,
    'total_supply_rent' => $total_supply_rent,
    'total_number_rent' => $total_number_rent,
      ]);

    }

    public function rentalpdf()
    {
        $allData = rental::all();
        $x = 1;
        return view('rental.rentalpdf', compact('allData'), compact('x'));
    }
}