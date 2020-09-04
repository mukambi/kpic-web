@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Users'])@endcomponent

@endsection
@section('js')
    @parent

@endsection
