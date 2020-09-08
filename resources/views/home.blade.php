@extends('layouts.app')

@section('content')
    <div class="row">
        @can('create_kpic')
            <div class="col">
                <a href="{{ route('kpic.create') }}" class="btn btn-large btn-success btn-block" style="height: 100px;">
                    <span class="text-right" style="font-size: 50px;">Generate</span>
                </a>
            </div>
        @endcan
        @can('lookup_kpic')
            <div class="col">
                <a href="{{ route('lookup.create') }}" class="btn btn-large btn-success btn-block" style="height: 100px;">
                    <span class="text-right" style="font-size: 50px;">Lookup</span>
                </a>
            </div>
        @endcan
        @can('view_kpics')
            <div class="col">
                <a href="{{ route('kpic.index') }}" class="btn btn-large btn-success btn-block" style="height: 100px;">
                    <span class="text-right" style="font-size: 50px;">List</span>
                </a>
            </div>
        @endcan
    </div>
@endsection
