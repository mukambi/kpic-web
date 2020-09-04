@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Users'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('view_system_users')
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Register new user</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Users</h6>
                    <p class="card-description">
                        Below is a list of all users.
                    </p>
                    <div class="table-responsive">
                        <table class="table users">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <a class="text-primary" href="mailto:{{$user->email}}?subject={{ config('app.name') }}">
                                            <u>{{ $user->email }}</u>
                                        </a>
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-success">{{ ucfirst(strtolower($role->name)) }}</span>
                                            @if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".users").DataTable({
                "language": {
                    "emptyTable": "No Users found."
                }
            })
        });
    </script>
@endsection
