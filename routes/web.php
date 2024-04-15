<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Welcome Page
Route::get('/', function () {
    if (auth()->guard('user')->check()) {
        return Redirect::route('user.dashboard');
    } elseif (auth()->guard('admin')->check()) {
        return Redirect::route('admin.dashboard');
    } else {
        return view('auth.login');
    }
});

//for middleware routs url links
Route::get('/dashboard', function () {
    if (auth()->guard('user')->check()) {
        return Redirect::route('user.dashboard');
    } elseif (auth()->guard('admin')->check()) {
        return Redirect::route('admin.dashboard');
    }
})->middleware(['auth:user,admin'])->name('dashboard');


// user Dashboard-verifired
Route::prefix('user')->name('user.')->middleware(['auth:user', 'verified'])->group(function ($request) {
    //(user-employers) dashboard
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// admin Dashboard-verifired
Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verified'])->group(function ($request) {
    //admin dashboard
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});



//Just Admin
Route::middleware('auth:admin')->group(function () {

    //admin profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/add_admin', [ProfileController::class, 'add_admin'])->name('add_admin');
    Route::post('/store_admin', [ProfileController::class, 'store_admin'])->name('store_admin');
    Route::get('/admins', [ProfileController::class, 'admins'])->name('admins');
    Route::post('/del_admin/{id}', [ProfileController::class, 'del_admin'])->name('del_admin');
    Route::get('/edt_admin/{id}', [ProfileController::class, 'edt_admin'])->name('edt_admin');
    Route::post('/update_admin/{id}', [ProfileController::class, 'update_admin'])->name('update_admin');



});


