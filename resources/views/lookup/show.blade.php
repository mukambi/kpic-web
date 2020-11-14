@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'KPIC Code'])@endcomponent
    <x-kpic-buttons/>
    @if($patient)
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card bd-dark bg-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="text-center">
                                    <h4 class="mb-4">Success! KPIC FOUND</h4>
                                    <h1><strong>{{ $patient->kpic_code }}</strong></h1>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="bg-white text-center">
                                    <img src="{{ $patient->icon->asset_url }}" height="150"
                                         alt="test">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <strong>Created:</strong> {{ ucwords(strtolower($patient->sep->name)) }}
                                </p>
                                <p>
                                    <strong>Created By:</strong> {{ ucwords(strtolower($patient->creator->name)) }}
                                </p>
                                <p>
                                    <strong>Created
                                        On:</strong> {!! $patient->created_at->format('j<\s\up>S</\s\up> F Y')  !!}
                                    at {{ $patient->created_at->format('g:i a') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <p class="pt-2">
                            Not the right person? Click on
                            <a href="{{ route('list.lookup.create') }}" class="text-body"><strong>[Search]</strong></a>
                            and make sure to spell the names <strong>exactly</strong> as they were originally entered
                            and
                            <strong>select the same icon original selected</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card bd-dark bg-danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h4 class="mb-4">KPIC not found</h4>
                                </div>
                                <p class="pt-2">
                                    If you are certain a KPIC has been generated, click on Search and make sure to spell
                                    the
                                    names <strong>exactly</strong> as they were originally entered and select the
                                    <strong>same icon originally selected</strong>.
                                </p>
                                <p class="pt-2">
                                    If you still cannot find the KPIC, generate a new KPIC and mark "potential
                                    duplicate" box.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
    @parent
@endsection
