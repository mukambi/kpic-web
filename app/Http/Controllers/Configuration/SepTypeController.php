<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\SepType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SepTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('view_sep_types');
        return view('configuration.sep-type.index', [
            'sep_types' => SepType::all()
        ]);
    }

    public function create()
    {
        $this->authorize('create_sep_type');
        return view('configuration.sep-type.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create_sep_type');
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:sep_types',
        ]);

        DB::transaction(function () use ($request){
            SepType::create([
                'name' => $request->name,
                'code' => $request->code
            ]);
        });

        return redirect()->route('configuration.sep-type.index')->with('success', 'You have successfully created a new Service Entry Point Type');
    }

    public function edit($id)
    {
        $this->authorize('edit_sep_type');
        return view('configuration.sep-type.edit', [
            'sep_type' => SepType::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_sep_type');
        $sep_type = SepType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required','string','max:255', Rule::unique('sep_types')->ignore($sep_type->id)],
        ]);

        DB::transaction(function () use ($request, $sep_type){
            $sep_type->update([
                'name' => $request->name,
                'code' => $request->code
            ]);
        });

        return redirect()->route('configuration.sep-type.index')->with('success', 'You have successfully updated the Service Entry Point Type');
    }

    public function destroy($id)
    {
        $this->authorize('delete_sep_type');
        $sep_type = SepType::findOrFail($id);
        $sep_type->delete();
        return redirect()->route('configuration.sep-type.index')->with('success', 'You have successfully deleted the Service Entry Point Type');
    }
}
