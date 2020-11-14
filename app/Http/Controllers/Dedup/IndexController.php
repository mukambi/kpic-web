<?php

namespace App\Http\Controllers\Dedup;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneratesKPIC;
use App\Lookup;
use App\Patient;
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
        $this->authorize('view_dedup_reports');
        return view('dedup.index', [
            'patients' => Patient::with('sep.region')
                ->where('possible_duplicate', true)
                ->latest()
                ->get()
        ]);
    }
}
