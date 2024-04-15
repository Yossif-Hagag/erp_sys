<?php

namespace App\Http\Controllers;

use App\Models\catalogue;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\rental;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function product()
    {
        $suppliers = Supplier::Has('products')->with(['products' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->paginate(3);

        $x = 1;
        $lists = catalogue::where('scrap', '0')->get();

        $suppliers_all = Supplier::query()
        ->with('products')
        ->Has('products')
        ->get();
        $total_stock = 0;
        foreach ($suppliers_all as $s) {
            foreach ($s->products as $p) {
                    $total_stock += (int)$p->number_of_product * $p->price;
            }
        }
        $totalNumberOfProducts = Product::sum('number_of_product');

        // dd($lists);
        return view('product.show', compact('suppliers', 'x', 'lists','total_stock','totalNumberOfProducts'));
    }

    public function add_product()
    {
        $products = catalogue::where('scrap', '0')->get();
        return view('product.add_product', compact('products'));
    }

    public function store_product(Request $request)
    {
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' الهاتف فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];
        $validatedData = $request->validate([
            'supplier_name' => 'required',
            'price' => 'required',
            'number_of_product' => 'required',
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
        // $product = Product::where('pro_num', $request->pro_num)->first();
        $product = NULL;
        if ($product) {
            $product->number_of_product += $request->number_of_product;
            $product->save();
        } else {
            $lists = catalogue::where('scrap', '0')->get();
            $cat_name = '';
            foreach ($lists as $li) {
                if ($li->code == $request->pro_num) {
                    $cat_name = $li->name;
                }
            }
            $product = Product::create([
                'pro_num' => $request->pro_num,
                'pro_name' => $cat_name,
                'price' => $request->price,
                'number_of_product' => $request->number_of_product,
            ]);
        }
        $supplier->products()->attach($product->id);

        $supplier->save();
        $product->save();
        return back()->with('done', 'تمت الاضافة');
    }

    public function edt_product($id, $pid)
    {
        $supplier = Supplier::with('products')->findorfail($id);
        $product = $supplier->products->find($pid);
        $pros = catalogue::where('scrap', '0')->get();
        return view('product.edit', compact('supplier', 'product', 'pros'));
    }

    public function update_product(Request $request, $id, $pid)
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
                'number_of_product' => 'required',
                'pro_num' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ], $massage);
        } else {
            $validatedData2 = $request->validate([
                'supplier_name' => 'required',
                'price' => 'required',
                'number_of_product' => 'required',
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
        $lists = catalogue::where('scrap', '0')->get();
        $cat_name = '';
        foreach ($lists as $li) {
            if ($li->code == $request->pro_num) {
                $cat_name = $li->name;
            }
        }
        $product = $supplier->products()->find($pid);
        $product->update([
            'pro_name' => $cat_name,
            'pro_num' => $request->pro_num,
            'price' => $request->price,
            'number_of_product' => $request->number_of_product,
        ]);

        $supplier->save();
        $product->save();
        return back()->with('edtdone', 'تم التعديل');
        // return redirect()->route('update_product')->with('success', 'Product and supplier updated successfully!');
    }

    public function send_stock_rental($id, $sid, Request $request)
    {

        $supplier = Supplier::findOrFail($sid);
        $product = $supplier->products()->find($id);
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' الهاتف فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];
        $validatedData = $request->validate([
            'Tenant_phone' => 'required',
        ], $massage);

        if ($product->number_of_product == request('number_of_product')) {
            $rental = new rental();
            $rental->store_name = 'stock';
            $rental->pro_name = $product->pro_name;
            $rental->pro_num = $product->pro_num;
            // $rental->pro_photo = request('pro_photo');
            $rental->number_of_product = request('number_of_product');
            $rental->rent_period = request('rent_period');
            $rental->rent_price = request('rent_price');
            $rental->Tenant_name = request('Tenant_name');
            $rental->Tenant_phone = request('Tenant_phone');
            $rental->Tenant_address = request('Tenant_address');
            $rental->supplier_id = $supplier->id;
            $rental->pro_id = $product->id;
            $rental->pro_sup_price = $product->price;
            $product->number_of_product = 0;

            $rental->save();
            $product->save();
            $product->delete();
            return back()->with('done', "تمت عملية التأجير");
        } elseif ($product->number_of_product > request('number_of_product')) {
            $rental = new rental();
            $rental->store_name = 'stock';
            $rental->pro_name = $product->pro_name;
            $rental->pro_num = $product->pro_num;
            // $rental->pro_photo = request('pro_photo');
            $rental->number_of_product = request('number_of_product');
            $rental->rent_period = request('rent_period');
            $rental->rent_price = request('rent_price');
            $rental->Tenant_name = request('Tenant_name');
            $rental->Tenant_phone = request('Tenant_phone');
            $rental->Tenant_address = request('Tenant_address');
            $rental->supplier_id = $supplier->id;
            $rental->pro_id = $product->id;
            $rental->pro_sup_price = $product->price;
            $product->number_of_product -= request('number_of_product');

            $rental->save();
            $product->save();
            return back()->with('done', "تمت عملية التأجير");

        } elseif ($product->number_of_product < request('number_of_product')) {
            // dd(request('number_of_product'));
            return back()->with('error', "خطأ ! الكمية المراد تأجيرها اكبر من المتاح");

        }

    }


    public function searchProduct(Request $request)
    {
        $keyword = $request->input('keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');


        $suppliers = Supplier::with([
            'products' => function ($query) use ($keyword, $from_date, $to_date) {
                $query->when($keyword ,function ($subQuery) use ($keyword) {
                    $subQuery->where(function ($subQuery) use ($keyword) {
                        $subQuery->where('pro_name', 'like', '%' . $keyword . '%')
                        ->orWhere('pro_num', $keyword);
                    });
                });

                $query->when($from_date ,function ($subQuery) use ($from_date) {
                    $subQuery->whereDate('products.created_at','>=',$from_date);
                });

                $query->when($to_date ,function ($subQuery) use ($to_date) {
                    $subQuery->whereDate('products.created_at','<=',$to_date);
                });

            }
        ])->get();
        $x = 1;
        $total_number_of_products = 0;
        foreach ($suppliers as $supplier) {
            foreach ($supplier->products as $product) {
                $total_number_of_products += $product->number_of_product;
            }
        }
            $total_product_price= 0;
        foreach ($suppliers as $supplier) {
            foreach ($supplier->products as $product) {
                $total_product_price += $product->price* $product->number_of_product;
            }
        }
        $data_view = view('product.ajax.table', compact('suppliers', 'total_number_of_products','x','total_product_price'))->render();
    
        return response()->json([
            'data_view' => $data_view,
            'total_number_of_products' => $total_number_of_products,
            'total_product_price' => $total_product_price
        ]);
    }

    public function productpdf()
    {
        $suppliers = Supplier::with('products')->get();
        $x = 1;
        return view('product.productpdf', compact('suppliers'), compact('x'));
    }

}