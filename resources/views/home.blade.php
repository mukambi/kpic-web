@extends('layouts.app')

@section('content')
    <div class="row">
        @can('create_kpic')
            <div class="col-12 my-3">
                <a href="{{ route('list.kpic.create') }}" class="btn btn-large btn-block" style="height: 100px;background-color: #717CF5;border-color: #717CF5;">
                    <span class="text-right text-white" style="font-size: 50px;">Generate</span>
                </a>
            </div>
        @endcan
        @can('lookup_kpic')
            <div class="col-12 my-3">
                <a href="{{ route('list.lookup.create') }}" class="btn btn-large btn-block" style="height: 100px;background-color: #0FB759;border-color: #0FB759;">
                    <span class="text-right text-white" style="font-size: 50px;">Search</span>
                </a>
            </div>
        @endcan
        @can('view_kpic_list')
            <div class="col-12 my-3">
                <a href="{{ route('list.index') }}" class="btn btn-large btn-block" style="height: 100px;background-color: #F9FAFB;border-color: #000000;">
                    <span class="text-right" style="font-size: 50px;">List</span>
                </a>
            </div>
        @endcan
    </div>
@endsection
