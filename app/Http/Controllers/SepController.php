<?php

namespace App\Http\Controllers;

use App\Sep;
use App\SepType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('view_seps');
        return view('sep.index', [
            'seps' => Sep::with('type', 'users')->get()
        ]);
    }

    public function create()
    {
        $this->authorize('create_sep');
        return view('sep.create', [
            'sep_types' => SepType::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create_sep');
        $request->validate([
            'location' => 'required|string|max:255',
            'code' => 'required|integer|unique:seps',
            'name' => 'required|string|max:255',
            'type_id' => 'required|uuid',
            'geocode' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {
            Sep::create([
                'location' => $request->location,
                'name' => $request->name,
                'code' => $request->code,
                'type_id' => $request->type_id,
                'geocode' => $request->geocode
            ]);
        });

        return redirect()
            ->route('seps.index')
            ->with('success', 'You have successfully added a new service entry point');
    }

    public function edit($id)
    {
        $this->authorize('edit_sep');
        return view('sep.edit', [
            'sep_types' => SepType::all(),
            'sep' => Sep::with('type')->findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_sep');
        $sep = Sep::findOrFail($id);
        $request->validate([
            'location' => 'required|string|max:255',
            'code' => ['required', 'integer', Rule::unique('seps')->ignore($sep->id)],
            'name' => 'required|string|max:255',
            'type_id' => 'required|uuid',
            'geocode' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $sep) {
            $sep->update([
                'location' => $request->location,
                'name' => $request->name,
                'code' => $request->code,
                'type_id' => $request->type_id,
                'geocode' => $request->geocode
            ]);
        });

        return redirect()
            ->route('seps.index')
            ->with('success', 'You have successfully updated the service entry point');
    }

    public function editUsers($id)
    {
        $this->authorize('edit_sep_users');
        return view('sep.users.edit', [
            'sep' => $sep = Sep::with('users')->findOrFail($id),
            'users' => User::all()
        ]);
    }

    public function updateUsers(Request $request, $id)
    {
        $this->authorize('edit_sep_users');
        DB::transaction(function () use ($request, $id){
            $sep = Sep::findOrFail($id);
            if(is_array($request->users) && count($request->users)){
                $sep->users()->sync(array_keys($request->users));
            } else {
                $sep->users()->sync([]);
            }
        });

        return redirect()->route('seps.users.edit', ['id' => $id])
            ->with('success', 'You have successfully added/edited the Service Entry Point Users');
    }
}
