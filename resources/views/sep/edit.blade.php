@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Edit Service Entry Point'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Service Entry Point</h6>
                    <p class="card-description">
                        Fill in the field below to edit the Service Entry Point
                    </p>
                    <form action="{{ route('seps.update', ['id' => $sep->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">{{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') ?: $sep->name }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="type_id">{{ __('Type') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" required>
                                    <option {{ old('type_id') || $sep->location ? null : "selected" }} disabled>Select Type</option>
                                    @foreach($sep_types as $sep_type)
                                        <option
                                            {{ old('type_id')
                                                ? (old('type_id') == $sep_type->id ? "selected" : null)
                                                : ($sep->type->id == $sep_type->id ? "selected" : null)
                                            }} value="{{ $sep_type->id }}">{{ ucfirst(strtolower($sep_type->name)) }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="code">{{ __('Facility Code') }}</label>
                                <input type="number" class="form-control @error('code') is-invalid @enderror"
                                       id="code" name="code" value="{{ old('code') ?: $sep->code }}">
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="region_id">{{ __('Region') }}</label>
                                <select name="region_id" id="region_id" class="form-control @error('region_id') is-invalid @enderror">
                                    <option {{ old('region_id') || ($sep->region && $sep->region->id) ? null : "selected" }} disabled>Select Region</option>
                                    @foreach($regions as $region)
                                        <option
                                            {{ old('region_id')
                                                ? (old('region_id') == $region->id ? "selected" : null)
                                                : ($sep->region && ($sep->region->id == $region->id) ? "selected" : null)
                                            }} value="{{ $region->id }}">{{ ucwords(strtolower($region->name)) }}</option>
                                    @endforeach
                                </select>
                                @error('region_id')
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
                                @can('edit_sep')
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Update
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
