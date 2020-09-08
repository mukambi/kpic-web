<?php

namespace App\Http\Controllers\Dedup;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneratesKPIC;
use App\Lookup;
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
            'lookups' => Lookup::with('patient.sep')->latest()->get()
        ]);
    }
}
