<?php

namespace App\Http\Controllers;

use App\Http\Traits\ManageFilter;
use App\Notifications\UserRegisteredNotification;
use App\Region;
use App\Sep;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ManageFilter;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $this->authorize('view_system_users');

        $region = null;
        $builder = User::with('roles', 'sep.region')->latest();

        if ($request->has('region')) {
            $region = Region::find($request->input('region'));
            if ($region) {
                $builder = $builder->whereHas('sep.region', function ($query) use ($region) {
                    return $query->where('regions.id', $region->id);
                });
            } else {
                return redirect()->route('users.index')->with('error', 'An error occurred. Try Again!');
            }
        }

        return view('users.index', [
            'users' => $builder->get(),
            'regions' => $this->getAllRegions(),
            'selected_region' => $region
        ]);
    }

    public function create()
    {
        $this->authorize('create_system_users');
        $supported_roles = [];
        foreach (auth()->user()->roles->pluck('name') as $user_role) {
            $supported_roles = array_merge($supported_roles, [
                'super admin' => [
                    'super admin',
                    'admin',
                    'manager',
                    'user'
                ],
                'admin' => [
                    'admin',
                    'manager',
                    'user'
                ],
                'manager' => [
                    'manager',
                    'user'
                ],
                'user' => [
                    'user'
                ]
            ][$user_role]);
        }

        return view('users.create', [
            'roles' => Role::all()->filter(function ($role) use ($supported_roles) {
                return in_array($role->name, $supported_roles);
            }),
            'seps' => Sep::query()->orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create_system_users');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'sep_id' => 'nullable|uuid',
            'roles' => 'required|array'
        ], [], [
            'roles' => 'users role'
        ]);

        DB::transaction(function () use ($request, &$password, &$user) {
            $password = $this->generateRandomString();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($password)
            ]);

            foreach ($request->roles as $name => $value) {
                $role = Role::where('name', $name)->first();
                if ($role) {
                    $user->roles()->save($role);
                }
            }

            if (!is_null($request->sep_id)) {
                $sep = Sep::query()->findOrFail($request->sep_id);
                $sep->users()->save($user);
            }
        });
        $user->notify(new UserRegisteredNotification($password));
        return redirect()->route('users.index')->with('success', 'You have successfully registered a new user. Check your email address to get your login credentials.');
//        return redirect()->route('users.index')->with('success', 'You have successfully registered a new user. Username/Email: ' . $user->email . ', Password: ' . $password);
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function activate(User $user)
    {
        $this->authorize('activate_system_users');

        DB::transaction(function () use ($user) {
            $user->update([
                'activated_at' => now()
            ]);
        });

        return redirect()->back()->with('success', 'You have successfully activated the user');
    }

    public function deactivate(User $user)
    {
        $this->authorize('deactivate_system_users');

        DB::transaction(function () use ($user) {
            $user->update([
                'activated_at' => null
            ]);
        });

        return redirect()->back()->with('success', 'You have successfully deactivated the user');
    }
}
