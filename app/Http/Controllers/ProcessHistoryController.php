<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Custody;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\rental;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Po;
use App\Models\Purchas;
use App\Models\User;
use App\Models\Scrap;
use App\Models\Worker;
use App\Models\Expense;
use OwenIt\Auditing\Models\Audit;


class ProcessHistoryController extends Controller
{
    public function prochis()
    {
        $all = Audit::where('auditable_type', Product::class)->orderby('id','desc')->paginate(6);
        $admins = Admin::all();
        $users = User::all();
        $product = Product::all();
        return view('ProcessHistory.prochis',
        ['all' => $all, 'admins' => $admins, 'users' => $users, 'product' => $product, 'i' => 1]);
    }
    public function audit_product()
    {
        // $product = Product::first();
        // $all = $product->audits;
        $all = Audit::where('auditable_type', Product::class)->orderby('id','desc')->paginate(6);
        $admins = Admin::all();
        $users = User::all();
        $product = Product::all();
        return view('ProcessHistory.audit_product',
        ['all' => $all, 'admins' => $admins, 'users' => $users, 'product' => $product, 'i' => 1]);
    }
    public function audit_supplier()
    {
        $allSup = Audit::where('auditable_type', Supplier::class)->orderby('id','desc')->paginate(6);
        // var_dump($allSup);
        $admins = Admin::all();
        $users = User::all();
        $supplier = Supplier::all();
        return view('ProcessHistory.audit_supplier',
        ['allSup' => $allSup, 'admins' => $admins, 'users' => $users, 'supplier' => $supplier, 'i' => 1]);
    }
    public function audit_purchas()
    {
        $allPurchas = Audit::where('auditable_type', purchas::class)->orderby('id','desc')->paginate(6);
        // var_dump($allSup);
        $admins = Admin::all();
        $users = User::all();
        $purchas = Purchas::all();
        return view('ProcessHistory.audit_purchas',
        ['allPurchas' => $allPurchas, 'admins' => $admins, 'users' => $users, 'purchas' => $purchas, 'i' => 1]);
    }
    public function audit_rental()
    {
        $allRen = Audit::where('auditable_type', rental::class)->orderby('id','desc')->paginate(6);
        // var_dump($allSup);
        $admins = Admin::all();
        $users = User::all();
        $rental = rental::all();
        return view('ProcessHistory.audit_rental',
        ['allRen' => $allRen, 'admins' => $admins, 'users' => $users, 'rental' => $rental, 'i' => 1]);
    }
    public function audit_scrap()
    {
        $scraps_audits = Audit::where('auditable_type', Scrap::class)->orderby('id','desc')->paginate(6);
        // var_dump($allSup);
        $admins = Admin::all();
        $users = User::all();
        $scraps = Scrap::all();
        return view('ProcessHistory.audit_scrap',
        ['scraps_audits' => $scraps_audits, 'admins' => $admins, 'users' => $users, 'scraps' => $scraps, 'i' => 1]);
    }
    public function audit_user()
    {
        $users_audits = Audit::where('auditable_type', User::class)->orderby('id','desc')->paginate(6);
        // var_dump($users_audits);
        $admins = Admin::all();
        $users = User::all();
        return view('ProcessHistory.audit_user',
        ['users_audits' => $users_audits, 'users' => $users, 'admins' => $admins, 'i' => 1]);
    }
    public function audit_po()
    {
        $po_audits = Audit::where('auditable_type', Po::class)->orderby('id','desc')->paginate(6);
        // var_dump($po_audits);
        $admins = Admin::all();
        $agents = Agent::all();
        $po = Po::all();
        return view('ProcessHistory.audit_po',
        ['po_audits' => $po_audits, 'po' => $po, 'admins' => $admins,'agents' => $agents, 'i' => 1]);
    }
    public function audit_expense()
    {
        $audit_expense = Audit::where('auditable_type', Expense::class)->orderby('id','desc')->paginate(6);
        // var_dump($audit_expense);
        $admins = Admin::all();
        return view('ProcessHistory.audit_expense',
        ['audit_expense' => $audit_expense, 'admins' => $admins, 'i' => 1]);
    }
    public function audit_custody()
    {
        $audit_custody = Audit::where('auditable_type', Custody::class)->orderby('id','desc')->paginate(6);
        // var_dump($audit_custody);
        $admins = Admin::all();
        return view('ProcessHistory.audit_custody',
        ['audit_custody' => $audit_custody, 'admins' => $admins, 'i' => 1,'c' => 0]);
    }
    public function audit_agents()
    {
        $audit_agents = Audit::where('auditable_type', Agent::class)->orderby('id','desc')->paginate(6);
        // var_dump($audit_agents);
        $admins = Admin::all();
        return view('ProcessHistory.audit_agents',
        ['audit_agents' => $audit_agents, 'admins' => $admins, 'i' => 1,'c' => 0]);
    }


}