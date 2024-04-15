<?php

namespace App\Http\Controllers;

use App\Models\Scrap;
use App\Models\Po;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\catalogue;
use App\Models\Fixed_supplies;
use App\Models\Each_supplies;
use App\Models\Product;
use Illuminate\Validation\Rule;

class AgentController extends Controller
{
    public function allagent()
    {
        $allagents = Agent::orderBy('created_at', 'desc')->paginate(6);
        $x = 1;
        // dd($suppliers);
        return view('agents.allagent', compact('allagents', 'x'));
    }
    public function add_agent()
    {

        return view('agents.add_agent');
    }
    public function store_agent(Request $request)
    {
        $massage = [];

        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|unique:agents,phone,',
            'email' => 'required|email||unique:agents',
        ], [
            'name.required' => 'حقل اسم العميل مطلوب.',
            'name.string' => 'يجب أن يكون اسم العميل نصًا.',
            'address.required' => 'حقل العنوان مطلوب.',
            'address.string' => 'يجب أن يكون العنوان نصًا.',
            'phone.required' => 'حقل الهاتف مطلوب.',
            'phone.unique' => 'تم استخدام رقم الهاتف من قبل.',
            'phone.max' => 'يجب ألا يزيد رقم الهاتف عن 10 ارقام.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
        ]);

        if ($request->hasFile('price_offer')) {
            $price_offer = $request->file('price_offer');
            $name = $price_offer->getClientOriginalName();
            // Store the file in the 'public/Po' directory
            $path = $price_offer->storeAs('Po', $name, 'public');

            if ($path) {
                $allagents = Agent::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email,
                    'price_offer' => $path  // Save the file path
                ]);

                // Save the record to the database
                $allagents->save();

                return back()->with('done', 'تمت الاضافة');
            }
        }

        // Return back with an error message if file upload fails
        return back()->with('error', 'حدث خطأ أثناء تحميل الملف.');
    }

    public function agent($id)
    {
        $agent = Agent::findOrFail($id);

        $agents_fixed = Fixed_supplies::query()
            ->orderBy('created_at', 'DESC')
            ->where('agent_id', $id)
            ->paginate(8, '*', 'fixedSupPage')->withQueryString();

        $agents_each = Each_supplies::query()
            ->orderBy('created_at', 'DESC')
            ->where('agent_id', $id)
            ->paginate(8, '*', 'eachSupPage')->withQueryString();

        $x = 1;
        $y = 1;
        $products = catalogue::all();

        $pos = Po::orderBy('collection_date', 'ASC')->get();
        // $agentsAll = Agent::all();

        return view('agents.agent', compact('agent', 'products', 'agents_fixed', 'agents_each', 'x', 'y', 'pos'));
    }

    public function store_fixed_supplies(Request $request, $id)
    {


        $messages = [
            'required' => 'هذا الحقل مطلوب',
            'numeric' => 'يجب أن يكون :attribute عددًا',
        ];

        $validatedData = $request->validate([
            'sell_price' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'number_of_product' => 'required|numeric',
        ], $messages);
        $agent = Agent::findOrFail($id);
        $fixed_supplies = '';
        $lists = catalogue::all();
        $cat_name = '';
        foreach ($lists as $li) {
            if ($li->code == $request->pro_num) {
                $cat_name = $li->name;
            }
        }


        if ($agent) {

            $fixed_supplies = Fixed_supplies::create([
                'pro_num' => $request->pro_num,
                'pro_name' => $cat_name,
                'number_of_product' => $request->number_of_product,
                'sell_price' => $request->sell_price,
                'buy_price' => $request->buy_price,

            ]);
        }


        if ($request->number_of_product <= 0) {
            return back()->with('error', 'يجب ان يكون الرقم اكبر من الصفر');
        } elseif ($fixed_supplies) {
            $agent->fixed_supplies()->save($fixed_supplies);
            return back()->with('done', 'تمت الاضافة');
        } else {
            return back()->with('error', 'حدث خطأ أثناء إضافة المواد الثابتة');
        }
    }

    public function store_each_supplies(Request $request, $id)
    {

        $agent = Agent::findOrFail($id);
        $fixed_supplies = '';


        $lists = catalogue::all();
        $cat_name = '';
        foreach ($lists as $li) {
            if ($li->code == $request->pro_num) {
                $cat_name = $li->name;
            }
        }

        if ($agent) {

            foreach ($lists as $list) {
                if ($list->code == $request->pro_num && $list->scrap == 0) {
                    // dd($producs);

                    $producs = Product::where('pro_num', $request->pro_num)->get();
                    $req_num = $request->number_of_product;
                    $savedQuantity = $request->number_of_product;

                    if ($producs->sum('number_of_product') >= $req_num) {
                        foreach ($producs as $product) {
                            if ($product->number_of_product > $req_num) {
                                $product->number_of_product -= $req_num;
                                $product->save();
                                break;
                            } elseif ($product->number_of_product == $req_num) {
                                $product->number_of_product = 0;
                                $product->delete();
                                break;
                            } elseif ($product->number_of_product < $req_num) {
                                $req_num -= $product->number_of_product;
                                $product->number_of_product = 0;
                                $product->delete();
                            }
                        }

                        $each_supplies = Each_supplies::create([
                            'pro_num' => $request->pro_num,
                            'pro_name' => $cat_name,
                            'number_of_product' => $request->number_of_product,
                            'sell_price' => $request->sell_price,
                            'buy_price' => $request->buy_price,
                        ]);
                    } else {
                        return back()->with('error', 'الكمية المطلوبة غير متاحة');
                    }



                } elseif ($list->code == $request->pro_num && $list->scrap == "on") {

                    $scraps = Scrap::where('pro_num', $request->pro_num)->get();
                    $req_num = $request->number_of_product;
                    // $savedQuantity = $request->quantity;

                    if ($scraps->sum('quantity') >= $req_num) {
                        foreach ($scraps as $scrap) {
                            if ($scrap->quantity > $req_num) {
                                $scrap->quantity -= $req_num;
                                $scrap->save();
                                break;
                            } elseif ($scrap->quantity == $req_num) {
                                $scrap->quantity = 0;
                                $scrap->delete();
                                break;
                            } elseif ($scrap->quantity < $req_num) {
                                $req_num -= $scrap->quantity;
                                $scrap->quantity = 0;
                                $scrap->delete();
                            }
                        }

                        $each_supplies = Each_supplies::create([
                            'pro_num' => $request->pro_num,
                            'pro_name' => $cat_name,
                            'number_of_product' => $request->number_of_product,
                            'sell_price' => $request->sell_price,
                            'buy_price' => $request->buy_price,
                        ]);
                    } else {
                        return back()->with('error', 'الكمية المطلوبة غير متاحة');
                    }


                }
            }
        }

        if ($request->number_of_product <= 0) {
            return back()->with('error', 'يجب ان يكون الرقم اكبر من الصفر');
        } elseif ($each_supplies) {
            $agent->each_supplies()->save($each_supplies);
            return back()->with('done', 'تمت الاضافة');
        } else {
            // Handle the case where fixed supplies could not be created
            // dd($fixed_supplies);
            return back()->with('error', 'حدث خطأ أثناء إضافة المواد الثابتة');
        }

    }
    public function edit_fixed_supplies($fixed_supplies_id)
    {
        $fixed_supplies = Fixed_supplies::findOrFail($fixed_supplies_id);
        //  dd($fixed_supplies);
        $products = catalogue::all();
        return view('agents.edit_fixed_supplies', compact('products', 'fixed_supplies'));
    }
    public function update_fixed_supplies(Request $request, $id)
    {
        $fixed_supplies = Fixed_supplies::findOrFail($id);

        $lists = catalogue::all();
        $cat_name = '';
        foreach ($lists as $li) {
            if ($li->code == $request->pro_num) {
                $cat_name = $li->name;
                break; // Break the loop once found
            }
        }

        // Update the fixed supplies
        $fixed_supplies->update([
            'pro_num' => $request->pro_num,
            'pro_name' => $cat_name,
            'number_of_product' => $request->number_of_product,
            'sell_price' => $request->sell_price,
            'buy_price' => $request->buy_price,
        ]);

        // Save the changes\

        $fixed_supplies->save();

        return back()->with('done', 'Fixed supplies updated successfully!');



    }

    public function edit_each_supplies($id)
    {
        $each_supplies = Each_supplies::findOrFail($id);
        // dd($each_supplies);
        $products = catalogue::all();
        return view('agents.edit_each_supplies', compact('products', 'each_supplies'));
    }
    public function update_each_supplies(Request $request, $id)
    {
        $each_supplies = Each_supplies::findOrFail($id);

        $lists = catalogue::all();
        $cat_name = '';
        foreach ($lists as $li) {
            if ($li->code == $request->pro_num) {
                $cat_name = $li->name;
                break; // Break the loop once found
            }
        }

        // Update the fixed supplies
        $each_supplies->update([
            'pro_num' => $request->pro_num,
            'pro_name' => $cat_name,
            'number_of_product' => $request->number_of_product,
            'sell_price' => $request->sell_price,
            'buy_price' => $request->buy_price,
        ]);

        // Save the changes\

        $each_supplies->save();

        return back()->with('done', 'Fixed supplies updated successfully!');



    }

    public function deleteSupply($id)
    {
        // Find the supply by its ID and delete it
        $fixed_supplies = Fixed_supplies::findOrFail($id);
        $fixed_supplies->delete();

        return redirect()->back()->with('done', 'Supply deleted successfully');
    }

    public function deleteEachsupply($id)
    {
        // Find the supply by its ID and delete it
        $each_supplies = Each_supplies::findOrFail($id);
        $each_supplies->delete();

        return redirect()->back()->with('done', 'Supply deleted successfully');
    }

    public function agentspdf()
    {
        $allagents = Agent::get();
        $x = 1;
        return view('agents.agentspdf', compact('allagents'), compact('x'));
    }
    public function search_agents(Request $request)
    {
        $search_agents = $request->input('search_agents');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // $allData = rental::where('pro_name', 'like', '%' . $search_agents . '%')->get();
        $allagents = Agent::where(function ($query) use ($search_agents, $from_date, $to_date) {

            $query->when($search_agents, function ($subQuery) use ($search_agents) {
                $subQuery->Where('name', 'like', '%' . $search_agents . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;
        return view('agents.ajax.search', compact('allagents', 'x'));

    }

    public function fixedsuppliespdf($id)
    {
        $agents_fixed = Fixed_supplies::query()
            ->orderBy('created_at', 'DESC')
            ->where('agent_id', $id)
            ->get();

        $agent_id = $id;
        $x = 1;
        return view('agents.fixedsuppliespdf', compact('agents_fixed', 'x', 'agent_id'));
    }

    public function fixedsupSearch(Request $request)
    {
        $search_fixedsup = $request->input('search_fixedsup');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');


        $agents_fixed = Fixed_supplies::where(function ($query) use ($search_fixedsup, $from_date, $to_date) {

            $query->when($search_fixedsup, function ($subQuery) use ($search_fixedsup) {
                $subQuery->where('number_of_product', 'like', '%' . $search_fixedsup . '%')
                    ->orWhere('pro_name', 'like', '%' . $search_fixedsup . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $x = 1;
        return view('agents.ajax.search_fixed', compact('agents_fixed', 'x'));

    }

    public function eachsuppliespdf($id)
    {
        $agents_each = Each_supplies::query()
            ->orderBy('created_at', 'DESC')
            ->where('agent_id', $id)
            ->get();

        $agent_id = $id;
        $y = 1;
        return view('agents.eachsuppliespdf', compact('agents_each', 'y', 'agent_id'));
    }

    public function eachsupSearch(Request $request)
    {
        $search_eachsup = $request->input('search_eachsup');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');


        $agents_each = Each_supplies::where(function ($query) use ($search_eachsup, $from_date, $to_date) {

            $query->when($search_eachsup, function ($subQuery) use ($search_eachsup) {
                $subQuery->where('number_of_product', 'like', '%' . $search_eachsup . '%')
                    ->orWhere('pro_name', 'like', '%' . $search_eachsup . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();
        $y = 1;
        return view('agents.ajax.search_each', compact('agents_each', 'y'));

    }


    public function edit_agent($id)
    {
        $agent = Agent::findOrFail($id);

        return view('agents.edit_agent', compact('agent'));
    }

    public function update_agent(Request $request, $id)
    {


        $agent = Agent::findOrFail($id);
        if ($agent->email == $request->email) {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'required|unique:agents,phone,' . $agent->id,
                'email' => 'required|email',
            ], [
                'name.required' => 'حقل اسم العميل مطلوب.',
                'name.string' => 'يجب أن يكون اسم العميل نصًا.',
                'address.required' => 'حقل العنوان مطلوب.',
                'address.string' => 'يجب أن يكون العنوان نصًا.',
                'phone.required' => 'حقل الهاتف مطلوب.',
                'phone.unique' => 'تم استخدام رقم الهاتف من قبل.',
                'phone.max' => 'يجب ألا يزيد رقم الهاتف عن 10 ارقام.',
                'email.required' => 'حقل البريد الإلكتروني مطلوب.',
                'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
            ]);
        }else{
            $validatedData = $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'required|unique:agents,phone,' . $agent->id,
                'email' => 'required|email|unique:agents',
            ], [
                'name.required' => 'حقل اسم العميل مطلوب.',
                'name.string' => 'يجب أن يكون اسم العميل نصًا.',
                'address.required' => 'حقل العنوان مطلوب.',
                'address.string' => 'يجب أن يكون العنوان نصًا.',
                'phone.required' => 'حقل الهاتف مطلوب.',
                'phone.unique' => 'تم استخدام رقم الهاتف من قبل.',
                'phone.max' => 'يجب ألا يزيد رقم الهاتف عن 10 ارقام.',
                'email.required' => 'حقل البريد الإلكتروني مطلوب.',
                'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
            ]);
        }
        if ($request->hasFile('price_offer')) {
            $price_offer = $request->file('price_offer');
            $name = $price_offer->getClientOriginalName();
            if ($price_offer->move('Po', $name)) {
                $agent->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email,
                    'price_offer' => $name // Store file name, not file object
                ]);
            }
        } else {
            // If no file uploaded, update agent information without price_offer
            $agent->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email
            ]);
        }

        return back()->with('done', 'Agent updated successfully!');
    }



}