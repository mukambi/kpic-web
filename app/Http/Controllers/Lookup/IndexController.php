<?php

namespace App\Http\Controllers\Lookup;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneratesKPIC;
use App\Icon;
use App\Patient;
use App\Pcn;
use App\Sep;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use GeneratesKPIC;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $this->authorize('lookup_kpic');
        return view('lookup.create', [
            'seps' => Sep::all(),
            'months' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            'years' => range(2019, date('Y')),
            'pcns' => Pcn::all(),
            'icons' => Icon::orderBy('name')->get()
        ]);
    }

    public function search(Request $request)
    {
        $this->authorize('lookup_kpic');
        $kpic_code = $this->lookupPatientRecord($request);
        return redirect()->route('lookup.show', [
            'code' => (string) $kpic_code,
            'icon_id' => (string) $request->icon
        ]);
    }

    public function show(Request $request, $code, $icon_id)
    {
        $this->authorize('show_lookup_kpic');
        $patients = Patient::with('sep')
            ->where('kpic_code', $code)
            ->where('icon_id', $icon_id)
            ->get();

        return view('lookup.show', [
            'patients' => $patients
        ]);
    }
}
