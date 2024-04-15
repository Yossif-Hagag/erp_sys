<?php

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

function checkPerm($x)
{
    if (Auth::guard('admin')->check()) {
        return ;
    }else{
        $role_stock = Perm::where('agent_id', Auth::user()->id)->where('role', 'stock')->get();
        $role_purchas = Perm::where('agent_id', Auth::user()->id)->where('role', 'purchas')->get();
        $role_scrap = Perm::where('agent_id', Auth::user()->id)->where('role', 'scrap')->get();
        $role_rental = Perm::where('agent_id', Auth::user()->id)->where('role', 'rental')->get();
        $role_users = Perm::where('agent_id', Auth::user()->id)->where('role', 'users')->get();
        $role_agents = Perm::where('agent_id', Auth::user()->id)->where('role', 'agents')->get();
        $role_po = Perm::where('agent_id', Auth::user()->id)->where('role', 'po')->get();
        $role_po_collected = Perm::where('agent_id', Auth::user()->id)->where('role', 'po_collected')->get();
        $role_custody = Perm::where('agent_id', Auth::user()->id)->where('role', 'custody')->get();
        $role_barren = Perm::where('agent_id', Auth::user()->id)->where('role', 'barren')->get();
        $role_prochis = Perm::where('agent_id', Auth::user()->id)->where('role', 'prochis')->get();
        $role_catalogue = Perm::where('agent_id', Auth::user()->id)->where('role', 'catalogue')->get();
        $role_quotations = Perm::where('agent_id', Auth::user()->id)->where('role', 'quotations')->get();
        
        $perms = [
            $role_stock[0]->perm,
            $role_purchas[0]->perm,
            $role_scrap[0]->perm,
            $role_rental[0]->perm,
            $role_users[0]->perm,
            $role_agents[0]->perm,
            $role_po[0]->perm,
            $role_po_collected[0]->perm,
            $role_custody[0]->perm,
            $role_barren[0]->perm,
            $role_prochis[0]->perm,
            $role_catalogue[0]->perm,
            $role_quotations[0]->perm
        ];
        return $perms[$x];
    }
}

