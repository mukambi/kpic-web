<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneratesKPIC;
use App\Icon;
use App\Patient;
use App\Pcn;
use App\Sep;
use App\SepType;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use GeneratesKPIC;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function lookup(Request $request)
    {
        $this->authorize('api_lookup_kpic');
        $kpic_code = $this->lookupPatientRecord($request);
        $patients = Patient::with('sep')
            ->where('kpic_code', $kpic_code)
            ->where('icon_id', $request->icon)
            ->get();
        $this->storeTrailsAndLookups($request, $patients);
        return response()->json($patients);
    }

    public function generate(Request $request)
    {
        $this->authorize('api_generate_kpic');
        $patient = $this->createPatientRecord($request);
        return response()->json($patient);
    }

    public function pcns()
    {
        $this->authorize('api_get_pcns');
        return response()->json(Pcn::all('id', 'name', 'number'));
    }

    public function seps()
    {
        $this->authorize('api_get_seps');
        return response()->json(Sep::with('type')->get());
    }

    public function sepsTypes()
    {
        $this->authorize('api_get_seps_types');
        return response()->json(SepType::all('id', 'name', 'code'));
    }

    public function icons()
    {
        $this->authorize('api_get_icons');
        return response()->json(Icon::orderBy('name')->get());
    }
}
