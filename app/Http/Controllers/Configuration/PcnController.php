<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Pcn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PcnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('view_pcns');
        return view('configuration.pcn.index', [
            'pcns' => Pcn::all()
        ]);
    }

    public function create()
    {
        $this->authorize('create_pcn');
        return view('configuration.pcn.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create_pcn');
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|unique:pcns',
        ]);

        DB::transaction(function () use ($request){
            Pcn::create([
                'name' => $request->name,
                'number' => $request->number
            ]);
        });

        return redirect()->route('configuration.pcn.index')->with('success', 'You have successfully created a new Population Category Number');
    }

    public function edit($id)
    {
        $this->authorize('edit_pcn');
        return view('configuration.pcn.edit', [
            'pcn' => Pcn::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_pcn');
        $pcn = Pcn::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'number' => ['required', 'integer', Rule::unique('pcns')->ignore($pcn->id),],
        ]);

        DB::transaction(function () use ($request, $pcn){
            $pcn->update([
                'name' => $request->name,
                'number' => $request->number
            ]);
        });

        return redirect()->route('configuration.pcn.index')->with('success', 'You have successfully updated the Population Category Number');
    }

    public function destroy($id)
    {
        $this->authorize('delete_pcn');
        $pcn = Pcn::findOrFail($id);
        $pcn->delete();
        return redirect()->route('configuration.pcn.index')->with('success', 'You have successfully deleted the Population Category Number');
    }
}
