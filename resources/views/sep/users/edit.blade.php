@extends('layouts.app')
@section('css')
    @parent
@endsection
@section('content')
    @component('layouts.components.breadcrumbs', ['name' => 'Add or Edit Service Entry Point Users'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add or Edit Service Entry Point Users</h6>
                    <p class="card-description">
                        Fill in the field below to edit the Service Entry Point
                    </p>
                    <form action="{{ route('seps.users.update', ['id' => $sep->id ]) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-12 mt-3">
                                <p>Choose the users for the given Service entry point</p>
                                @foreach($users as $user)
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="users[{{$user->id}}]" {{ in_array($user->id, $sep->users->pluck('id')->toArray()) ? "checked" : null }}>
                                            {{ $user->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-actions text-right border-top">
                            <div class="mt-2">
                                <button type="reset" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                @can('edit_sep_users')
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
