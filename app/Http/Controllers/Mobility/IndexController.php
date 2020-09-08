<?php

namespace App\Http\Controllers\Mobility;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneratesKPIC;
use App\Patient;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use GeneratesKPIC;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('view_mobility_list');
        $patients = [];
        $kpic_code = null;
        if($kpic_code = $request->get('code')){
            $patients = Patient::with('sep')
                ->where('kpic_code', $kpic_code)
                ->get();
            $this->storeTrailsAndLookups($request, $patients);
        }
        return view('mobility.index', [
            'patients' => $patients,
            'short_kpic_code' => $kpic_code
        ]);
    }
}
