@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Edit User Details'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit {{ $user->name }} Role</h6>
                    <p class="card-description">
                        Fill in the field below to edit the user
                    </p>
                    <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-6">
                                <label for="name">{{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') ?: $user->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="email">{{ __('Email') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') ?: $user->email }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <p>Choose the users roles <span class="text-danger">*</span></p>
                                @foreach($roles as $role)
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="roles[{{$role->name}}]" {{ old('roles.' . $role->name) ? 'checked' : (in_array($role->name, $user_roles) ? 'checked' : null) }}>
                                            {{ ucfirst(strtolower($role->name)) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="sep_id">{{ __('Select Service Entry Provider') }}<span class="text-danger">*</span></label>
                                <select name="sep_id" id="sep_id" class="form-control @error('sep_id') is-invalid @enderror" required>
                                    <option {{ old('sep_id') ? null : "selected" }} disabled>Select Service Entry Provider</option>
                                    @foreach($seps as $sep)
                                        <option {{ old('sep_id') ? (old('sep_id') == $sep->id ? 'selected' : null) : ($user->sep && $user->sep->id == $sep->id ? 'selected' : null) }} value="{{ $sep->id }}">{{ $sep->name }}</option>
                                    @endforeach
                                </select>
                                @error('sep_id')
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
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
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
