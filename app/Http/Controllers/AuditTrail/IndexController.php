<?php

namespace App\Http\Controllers\AuditTrail;

use App\AuditTrail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index()
    {
        $this->authorize('view_kpic_list');
        return view('audit-trail.index', [
            'trails' => AuditTrail::with('patient.sep.region')->latest()->get()
        ]);
    }
}
