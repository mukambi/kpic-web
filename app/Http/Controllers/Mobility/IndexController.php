<?php

namespace App\Http\Controllers\Mobility;

use App\AuditTrail;
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
        $this->middleware('active');
    }

    public function index(Request $request)
    {
        $this->authorize('view_mobility_list');
        $trails = [];
        $kpic_code = null;
        if($kpic_code = $request->get('code')){
            $trails = AuditTrail::with('sep.region')
                ->whereHas('patient', function ($query) use($kpic_code){
                    $query->where('kpic_code', $kpic_code);
                })
                ->latest()
                ->get();
        }
        return view('mobility.index', [
            'trails' => $trails,
            'short_kpic_code' => $kpic_code
        ]);
    }
}
