@extends('errors.minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($message ?: 'Forbidden'))
@section('extra')
    <p>
        <a href="{{ route('logout') }}" class="btn btn-danger"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
        >Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    </p>
@endsection
