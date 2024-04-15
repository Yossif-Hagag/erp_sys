<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->phone = $request->phone;        
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function add_admin() : View {
        return view('profile.add_admin');
    }

    public function store_admin(Request $request) : RedirectResponse
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'. Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'numeric'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ];

        $admin = Admin::create($data);
        $admin->save();

        return back()->with('done', 'تمت الاضافة');

    }
    
    public function admins() : View {
        $admins = Admin::whereNotNull('name')->orderby('id','asc')->paginate(6);
        return view('profile.admins',compact('admins'));
    }
    
    public function del_admin($id) : RedirectResponse
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        
        return back()->with('done', 'تم الحذف');
    }
    
    public function edt_admin($id) : View {
        $admin = Admin::findOrFail($id);
        return view('profile.edt_admin',compact('admin'));
    }

    public function update_admin(Request $request,$id) : RedirectResponse
    {
        // dd($request);
        $admin = Admin::findOrFail($id);
        if ($admin->email == $request->email) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
                'phone' => ['required', 'numeric'],
            ]);
        }else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'. Admin::class],
                'password' => ['required', Rules\Password::defaults()],
                'phone' => ['required', 'numeric'],
            ]);
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->phone = $request->phone;
        $admin->save();

        return back()->with('done', 'تم التعديل');

    }

}
