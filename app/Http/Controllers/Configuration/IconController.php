<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IconController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index()
    {
        $this->authorize('view_icons');
        return view('configuration.icons.index', [
            'icons' => Icon::orderBy('name')->get()
        ]);
    }

    public function create()
    {
        $this->authorize('create_icon');
        return view('configuration.icons.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create_icon');
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        DB::transaction(function () use ($request) {
            $imageName = $request->name. '_' .time() . '.' . $request->icon->getClientOriginalExtension();
            $request->icon->move(public_path('/icons'), $imageName);
            Icon::create([
                'code' => $request->code,
                'name' => $request->name,
                'image_url' => '/icons/' . $imageName
            ]);
        });

        return redirect()->route('configuration.icons.index')->with('success', 'You have successfully uploaded the image');
    }

    public function edit($id)
    {
        $this->authorize('edit_icon');
        return view('configuration.icons.edit',[
            'icon' => Icon::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_icon');
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);
        $icon = Icon::findOrFail($id);
        DB::transaction(function () use ($request, $icon){
            $icon->update([
                'code' => $request->code,
                'name' => $request->name
            ]);
        });
        return redirect()->route('configuration.icons.index')
            ->with('success', 'You have successfully updated the image name');
    }

    public function destroy($id)
    {
        $this->authorize('delete_icon');
        $icon = Icon::findOrFail($id);
        DB::transaction(function () use ($icon){
            $icon->delete();
        });
        return redirect()->route('configuration.icons.index')
            ->with('success', 'You have successfully deleted the image');
    }
}
