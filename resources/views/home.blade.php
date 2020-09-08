@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('kpic.create') }}" class="btn btn-large btn-success btn-block" style="height: 100px;">
                <span class="text-right" style="font-size: 50px;">Generate</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('lookup.create') }}" class="btn btn-large btn-success btn-block" style="height: 100px;">
                <span class="text-right" style="font-size: 50px;">Lookup</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('kpic.index') }}" class="btn btn-large btn-success btn-block" style="height: 100px;">
                <span class="text-right" style="font-size: 50px;">List</span>
            </a>
        </div>
    </div>
@endsection
