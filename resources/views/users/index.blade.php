@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endsection
@section('content')
    @if(count($regions))
        <div class="row">
            <div class="mr-auto">
                <div class="col mb-4">
                    <nav class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ 'Users' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="ml-auto">
                <div class="col mb-4">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $selected_region ? ucwords(strtolower($selected_region->name)) : 'Select Region' }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item {{ $selected_region  ? null : 'active'}}"
                               href="{{ route('users.index') }}">All Regions</a>
                            @foreach($regions as $region)
                                <a class="dropdown-item {{ $selected_region && ($selected_region->id == $region->id) ? 'active' : null }}"
                                   href="{{ route('users.index', ['region' => $region->id]) }}">{{ ucwords(strtolower($region->name)) }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('view_system_users')
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Register new user</a>
                    @endcan
                    @can('reset_user_password')
                        <a href="{{ route('password.deactivate') }}" class="btn btn-outline-danger">Reset All
                            Password</a>
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
                                <th>Service Entry Point</th>
                                <th>Region</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Service Entry Point</th>
                                <th>Region</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <a class="text-primary"
                                           href="mailto:{{$user->email}}?subject={{ config('app.name') }}">
                                            <u>{{ $user->email }}</u>
                                        </a>
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span
                                                class="badge badge-success">{{ ucfirst(strtolower($role->name)) }}</span>
                                            @if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($user->sep)
                                            <span>{{ $user->sep->name }}</span>
                                        @else
                                            <span class="text-danger">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($user->sep->region))
                                            <span>{{ $user->sep->region->name }}</span>
                                        @else
                                            <span class="text-danger">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->id != auth()->id())
                                            @can('reset_user_password')
                                                <a href="{{ route('password.deactivate', ['user' => $user]) }}"
                                                   class="btn btn-outline-danger">Reset Password</a>
                                            @endcan
                                            @if(!$user->isActivated())
                                                @can('activate_system_users')
                                                    <a class="btn btn-success" href="#"
                                                       onclick="event.preventDefault();
                                                           document.getElementById('activate-user-{{$user->id}}').submit();">
                                                        Activate
                                                    </a>
                                                    <form id="activate-user-{{$user->id}}"
                                                          action="{{ route('users.activate', ['user' => $user]) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                @endcan
                                            @else
                                                @can('deactivate_system_users')
                                                    <a class="btn btn-danger" href="#"
                                                       onclick="event.preventDefault();
                                                           document.getElementById('deactivate-user-{{$user->id}}').submit();">
                                                        Deactivate
                                                    </a>
                                                    <form id="deactivate-user-{{$user->id}}"
                                                          action="{{ route('users.deactivate', ['user' => $user]) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                @endcan
                                            @endif
                                        @else
                                            <a href="{{ route('password.change') }}" class="btn btn-outline-success">Change My Password</a>
                                        @endif
                                    </td>
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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".users").DataTable({
                language: {
                    "emptyTable": "No Users found.",
                    "search": "Search Table:"
                },
                lengthMenu: @json(config('settings.pagination_length')),
                dom: 'Bfrtip',
                renderer: 'bootstrap',
                buttons: [
                    'pageLength',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            })
        });
    </script>
@endsection
