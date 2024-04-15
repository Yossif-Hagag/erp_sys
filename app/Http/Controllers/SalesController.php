<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales()
    {
        $sales = Sale::get();
        $x = 1;
        return view('sales.show', compact('sales'), compact('x'));
    }

    public function send_stock_sales(Request $request, $sid, $pid)
    {
        $supplier = Supplier::findOrFail($sid);
        $product = $supplier->products()->find($pid);
        // dd($product);
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' الهاتف فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];
        $validatedData = $request->validate([
            'seller_phone' => 'required',
        ],$massage);

        if ($product->number_of_product == request('number_of_product')) {
            $sales = new Sale();
            $sales->pro_name = $product->pro_name;
            $sales->pro_num = $product->pro_num;
            // $sales->pro_photo = request('pro_photo');
            $sales->number_of_product = request('number_of_product');
            $sales->supply_price = $product->price;
            $sales->sell_price = request('sell_price');

            $sales->seller = request('buyer_name');
            $sales->seller_phone = request('seller_phone');
            $sales->seller_address = request('buyer_address');
            $sales->source = 'stock';

            $product->number_of_product = 0;
            $supplier->save();
            $sales->save();

            $product->delete();

            return back()->with('done',"تمت عملية البيع");

        } elseif ($product->number_of_product > request('number_of_product')) {
            $sales = new Sale();
            $sales->pro_name = $product->pro_name;
            $sales->pro_num = $product->pro_num;
            // $sales->pro_photo = request('pro_photo');
            $sales->number_of_product = request('number_of_product');
            $sales->supply_price = $product->price;
            $sales->sell_price = request('sell_price');

            $sales->seller = request('buyer_name');
            $sales->seller_phone = request('seller_phone');
            $sales->seller_address = request('buyer_address');
            $sales->source = 'stock';

            $product->number_of_product = $product->number_of_product - request('number_of_product');

            $sales->save();
            $supplier->save();
            $product->save();

            return back()->with('done',"تمت عملية البيع");

        } elseif ($product->number_of_product < request('number_of_product')) {
            return back()->with('error',"خطأ ! الكمية المراد بيعها اكبر من المتاح");
        }
    }
    public function send_purchas_sales(Request $request, $sid, $pid)
    {
        $supplier = Supplier::findOrFail($sid);
        $purchas = $supplier->purchas()->find($pid);
        // dd($purchas);
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' الهاتف فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];
        $validatedData = $request->validate([
            'seller_phone' => 'required',
        ],$massage);

        if ($purchas->number_of_product == request('number_of_product')) {
            $sales = new Sale();
            $sales->pro_name = $purchas->pro_name;
            $sales->pro_num = $purchas->pro_num;
            // $sales->pro_photo = request('pro_photo');
            $sales->number_of_product = request('number_of_product');
            $sales->supply_price = $purchas->price;
            $sales->sell_price = request('sell_price');

            $sales->seller = request('buyer_name');
            $sales->seller_phone = request('seller_phone');
            $sales->seller_address = request('buyer_address');
            $sales->source = 'purchas';

            $purchas->number_of_product = 0;
            $supplier->save();
            $sales->save();

            $purchas->delete();

            return back()->with('done',"تمت عملية البيع");

        } elseif ($purchas->number_of_product > request('number_of_product')) {
            $sales = new Sale();
            $sales->pro_name = $purchas->pro_name;
            $sales->pro_num = $purchas->pro_num;
            // $sales->pro_photo = request('pro_photo');
            $sales->number_of_product = request('number_of_product');
            $sales->supply_price = $purchas->price;
            $sales->sell_price = request('sell_price');

            $sales->seller = request('buyer_name');
            $sales->seller_phone = request('seller_phone');
            $sales->seller_address = request('buyer_address');
            $sales->source = 'purchas';

            $purchas->number_of_product = $purchas->number_of_product - request('number_of_product');

            $sales->save();
            $supplier->save();
            $purchas->save();

            return back()->with('done',"تمت عملية البيع");

        } elseif ($purchas->number_of_product < request('number_of_product')) {
            return back()->with('error',"خطأ ! الكمية المراد بيعها اكبر من المتاح");
        }
    }

    public function send_scrap_sales(Request $request, $sid, $pid)
    {
        $supplier = Supplier::findOrFail($sid);
        $scrap = $supplier->scraps()->find($pid);
        // dd($scrap);
        $massage = [
            'required' => 'هذا الحقل مطلوب ',
            'unique' => ' الهاتف فريد لا يمكن تكراره',
            'max' => 'الهاتف 10 ارقام فقط'
        ];
        $validatedData = $request->validate([
            'seller_phone' => 'required',
        ],$massage);

        if ($scrap->quantity == request('number_of_product')) {
            $sales = new Sale();
            $sales->pro_name = $scrap->pro_name;
            $sales->pro_num = $scrap->pro_num;
            // $sales->pro_photo = request('pro_photo');
            $sales->number_of_product = request('number_of_product');
            $sales->supply_price = $scrap->price;
            $sales->sell_price = request('sell_price');

            $sales->seller = request('buyer_name');
            $sales->seller_phone = request('seller_phone');
            $sales->seller_address = request('buyer_address');
            $sales->source = 'scrap';

            $scrap->quantity = 0;
            $supplier->save();
            $sales->save();

            $scrap->delete();

            return back()->with('done',"تمت عملية البيع");

        } elseif ($scrap->quantity > request('number_of_product')) {
            $sales = new Sale();
            $sales->pro_name = $scrap->pro_name;
            $sales->pro_num = $scrap->pro_num;
            // $sales->pro_photo = request('pro_photo');
            $sales->number_of_product = request('number_of_product');
            $sales->supply_price = $scrap->price;
            $sales->sell_price = request('sell_price');

            $sales->seller = request('buyer_name');
            $sales->seller_phone = request('seller_phone');
            $sales->seller_address = request('buyer_address');
            $sales->source = 'scrap';

            $scrap->quantity = $scrap->quantity - request('number_of_product');

            $sales->save();
            $supplier->save();
            $scrap->save();

            return back()->with('done',"تمت عملية البيع");

        } elseif ($scrap->quantity < request('number_of_product')) {
            return back()->with('error',"خطأ ! الكمية المراد بيعها اكبر من المتاح");
        }
    }








}