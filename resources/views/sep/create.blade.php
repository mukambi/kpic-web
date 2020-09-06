@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Add Service Entry Point'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Service Entry Point</h6>
                    <p class="card-description">
                        Fill in the field below to register a new Service Entry Point
                    </p>
                    <form action="{{ route('seps.save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="name">{{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="code">{{ __('Facility Code') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('code') is-invalid @enderror"
                                       id="code" name="code" value="{{ old('code') }}" required>
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="location">{{ __('Location') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       id="location" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="type_id">{{ __('Type') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="type_id" id="type_id" class="form-control @error('type') is-invalid @enderror" required>
                                    <option {{ old('type_id') ? null : "selected" }} disabled>Select Type</option>
                                    @foreach($sep_types as $sep_type)
                                        <option {{ old('type_id') && (old('type_id') == $sep_type->id) ? "selected" : null }} value="{{ $sep_type->id }}">{{ ucfirst(strtolower($sep_type->name)) }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="geocode">{{ __('Geocode') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('geocode') is-invalid @enderror"
                                       id="geocode" name="geocode" value="{{ old('geocode') }}">
                                @error('geocode')
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
                                @can('create_sep')
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
