@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs', ['name' => 'Add Population Category Number'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Population Category Number</h6>
                    <p class="card-description">
                        Fill in the field below to register a new Population Category Number
                    </p>
                    <form action="{{ route('configuration.pcn.save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
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
                            <div class="col-6">
                                <label for="number">{{ __('Number') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('number') is-invalid @enderror"
                                       id="number" name="number" value="{{ old('number') }}" required>
                                @error('number')
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
