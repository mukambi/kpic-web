<?php

namespace App\Http\Controllers;

use App\Notifications\UserRegisteredNotification;
use App\Sep;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('view_system_users');
        return view('users.index',[
            'users' => User::with('roles')->get()
        ]);
    }

    public function create()
    {
        $this->authorize('create_system_users');
        return view('users.create', [
            'roles' => Role::all(),
            'seps' => Sep::query()->orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create_system_users');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'sep_id' => 'nullable|uuid'
        ]);

        DB::transaction(function () use ($request, &$password, &$user){
            $password = $this->generateRandomString();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($password)
            ]);

            foreach ($request->roles as $name=>$value){
                $role = Role::where('name', $name)->first();
                if($role){
                    $user->roles()->save($role);
                }
            }

            if(!is_null($request->sep_id)){
                $sep = Sep::query()->findOrFail($request->sep_id);
                $sep->users()->save($user);
            }
        });

//        $user->notify(new UserRegisteredNotification($password));
        return redirect()->route('users.index')->with('success', 'You have successfully registered a new user. Username/Email: ' . $user->email . ', Password: ' . $user->password);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
