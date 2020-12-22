<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('auth.passwords.change');
    }

    public function deactivate(User $user=null)
    {
        $this->authorize('reset_user_password');

        DB::transaction(function () use ($user){
            if ($user){
                $user->update([
                    'password_activated_at' => null
                ]);
            } else {
                foreach (User::all()->filter(function ($user){
                    return auth()->id() != $user->id;
                }) as $user){
                    $user->update([
                        'password_activated_at' => null
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'You have successfully rest user\'s password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($request){
            $request->user()->update([
                'password' => Hash::make($request->password),
                'password_activated_at' => now()
            ]);
        });

        return redirect(RouteServiceProvider::HOME)->with('success', 'You have successfully changed your password');
    }
}
