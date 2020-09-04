@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs', ['name' => 'Create KPIC Code'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create KPIC Code</h6>
                    <p class="card-description">
                        Fill in the field below to create KPIC code
                    </p>
                    <form action="{{ route('kpic.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="sep_id">{{ __('Service Entry Point') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="sep_id" id="sep_id" class="form-control @error('sep_id') is-invalid @enderror" required>
                                    <option {{ old('sep_id') ? null : "selected" }} disabled>Select Service Entry Point</option>
                                    @foreach($seps as $sep)
                                        <option
                                            {{ old('sep_id') && (old('sep_id') == $sep->id) ? "selected" : null }}
                                            value="{{ $sep->id }}">{{ ucwords(strtolower($sep->name)) }}</option>
                                    @endforeach
                                </select>
                                @error('sep_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="year">{{ __('Year of enrolment') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="year" id="year" class="form-control @error('year') is-invalid @enderror" required>
                                    <option {{ old('year') ? null : "selected" }} disabled>Select Year of enrolment</option>
                                    @foreach($years as $year)
                                        <option
                                            {{ old('year') && (old('year') == $year) ? "selected" : null }}
                                            value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="month">{{ __('Month of enrolment') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="month" id="month" class="form-control @error('month') is-invalid @enderror" required>
                                    <option {{ old('month') ? null : "selected" }} disabled>Select Month of enrolment</option>
                                    @foreach($months as $month)
                                        <option
                                            {{ old('month') && (old('month') == $month) ? "selected" : null }}
                                            value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="first_name">{{ __('First Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                       id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="last_name">{{ __('Last Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                       id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="yob">{{ __('Year of Birth') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('yob') is-invalid @enderror"
                                       id="yob" name="yob" value="{{ old('yob') }}" max="{{ date('Y') }}" required>
                                @error('yob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="pcn_id">{{ __('Population Category') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="pcn_id" id="pcn_id" class="form-control @error('pcn_id') is-invalid @enderror" required>
                                    <option {{ old('pcn_id') ? null : "selected" }} disabled>Select Population Category</option>
                                    @foreach($pcns as $pcn)
                                        <option {{ old('pcn_id') && (old('pcn_id') == $pcn->id) ? "selected" : null }} value="{{ $pcn->id }}">{{ strtoupper($pcn->name) }}</option>
                                    @endforeach
                                </select>
                                @error('pcn_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-actions text-right border-top mt-4">
                            <div class="mt-2">
                                <button type="reset" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                @can('create_pcn')
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent

@endsection
