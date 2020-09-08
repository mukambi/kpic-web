@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Service Entry Points'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('create_sep')
                        <a href="{{ route('seps.create') }}" class="btn btn-primary">Add new Service Entry Point</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Service Entry Points</h6>
                    <p class="card-description">
                        Below is a list of all Service Entry Points.
                    </p>
                    <div class="table-responsive">
                        <table class="table seps">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Users</th>
                                <th>Geocode</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Users</th>
                                <th>Geocode</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($seps as $sep)
                                <tr>
                                    <td>{{ $sep->location }}</td>
                                    <td>{{ $sep->name }}</td>
                                    <td>{{ $sep->code }}</td>
                                    <td>{{ $sep->type->name }}</td>
                                    <td>{{ $sep->users->count() }}</td>
                                    <td>{{ $sep->geocode ?: 'N/A' }}</td>
                                    <td>
                                        @can('edit_sep')
                                            <a href="{{ route('seps.edit', ['id' => $sep->id]) }}" class="btn btn-primary">Edit Service Entry point</a>
                                        @endcan
                                        @can('edit_sep_users')
                                            <a href="{{ route('seps.users.edit', ['id' => $sep->id]) }}" class="btn btn-success">Add Users</a>
                                        @endcan
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
    <script>
        $(document).ready(function () {
            $(".seps").DataTable({
                "language": {
                    "emptyTable": "No Service Entry Points found."
                }
            })
        });
    </script>
@endsection
