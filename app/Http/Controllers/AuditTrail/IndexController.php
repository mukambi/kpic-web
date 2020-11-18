<?php

namespace App\Http\Controllers\AuditTrail;

use App\AuditTrail;
use App\Http\Controllers\Controller;
use App\Http\Traits\ManageFilter;
use App\Region;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use ManageFilter;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $this->authorize('view_kpic_list');

        $region = null;
        $builder = AuditTrail::with('patient.sep.region')->latest();

        if ($request->has('region')) {
            $region = Region::find($request->input('region'));
            if ($region) {
                $builder = $builder->whereHas('patient.sep.region', function ($query) use ($region) {
                    return $query->where('regions.id', $region->id);
                });
            } else {
                return redirect()->route('list.index')->with('error', 'An error occurred. Try Again!');
            }
        }
        return view('audit-trail.index', [
            'trails' => $builder->get(),
            'regions' => $this->getAllRegions(),
            'selected_region' => $region
        ]);
    }
}
