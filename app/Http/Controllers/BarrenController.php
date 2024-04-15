<?php

namespace App\Http\Controllers;

use App\Charts\SellsChart;
use App\Charts\RentalsChart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\catalogue;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\rental;

class BarrenController extends Controller
{
    public function barren()
    {
        return view('barren.barren');
    }
    public function barren_code(Request $request)
    {
        $code = $request->input('code-barren');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $product = catalogue::where('code', $code)->first();

        if (!$product) {
            return back()->with('error', "خطأ ! اكتب الكود الصحيح");
        }

        $x = 1;
        $sum_rent_price = 0;
        $sum_sell_profit = 0;

        $sales = Sale::query()
            ->where('pro_num', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->paginate(8, '*', 'sellPage')->withQueryString();

        $sales_all = Sale::query()
            ->where('pro_num', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $rentals = rental::query()
            ->where('pro_num', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->paginate(8, '*', 'rentalPage')->withQueryString();

        $rentals_all = rental::query()
            ->where('pro_num', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $lists = catalogue::query()
            ->where('code', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $suppliers = Supplier::query()
            ->with('products')
            ->Has('products')
            ->whereHas('products', fn(Builder $builder) => $builder->where('pro_num', $code))
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->paginate(3, '*', 'productPage')->withQueryString();

        $suppliers_all = Supplier::query()
            ->with('products')
            ->Has('products')
            ->whereHas('products', fn(Builder $builder) => $builder->where('pro_num', $code))
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        // $items = Supplier::query()
        //     ->with('purchas')
        //     ->Has('purchas')
        //     ->whereHas('purchas', fn(Builder $builder) => $builder->where('pro_num', $code))
        //                 ->when(!! $from_date, fn ($q) => $q->whereDate('created_at', '>=', $from_date))
        // ->when(!! $to_date, fn ($q) => $q->whereDate('created_at', '<=', $to_date))
        //     ->paginate(3, '*', 'purchasPage')->withQueryString();
        // $items_all = Supplier::query()
        //     ->with('purchas')
        //     ->Has('purchas')
        //     ->whereHas('purchas', fn(Builder $builder) => $builder->where('pro_num', $code))
        //                 ->when(!! $from_date, fn ($q) => $q->whereDate('created_at', '>=', $from_date))
        // ->when(!! $to_date, fn ($q) => $q->whereDate('created_at', '<=', $to_date))
        //     ->get();

        $suppliers_scraps = Supplier::query()
            ->with('scraps')
            ->Has('scraps')
            ->whereHas('scraps', fn(Builder $builder) => $builder->where('pro_num', $code))
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->paginate(3, '*', 'scrapPage')->withQueryString();

        $suppliers_scraps_all = Supplier::query()
            ->with('scraps')
            ->Has('scraps')
            ->whereHas('scraps', fn(Builder $builder) => $builder->where('pro_num', $code))
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $sum_rent_price = $rentals_all
            ->map(fn(rental $rental) => $rental->number_of_product * ($rental->rent_price) * $rental->rent_period)
            ->sum();

        $total_supply_pro_rent = $rentals_all
            ->map(fn(rental $rental) => $rental->number_of_product * ($rental->pro_sup_price))
            ->sum();
        // $total_supply_purchas_rent = $rentals_all
        //     ->map(fn(rental $rental) => $rental->number_of_product * ($rental->purchas_sup_price) )
        //     ->sum();

        $total_supply_rent = $total_supply_pro_rent;

        $total_stock = 0;
        foreach ($suppliers_all as $s) {
            foreach ($s->products as $p) {
                if ($p->pro_num == $code) {
                    $total_stock += (int) $p->number_of_product * $p->price;
                }
            }
        }
        // $total_purchas = 0;
        // foreach ($items_all as $s) {
        //     foreach ($s->purchas as $p) {
        //         if ($p->pro_num == $code) {
        //             $total_purchas += (int)$p->number_of_product * $p->price;
        //         }
        //     }
        // }
        $total_scrap = 0;
        foreach ($suppliers_scraps_all as $s) {
            foreach ($s->scraps as $p) {
                if ($p->pro_num == $code) {
                    $total_scrap += (int) $p->quantity * $p->price;
                }
            }
        }
        // dd($total_purchas);

        $sum_sell_profit = $sales_all
            ->map(fn(Sale $sale) => $sale->number_of_product * ($sale->sell_price - $sale->supply_price))
            ->sum();

        $total_sell = $sales_all
            ->map(fn(Sale $sale) => $sale->number_of_product * $sale->sell_price)
            ->sum();

        $total_supply = $sales_all
            ->map(fn(Sale $sale) => $sale->number_of_product * $sale->supply_price)
            ->sum();


        $total_supply_rental_pro = $rentals_all
            ->map(fn(rental $rental) => $rental->number_of_product * $rental->pro_sup_price)
            ->sum();

        $total_supply_rental_purchas = $rentals_all
            ->map(fn(rental $rental) => $rental->number_of_product * $rental->purchas_sup_price)
            ->sum();

        $total_supply_rental = $total_supply_rental_pro + $total_supply_rental_purchas;

        $sellChart = new SellsChart;
        $sellChart->labels(['إجمالي سعر المبيعات', 'إجمالي سعر التوريدات']);
        $sellChart->dataset('مبيعات', 'bar', [$total_sell])
            ->color('#2ecc71')
            ->backgroundColor('#2ecc71');
        $sellChart->dataset('توريدات', 'bar', [0, $total_supply])
            ->color('#e74c3c')
            ->backgroundColor('#e74c3c');


        $sellPieChart = new SellsChart;
        $sellPieChart->displayAxes(false)->labels([' سعر المبيعات', ' سعر التوريدات']);
        $sellPieChart->dataset('مبيعات', 'pie', [$total_sell, $total_supply])
            ->options([
                'backgroundColor' => [
                    '#2ecc71',
                    '#e74c3c',
                ]
            ]);


        $rentChart = new RentalsChart;
        $rentChart->labels(['إجمالي سعر التأجير', 'إجمالي سعر التوريدات']);
        $rentChart->dataset('التأجير', 'bar', [$sum_rent_price])
            ->color('#3498db')
            ->backgroundColor('#3498db');
        $rentChart->dataset('توريدات', 'bar', [0, $total_supply_rental])
            ->color('#e74c3c')
            ->backgroundColor('#e74c3c');


        $rentPieChart = new RentalsChart;
        $rentPieChart->displayAxes(false)->labels([' سعر التأجير', ' سعر التوريدات']);
        $rentPieChart->dataset('التأجير', 'pie', [$sum_rent_price, $total_supply_rental])
            ->options([
                'backgroundColor' => [
                    '#3498db',
                    '#e74c3c',
                ]
            ]);

        return view(
            'barren.barren_code',
            compact(
                'code',
                'from_date',
                'to_date',
                'x',
                'sellPieChart',
                'rentChart',
                'rentPieChart',
                'sellChart',
                'sales',
                'rentals',
                'suppliers',
                'lists',
                // 'items',
                'suppliers_scraps',
                'sum_rent_price',
                'sum_sell_profit',
                'total_supply',
                'total_sell',
                'total_supply_rent',
                'total_stock',
                // 'total_purchas',
                'total_scrap',
            )
        );
    }
    public function barrenpdf(Request $request, $code)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $x = 1;
        $sum_rent_price = 0;
        $sum_sell_profit = 0;
        $sales = Sale::query()
            ->where('pro_num', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $rentals = rental::query()
            ->where('pro_num', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $lists = catalogue::query()
            ->where('code', $code)
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $suppliers = Supplier::query()
            ->with('products')
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        // $items = Supplier::query()
        //     ->with('purchas')
        //                 ->when(!! $from_date, fn ($q) => $q->whereDate('created_at', '>=', $from_date))
        // ->when(!! $to_date, fn ($q) => $q->whereDate('created_at', '<=', $to_date))
        //     ->get();

        $suppliers_scraps = Supplier::query()
            ->with('scraps')
            ->when(!!$from_date, fn($q) => $q->whereDate('created_at', '>=', $from_date))
            ->when(!!$to_date, fn($q) => $q->whereDate('created_at', '<=', $to_date))
            ->get();

        $sum_rent_price = $rentals
            ->map(fn(rental $rental) => $rental->number_of_product * ($rental->rent_price))
            ->sum();

        $sum_sell_profit = $sales
            ->map(fn(Sale $sale) => $sale->number_of_product * ($sale->sell_price - $sale->supply_price))
            ->sum();

        $total_sell = $sales
            ->map(fn(Sale $sale) => $sale->number_of_product * $sale->sell_price)
            ->sum();

        $total_supply = $sales
            ->map(fn(Sale $sale) => $sale->number_of_product * $sale->supply_price)
            ->sum();


        $total_supply_rental_pro = $rentals
            ->map(fn(rental $rental) => $rental->number_of_product * $rental->pro_sup_price)
            ->sum();

        $total_supply_rental_purchas = $rentals
            ->map(fn(rental $rental) => $rental->number_of_product * $rental->purchas_sup_price)
            ->sum();

        $total_supply_rental = $total_supply_rental_pro + $total_supply_rental_purchas;

        $sellChart = new SellsChart;
        $sellChart->labels(['إجمالي سعر المبيعات', 'إجمالي سعر التوريدات']);
        $sellChart->dataset('مبيعات', 'bar', [$total_sell])
            ->color('#2ecc71')
            ->backgroundColor('#2ecc71');
        $sellChart->dataset('توريدات', 'bar', [0, $total_supply])
            ->color('#e74c3c')
            ->backgroundColor('#e74c3c');


        $sellPieChart = new SellsChart;
        $sellPieChart->displayAxes(false)->labels([' سعر المبيعات', ' سعر التوريدات']);
        $sellPieChart->dataset('مبيعات', 'pie', [$total_sell, $total_supply])
            ->options([
                'backgroundColor' => [
                    '#2ecc71',
                    '#e74c3c',
                ]
            ]);


        $rentChart = new RentalsChart;
        $rentChart->labels(['إجمالي سعر التأجير', 'إجمالي سعر التوريدات']);
        $rentChart->dataset('التأجير', 'bar', [$sum_rent_price])
            ->color('#3498db')
            ->backgroundColor('#3498db');
        $rentChart->dataset('توريدات', 'bar', [0, $total_supply_rental])
            ->color('#e74c3c')
            ->backgroundColor('#e74c3c');


        $rentPieChart = new RentalsChart;
        $rentPieChart->displayAxes(false)->labels([' سعر التأجير', ' سعر التوريدات']);
        $rentPieChart->dataset('التأجير', 'pie', [$sum_rent_price, $total_supply_rental])
            ->options([
                'backgroundColor' => [
                    '#3498db',
                    '#e74c3c',
                ]
            ]);

        return view(
            'barren.barrenpdf',
            compact(
                'code',
                'from_date',
                'to_date',
                'x',
                'sellPieChart',
                'rentChart',
                'rentPieChart',
                'sellChart',
                'sales',
                'rentals',
                'suppliers',
                'lists',
                // 'items',
                'suppliers_scraps',
                'sum_rent_price',
                'sum_sell_profit'
            )
        );
    }
}