//user && admin
Route::middleware('auth:user,admin')->group(function () {

    //sales
    // Route::get('/sales', [SalesController::class, 'sales'])->name('sales');
    Route::post('/send_stock_sales/{sid}/{pid}', [SalesController::class, 'send_stock_sales'])->name('send_stock_sales');
    Route::post('/send_purchas_sales/{sid}/{pid}', [SalesController::class, 'send_purchas_sales'])->name('send_purchas_sales');
    Route::post('/send_scrap_sales/{sid}/{pid}', [SalesController::class, 'send_scrap_sales'])->name('send_scrap_sales');


    //product-stock
    Route::get('/product', [ProductController::class, 'product'])->name('product')->middleware('check_perm:0');
    Route::get('/add_product', [ProductController::class, 'add_product'])->name('add_product')->middleware('check_perm:0');
    Route::get('/edt_product/{id}/{pid}', [ProductController::class, 'edt_product'])->name('edt_product')->middleware('check_perm:0');
    Route::post('/store_product', [ProductController::class, 'store_product'])->name('store_product')->middleware('check_perm:0');
    Route::post('/update_product/{id}/{pid}', [ProductController::class, 'update_product'])->name('update_product')->middleware('check_perm:0');
    Route::post('/send_stock_rental/{id}/{sid}', [ProductController::class, 'send_stock_rental'])->name('send_stock_rental')->middleware('check_perm:0');
    Route::get('/product/search', [ProductController::class, 'searchProduct'])->name('product.search')->middleware('check_perm:0');
    Route::get('/productpdf', [ProductController::class, 'productpdf'])->name('productpdf')->middleware('check_perm:0');


    //purchas
    Route::get('/purchas', [purchasController::class, 'purchas'])->name('purchas')->middleware('check_perm:1');
    Route::get('/add_purchas', [purchasController::class, 'add_purchas'])->name('add_purchas')->middleware('check_perm:1');
    Route::get('/edt_purchas/{id}', [purchasController::class, 'edt_purchas'])->name('edt_purchas')->middleware('check_perm:1');
    Route::post('/store_purchas', [purchasController::class, 'store_purchas'])->name('store_purchas')->middleware('check_perm:1');
    Route::post('/update_purchas/{id}', [purchasController::class, 'update_purchas'])->name('update_purchas')->middleware('check_perm:1');
    Route::post('/send/{id}/{sid}', [purchasController::class, 'send'])->name('send')->middleware('check_perm:1');
    Route::get('/purchas/search', [purchasController::class, 'purchas_search'])->name('purchas.search')->middleware('check_perm:1');
    Route::post('/send_to_stock/{id}/{pid}', [purchasController::class, 'send_purchas_stock'])->name('send_to_stock')->middleware('check_perm:1');
    Route::get('/purchaspdf', [purchasController::class, 'purchaspdf'])->name('purchaspdf')->middleware('check_perm:1');



    //rental
    Route::get('/rental', [RentalController::class, 'rental'])->name('rental')->middleware('check_perm:3');
    Route::get('/edt_rental/{id}', [RentalController::class, 'edt_rental'])->name('edt_rental')->middleware('check_perm:3');
    Route::post('/update_rental/{id}', [RentalController::class, 'update_rental'])->name('update_rental')->middleware('check_perm:3');
    Route::get('/back-to-stock/{id}', [RentalController::class, 'back_to_stock'])->name('back-to-stock')->middleware('check_perm:3');
    Route::post('/send-to-stock/{id}', [RentalController::class, 'sendtostock'])->name('send-to-stock')->middleware('check_perm:3');
    Route::get('/back-to-purchas/{id}', [RentalController::class, 'back_to_purchas'])->name('back-to-purchas')->middleware('check_perm:3');
    Route::get('/rent/search', 'App\Http\Controllers\RentalController@search_rental')->name('rent.search')->middleware('check_perm:3');
    Route::get('/rentalpdf', [RentalController::class, 'rentalpdf'])->name('rentalpdf')->middleware('check_perm:3');

    //catalogue
    Route::get('/catalogue', [CatalogueController::class, 'catalogue'])->name('catalogue')->middleware('check_perm:11');
    Route::get('/add_catalogue', [CatalogueController::class, 'add_catalogue'])->name('add_catalogue')->middleware('check_perm:11');
    Route::post('/store_catalogue', [CatalogueController::class, 'store_catalogue'])->name('store_catalogue')->middleware('check_perm:11');
    Route::get('/edt_catalogue/{id}', [CatalogueController::class, 'edt_catalogue'])->name('edt_catalogue')->middleware('check_perm:11');
    Route::post('/update_catalogue/{id}', [CatalogueController::class, 'update_catalogue'])->name('update_catalogue')->middleware('check_perm:11');
    Route::get('/catalogue/search', [CatalogueController::class, 'searchCatalogue'])->name('catalogue.search')->middleware('check_perm:11');
    Route::get('/cataloguepdf', [CatalogueController::class, 'cataloguepdf'])->name('cataloguepdf')->middleware('check_perm:11');

    //scrap
    Route::get('/scrap', [ScrapController::class, 'scrap'])->name('scrap')->middleware('check_perm:2');
    Route::get('/add_scrap', [ScrapController::class, 'add_scrap'])->name('add_scrap')->middleware('check_perm:2');
    Route::post('/store_scrap', [ScrapController::class, 'store_scrap'])->name('store_scrap')->middleware('check_perm:2');
    Route::get('/edt_scrap/{id}/{pid}', [ScrapController::class, 'edt_scrap'])->name('edt_scrap')->middleware('check_perm:2');
    Route::post('/update_scrap/{id}/{pid}', [ScrapController::class, 'update_scrap'])->name('update_scrap')->middleware('check_perm:2');
    Route::get('/scrap/search', [ScrapController::class, 'searchscrap'])->name('scrap.search')->middleware('check_perm:2');
    Route::get('/scrappdf', [ScrapController::class, 'scrappdf'])->name('scrappdf')->middleware('check_perm:2');
    Route::post('/collect_scrap/{id}', [ScrapController::class, 'collect_scrap'])->name('collect_scrap')->middleware('check_perm:2');
    
    //quotations
    Route::get('/quotations', [QuotationsController::class, 'quotations'])->name('quotations')->middleware('check_perm:12');
    Route::post('/store_quotation', [QuotationsController::class, 'store_quotation'])->name('store_quotation')->middleware('check_perm:12');
    Route::post('/update_quotation/{id}', [QuotationsController::class, 'update_quotation'])->name('update_quotation')->middleware('check_perm:12');
    Route::post('/pricing/{id}', [QuotationsController::class, 'pricing'])->name('pricing')->middleware('check_perm:12');
    Route::post('/agree/{id}', [QuotationsController::class, 'agree'])->name('agree')->middleware('check_perm:12');
    Route::get('/quotationpdf', [QuotationsController::class, 'quotationpdf'])->name('quotationpdf')->middleware('check_perm:12');
    Route::get('/quotations/search', [QuotationsController::class, 'quotations_search'])->name('quotations.search')->middleware('check_perm:12');
    Route::delete('/delete_quotation/{id}', [QuotationsController::class, 'delete_quotation'])->name('delete_quotation')->middleware('check_perm:12');
    

    ///////////////////////////////////////////
    //ProcessHistory
    Route::get('/prochis', [ProcessHistoryController::class, 'prochis'])->name('prochis')->middleware('check_perm:10');
    Route::get('/audit_product', [ProcessHistoryController::class, 'audit_product'])->name('audit_product')->middleware('check_perm:10');
    Route::get('/audit_supplier', [ProcessHistoryController::class, 'audit_supplier'])->name('audit_supplier')->middleware('check_perm:10');
    Route::get('/audit_purchas', [ProcessHistoryController::class, 'audit_purchas'])->name('audit_purchas')->middleware('check_perm:10');
    Route::get('/audit_rental', [ProcessHistoryController::class, 'audit_rental'])->name('audit_rental')->middleware('check_perm:10');
    Route::get('/audit_scrap', [ProcessHistoryController::class, 'audit_scrap'])->name('audit_scrap')->middleware('check_perm:10');
    Route::get('/audit_user', [ProcessHistoryController::class, 'audit_user'])->name('audit_user')->middleware('check_perm:10');
    Route::get('/audit_po', [ProcessHistoryController::class, 'audit_po'])->name('audit_po')->middleware('check_perm:10');
    Route::get('/audit_custody', [ProcessHistoryController::class, 'audit_custody'])->name('audit_custody')->middleware('check_perm:10');
    Route::get('/audit_expense', [ProcessHistoryController::class, 'audit_expense'])->name('audit_expense')->middleware('check_perm:10');
    Route::get('/audit_agents', [ProcessHistoryController::class, 'audit_agents'])->name('audit_agents')->middleware('check_perm:10');

    //Users(الموظفين)
    Route::get('/users', [UserController::class, 'users'])->name('users')->middleware('check_perm:4');
    Route::get('/add_user', [UserController::class, 'add_user'])->name('add_user')->middleware('check_perm:4');
    Route::post('/store_user', [UserController::class, 'store_user'])->name('store_user')->middleware('check_perm:4');
    Route::get('/edt_user/{id}', [UserController::class, 'edt_user'])->name('edt_user')->middleware('check_perm:4');
    Route::post('/update_user/{id}', [UserController::class, 'update_user'])->name('update_user')->middleware('check_perm:4');
    Route::get('/userspdf', [UserController::class, 'userspdf'])->name('userspdf')->middleware('check_perm:4');
    Route::get('/user/search', [UserController::class, 'searchuser'])->name('user.search')->middleware('check_perm:4');
    Route::get('/user_perm/{id}', [UserController::class, 'user_perm'])->name('user_perm')->middleware('check_perm:4');
    Route::post('/update_user_perm/{id}', [UserController::class, 'update_user_perm'])->name('update_user_perm')->middleware('check_perm:4');

    //PO
    Route::get('/pos', [PoController::class, 'po'])->name('po')->middleware('check_perm:6');
    Route::get('/add_po', [PoController::class, 'add_po'])->name('add_po')->middleware('check_perm:6');
    Route::post('/store_po', [PoController::class, 'store_po'])->name('store_po')->middleware('check_perm:6');
    Route::get('/edt_po/{id}', [PoController::class, 'edt_po'])->name('edt_po')->middleware('check_perm:6');
    Route::post('/update_po/{id}', [PoController::class, 'update_po'])->name('update_po')->middleware('check_perm:6');
    Route::post('/collect_po/{id}', [PoController::class, 'collect_po'])->name('collect_po')->middleware('check_perm:6');
    Route::get('/po/search', [PoController::class, 'searchPo'])->name('po.search')->middleware('check_perm:6');
    Route::get('/popdf', [PoController::class, 'popdf'])->name('popdf')->middleware('check_perm:6');
    //PO_Collected
    Route::get('/po_collected', [PoController::class, 'po_collected'])->name('po_collected')->middleware('check_perm:7');
    Route::get('/po_collection/search', [PoController::class, 'searchPo_collection'])->name('po_collection.search')->middleware('check_perm:7');
    Route::get('/po_collection_pdf', [PoController::class, 'po_collection_pdf'])->name('po_collection_pdf')->middleware('check_perm:7');

    //custody (العهدة)
    Route::get('/custody', [CustodyController::class, 'custody'])->name('custody')->middleware('check_perm:8');
    Route::post('/add_custody', [CustodyController::class, 'add_custody'])->name('add_custody')->middleware('check_perm:8');
    Route::get('/custodypdf', [CustodyController::class, 'custodypdf'])->name('custodypdf')->middleware('check_perm:8');
    Route::post('/reset_custody', [CustodyController::class, 'reset_custody'])->name('reset_custody')->middleware('check_perm:8');
    
    //expense (المصروفات)
    Route::post('/add_expense', [ExpenseController::class, 'add_expense'])->name('add_expense')->middleware('check_perm:8');
    Route::post('/edt_expense/{id}', [ExpenseController::class, 'edt_expense'])->name('edt_expense')->middleware('check_perm:8');
    Route::get('/expenses/search', [ExpenseController::class, 'searchExpenses'])->name('expenses.search')->middleware('check_perm:8');

    //agents
    Route::get('/allagent', [AgentController::class, 'allagent'])->name('allagent')->middleware('check_perm:5');
    Route::get('/add_agent', [AgentController::class, 'add_agent'])->name('add_agent')->middleware('check_perm:5');
    Route::get('/agentspdf', [AgentController::class, 'agentspdf'])->name('agentspdf')->middleware('check_perm:5');
    Route::get('/fixedsuppliespdf/{id}', [AgentController::class, 'fixedsuppliespdf'])->name('fixedsuppliespdf')->middleware('check_perm:5');
    Route::get('/eachsuppliespdf/{id}', [AgentController::class, 'eachsuppliespdf'])->name('eachsuppliespdf')->middleware('check_perm:5');
    Route::get('/fixedsup/search', [AgentController::class, 'fixedsupSearch'])->name('fixedsup.search')->middleware('check_perm:5');
    Route::get('/eachsup/search', [AgentController::class, 'eachsupSearch'])->name('eachsup.search')->middleware('check_perm:5');
    Route::post('/store_agent', [AgentController::class, 'store_agent'])->name('store_agent')->middleware('check_perm:5');
    Route::get('/agent/{id}', [AgentController::class, 'agent'])->name('agent')->middleware('check_perm:5');
    Route::post('/store_fixed_supplies/{id}', [AgentController::class, 'store_fixed_supplies'])->name('store_fixed_supplies')->middleware('check_perm:5');
    Route::post('/store_each_supplies/{id}', [AgentController::class, 'store_each_supplies'])->name('store_each_supplies')->middleware('check_perm:5');
    Route::get('/edit_fixed_supplies/{fixed_supplies_id}', [AgentController::class, 'edit_fixed_supplies'])->name('edit_fixed_supplies')->middleware('check_perm:5');
    Route::post('/update_fixed_supplies/{id}', [AgentController::class, 'update_fixed_supplies'])->name('update_fixed_supplies')->middleware('check_perm:5');
    Route::get('/edit_each_supplies/{id}', [AgentController::class, 'edit_each_supplies'])->name('edit_each_supplies')->middleware('check_perm:5');
    Route::post('/update_each_supplies/{id}', [AgentController::class, 'update_each_supplies'])->name('update_each_supplies')->middleware('check_perm:5');
    Route::delete('/delete-supply/{id}', [AgentController::class, 'deleteSupply'])->name('delete_supply')->middleware('check_perm:5');
    Route::delete('/delete-Eachsupply/{id}', [AgentController::class, 'deleteEachsupply'])->name('delete_Eachsupply')->middleware('check_perm:5');
    Route::get('/agents/search', [AgentController::class, 'search_agents'])->name('agents.search')->middleware('check_perm:5');
    Route::get('/edit_agent/{id}',[AgentController::class, 'edit_agent'])->name('edit_agent')->middleware('check_perm:5');
    Route::post('/update_agent/{id}', [AgentController::class, 'update_agent'])->name('update_agent')->middleware('check_perm:5');
    
    //barren
    Route::get('/barren', [BarrenController::class, 'barren'])->name('barren')->middleware('check_perm:9');
    Route::get('/barren_code', [BarrenController::class, 'barren_code'])->name('barren_code')->middleware('check_perm:9');
    Route::get('/barrenpdf/{code}', [BarrenController::class, 'barrenpdf'])->name('barrenpdf')->middleware('check_perm:9');





    //operating management
    Route::get('/operationStock', 'App\Http\Controllers\OperationStockController@operationStock')->name('operationStock.index')->middleware('check_perm:0');
    Route::get('/operatiaons/addNewOperationStock', 'App\Http\Controllers\OperationStockController@addNewOperationStock')->name('addNewOperationStock.addNewOperation')->middleware('check_perm:0');
    Route::post('/operataions/storeStockOperation', 'App\Http\Controllers\OperationStockController@storeStockOperation')->name('storeStockOperation')->middleware('check_perm:0');
    Route::get('/operationStock/filter', [OperationStockController::class, 'filter'])->name('operationStock.filter')->middleware('check_perm:0');
    Route::get('/operation_stock/search', [OperationStockController::class, 'searchOperationStock'])->name('operation_stock.search')->middleware('check_perm:0');
    Route::get('/edit_operataingStock/{id}', [OperationStockController::class, 'edit_operatingStock'])->name('edit_operatingStock')->middleware('check_perm:0');
    Route::post('/update_operataingStock/{id}', [OperationStockController::class, 'update_operatingStock'])->name('update_operatingStock')->middleware('check_perm:0');
    Route::get('/operation_stockpdf', [OperationStockController::class, 'operation_stockpdf'])->name('operation_stockpdf')->middleware('check_perm:0');
    
    
    Route::get('/operation_scrap', [ScrapOperationContoller::class, 'operation_scrap'])->name('operation_scrap')->middleware('check_perm:2');
    Route::get('/add_operation_scrap', [ScrapOperationContoller::class, 'add_operation_scrap'])->name('add_operation_scrap')->middleware('check_perm:2');
    Route::post('/store_operation_scrap', [ScrapOperationContoller::class, 'store_operation_scrap'])->name('store_operation_scrap')->middleware('check_perm:2');
     Route::get('/edt_operation_scrap/{id}', [ScrapOperationContoller::class, 'edt_operation_scrap'])->name('edt_operation_scrap')->middleware('check_perm:2');
    Route::post('/update_operation_scrap/{id}', [ScrapOperationContoller::class, 'update_operation_scrap'])->name('update_operation_scrap')->middleware('check_perm:2');
    Route::get('/operatingScrapepdfd', [ScrapOperationContoller::class, 'operatingScrapepdfd'])->name('operatingScrapepdfd')->middleware('check_perm:2');
    Route::get('/operation_scrap/search', [ScrapOperationContoller::class, 'searchOperation_scrap'])->name('operation_scrap.search')->middleware('check_perm:2');
    
    
    //Operation Purchas
    Route::get('/operation_purchas',[OperationpurachasController::class, 'operation_purchas'])->name('operation_purchas')->middleware('check_perm:1');;
    Route::get('/add_operation_purchas', [OperationpurachasController::class, 'add_operation_purchas'])->name('add_operation_purchas')->middleware('check_perm:1');;
    Route::post('/store_operation_purchas', [OperationpurachasController::class, 'store_operation_purchas'])->name('store_operation_purchas')->middleware('check_perm:1');;
    Route::get('/edt_operation_purchas/{id}', [OperationpurachasController::class, 'edt_operation_purchas'])->name('edt_operation_purchas')->middleware('check_perm:1');;
    Route::post('/update_operation_purchas/{id}', [OperationpurachasController::class, 'update_operation_purchas'])->name('update_operation_purchas')->middleware('check_perm:1');;
    Route::get('/operation_purchas_pdf', [OperationpurachasController::class, 'operation_purchas_pdf'])->name('operation_purchas_pdf')->middleware('check_perm:1');
    Route::get('/operation_purchas/search', [OperationpurachasController::class, 'searchOperation_purchas'])->name('operation_purchas.search')->middleware('check_perm:1');
    Route::delete('/delete_operation_purchas/{id}', [OperationpurachasController::class, 'delete_operation_purchas'])->name('delete_operation_purchas')->middleware('check_perm:1');

});






require __DIR__ . '/auth.php';
