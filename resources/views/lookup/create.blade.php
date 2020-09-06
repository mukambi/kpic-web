@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs', ['name' => 'Lookup KPIC Code'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Lookup KPIC Code</h6>
                    <p class="card-description">
                        Fill in the field below to lookup KPIC code
                    </p>
                    <form action="{{ route('lookup.search') }}" method="post">
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
                            <div class="col-6">
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
                            <div class="col-6">
                                <label for="mob">{{ __('Month of Birth') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="mob" id="mob" class="form-control @error('mob') is-invalid @enderror" required>
                                    <option {{ old('mob') ? null : "selected" }} disabled>Select Month of Birth</option>
                                    @foreach($months as $month)
                                        <option
                                            {{ old('mob') && (old('mob') == $month) ? "selected" : null }}
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
                        <div class="form-actions text-right border-top mt-4">
                            <div class="mt-2">
                                <button type="reset" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                @can('lookup_kpic')
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Lookup
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
