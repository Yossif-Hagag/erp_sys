<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Perm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    public function users(): View
    {
        $users = User::orderBy('created_at', 'desc')->paginate(8);
        $x = 1;
        return view('users.users', compact('users', 'x'));
    }
    public function add_user(): View
    {
        return view('users.add_user');
    }

    public function store_user(Request $request): RedirectResponse
    {
        $massage = [
        ];
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'job_type' => 'required',
            'phone' => ['required', 'unique:' . User::class],
            'salary' => 'required|numeric',
            'holidays' => 'required|numeric',
            'holi_rest' => 'required|numeric',
            'over_time' => 'required|numeric',
            'emp_file' => 'mimes:pdf|max:10000',
        ], $massage);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'job_type' => $request->job_type,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'holidays' => $request->holidays,
            'holi_rest' => $request->holi_rest,
            'over_time' => $request->over_time,
            'emp_file' => $request->file('emp_file')->storeAs('/empFiles', $request->file('emp_file')->getClientOriginalName()),
        ]);

        $user->save();

        //////////////////////configure permissions////////////////////////////
        $roles = ['stock', 'purchas', 'scrap', 'rental', 'users', 'agents', 'po', 'po_collected', 'custody', 'barren', 'prochis', 'catalogue','quotations'];
        foreach ($roles as $role) {
            $perm = Perm::create([
                'agent_id' => $user->id,
                'role' => $role,
                'perm' => null,
            ]);
            $perm->save();
        }

        return back()->with('done', 'تمت الاضافة');
    }

    public function edt_user($id): View
    {
        $user = User::findOrFail($id);
        return view('users.edt_user', compact('user'));
    }

    public function update_user(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $massage = [
        ];

        if ($request->email == $user->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
            ], $massage);
        } else {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            ], $massage);
        }

        if ($request->phone == $user->phone) {
            $request->validate([
                'phone' => ['required'],
            ], $massage);
        } else {
            $request->validate([
                'phone' => ['required', 'unique:' . User::class],
            ], $massage);
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', Rules\Password::defaults()],
            'job_type' => 'required',
            'salary' => 'required|numeric',
            'holidays' => 'required|numeric',
            'holi_rest' => 'required|numeric',
            'over_time' => 'required|numeric',
            'emp_file' => 'mimes:pdf|max:10000',
        ], $massage);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'job_type' => $request->job_type,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'holidays' => $request->holidays,
            'holi_rest' => $request->holi_rest,
            'over_time' => $request->over_time,
        ]);

        if ($request->hasFile('emp_file')) {
            Storage::delete($user->emp_file);
            $user->update([
                'emp_file' => $request->file('emp_file')->storeAs('/empFiles', $request->file('emp_file')->getClientOriginalName()),
            ]);
        }

        // dd($user);
        $user->save();
        return back()->with('edtdone', 'تم التعديل');
    }

    public function searchuser(Request $request)
    {
        $user_keyword = $request->input('user_keyword');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $users = User::where(function ($query) use ($user_keyword, $from_date, $to_date) {

            $query->when($user_keyword, function ($subQuery) use ($user_keyword) {
                $subQuery->where('name', 'like', '%' . $user_keyword . '%')
                    ->orWhere('job_type', 'like', '%' . $user_keyword . '%');
            });

            $query->when($from_date, function ($subQuery) use ($from_date) {
                $subQuery->whereDate('created_at', '>=', $from_date);
            });

            $query->when($to_date, function ($subQuery) use ($to_date) {
                $subQuery->whereDate('created_at', '<=', $to_date);
            });

        })->orderBy('created_at', 'desc')->get();

        $x = 1;
        return view('users.ajax.search', compact('users', 'x'));

    }

    public function userspdf()
    {
        $users = User::all();
        $x = 1;
        return view('users.userspdf', compact('users', 'x'));
    }
    public function user_perm($id)
    {
        $user = User::findOrFail($id);
        $role_stock = Perm::where('agent_id', $id)->where('role', 'stock')->get();
        $role_purchas = Perm::where('agent_id', $id)->where('role', 'purchas')->get();
        $role_scrap = Perm::where('agent_id', $id)->where('role', 'scrap')->get();
        $role_rental = Perm::where('agent_id', $id)->where('role', 'rental')->get();
        $role_users = Perm::where('agent_id', $id)->where('role', 'users')->get();
        $role_agents = Perm::where('agent_id', $id)->where('role', 'agents')->get();
        $role_po = Perm::where('agent_id', $id)->where('role', 'po')->get();
        $role_po_collected = Perm::where('agent_id', $id)->where('role', 'po_collected')->get();
        $role_custody = Perm::where('agent_id', $id)->where('role', 'custody')->get();
        $role_barren = Perm::where('agent_id', $id)->where('role', 'barren')->get();
        $role_prochis = Perm::where('agent_id', $id)->where('role', 'prochis')->get();
        $role_catalogue = Perm::where('agent_id', $id)->where('role', 'catalogue')->get();
        $role_quotations = Perm::where('agent_id', $id)->where('role', 'quotations')->get();

        return view(
            'users.user_perm',
            compact(
                'user',
                'role_stock',
                'role_purchas',
                'role_scrap',
                'role_rental',
                'role_users',
                'role_agents',
                'role_po',
                'role_po_collected',
                'role_custody',
                'role_barren',
                'role_prochis',
                'role_catalogue',
                'role_quotations',
            )
        );
    }
    public function update_user_perm($id, Request $request)
    {
        $stock = 'stock' . $id;
        $purchas = 'purchas' . $id;
        $scrap = 'scrap' . $id;
        $rental = 'rental' . $id;
        $users = 'users' . $id;
        $agents = 'agents' . $id;
        $po = 'po' . $id;
        $po_collected = 'po_collected' . $id;
        $custody = 'custody' . $id;
        $barren = 'barren' . $id;
        $prochis = 'prochis' . $id;
        $catalogue = 'catalogue' . $id;
        $quotations = 'quotations' . $id;


        $roles = ['stock', 'purchas', 'scrap', 'rental', 'users', 'agents', 'po', 'po_collected', 'custody', 'barren', 'prochis', 'catalogue','quotations'];
        $perms = [$stock, $purchas, $scrap, $rental, $users, $agents, $po, $po_collected, $custody, $barren, $prochis, $catalogue,$quotations];
        $x = 0;

        Perm::where('agent_id', $id)->delete();

        foreach ($roles as $role) {
            $perm = Perm::create([
                'agent_id' => $id,
                'role' => $role,
                'perm' => $request->{$perms[$x]},
            ]);
            $perm->save();
            $x++;
        }

        return back()->with('edtdone', 'تم التعديل');
    }

}
