<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;

class CredentialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function index()
    {
        $this->authorize('view_api_tokens');
        return view('configuration.api-token.index', [
            'credential' => Passport::client()->latest()->first()
        ]);
    }
}
