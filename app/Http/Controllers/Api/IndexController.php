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
        $this->middleware('active');
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

    public function store(Request $request)
    {
        $this->authorize('api_generate_kpic');
        $this->validateStore($request);
        $creator = $request->user();
        $sep = Sep::find($request->sep_id);
        $patient = Patient::create([
            'kpic_code' => $request->kpic_code,
            'sep_id' => $sep->id,
            'icon_id' => $request->icon_id,
            'possible_duplicate' => $request->possible_duplicate,
            'creator_id' => $creator->id
        ]);
        $this->storeTrail($patient, $sep, 'Generated', $creator);
        return response()->json($patient);
    }

    public function validateStore(Request $request): void
    {
        $request->validate([
            'kpic_code' => 'required|string',
            'sep_id' => 'required|exists:seps,id',
            'icon_id' => 'required|exists:icons,id',
            'possible_duplicate' => 'required|boolean'
        ]);
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
        return response()->json(Sep::with('type', 'region')->get());
    }

    public function user(Request $request)
    {
        return response()->json($request->user()->load('sep'));
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
