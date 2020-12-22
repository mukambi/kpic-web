@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs', ['name' => 'Search KPIC'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Search KPIC</h6>
                    <p class="card-description">
                        Fill in the field below to search KPIC
                    </p>
                    <form action="{{ route('list.lookup.search') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 my-2">
                                <h3 class="border-bottom border-primary">User information</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="surname">{{ __('Surname') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                       id="surname" name="surname" value="{{ old('surname') }}" required>
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
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
                            <div class="col-4">
                                <label for="second_name">{{ __('Second Name') }}</label>
                                <input type="text" class="form-control @error('second_name') is-invalid @enderror"
                                       id="second_name" name="second_name" value="{{ old('second_name') }}">
                                @error('second_name')
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
                        <div class="row">
                            <div class="col-12 mt-4 mb-2">
                                <h3 class="border-bottom border-primary">Icons</h3>
                            </div>
                        </div>
                        <div class="row m-auto">
                            @foreach($icons as $icon)
                                <div class="col-4 border">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="icon" value="{{$icon->id}}"
                                                {{ old('icon') && old('icon') == $icon->id ? "checked" : null }}>
                                            {{$icon->name}}
                                        </label>
                                    </div>
                                    <img src="{{$icon->asset_url}}" alt="{{$icon->name}}" height="100">
                                </div>
                            @endforeach
                        </div>
                        <div class="form-actions text-right border-top mt-4">
                            <div class="mt-2">
                                <button type="reset" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                @can('lookup_kpic')
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Search
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
