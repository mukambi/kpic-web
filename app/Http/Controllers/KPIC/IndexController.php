<?php

namespace App\Http\Controllers\KPIC;

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

    public function index()
    {
        $this->authorize('view_kpics');
        return view('kpic.index', [
            'patients' => Patient::with('sep')->get()
        ]);
    }

    public function create()
    {
        $this->authorize('create_kpic');
        return view('kpic.create',[
            'seps' => Sep::all(),
            'months' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            'years' => range(2019,date('Y')),
            'pcns' => Pcn::all(),
            'icons' => Icon::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create_kpic');
        $patient = $this->createPatientRecord($request);
        return redirect()->route('kpic.index')->with('success', 'You have successfully generated KPIC code of ' . $patient->kpic_code);
    }
}
