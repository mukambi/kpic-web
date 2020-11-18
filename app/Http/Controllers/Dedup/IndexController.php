<?php

namespace App\Http\Controllers\Dedup;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneratesKPIC;
use App\Http\Traits\ManageFilter;
use App\Lookup;
use App\Patient;
use App\Region;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use GeneratesKPIC, ManageFilter;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $this->authorize('view_dedup_reports');

        $region = null;
        $builder = Patient::with('sep.region')
            ->where('possible_duplicate', true)
            ->latest();

        if ($request->has('region')) {
            $region = Region::find($request->input('region'));
            if ($region) {
                $builder = $builder->whereHas('sep.region', function ($query) use ($region) {
                    return $query->where('regions.id', $region->id);
                });
            } else {
                return redirect()->route('dedup.index')->with('error', 'An error occurred. Try Again!');
            }
        }

        return view('dedup.index', [
            'patients' => $builder->get(),
            'regions' => $this->getAllRegions(),
            'selected_region' => $region
        ]);
    }
}
