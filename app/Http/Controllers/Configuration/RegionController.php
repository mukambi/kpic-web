<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Region;
use App\SepType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index()
    {
        $this->authorize('view_regions');
        return view('configuration.regions.index', [
            'regions' => Region::all()
        ]);
    }

    public function create()
    {
        $this->authorize('create_region');
        return view('configuration.regions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create_region');
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request){
            Region::create([
                'name' => $request->name
            ]);
        });

        return redirect()->route('configuration.regions.index')->with('success', 'You have successfully created a region');
    }

    public function edit($id)
    {
        $this->authorize('edit_region');
        return view('configuration.regions.edit', [
            'region' => Region::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_region');
        $region = Region::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request, $region){
            $region->update([
                'name' => $request->name
            ]);
        });

        return redirect()->route('configuration.regions.index')->with('success', 'You have successfully updated the region');
    }

    public function destroy($id)
    {
        $this->authorize('delete_region');
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect()->route('configuration.regions.index')->with('success', 'You have successfully deleted the region');
    }
}
