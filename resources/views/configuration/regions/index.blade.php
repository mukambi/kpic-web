@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Regions'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('create_region')
                        <a href="{{ route('configuration.regions.create') }}" class="btn btn-primary">Add new Region</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Regions</h6>
                    <p class="card-description">
                        Below is a list of all Regions.
                    </p>
                    <div class="table-responsive">
                        <table class="table regions">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($regions as $region)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $region->name }}</td>
                                    <td>
                                        @can('edit_region')
                                            <a href="{{ route('configuration.regions.edit', ['id' => $region->id]) }}" class="btn btn-primary">Edit</a>
                                        @endcan
                                        @can('delete_region')
                                            <a class="btn btn-danger" href="#"
                                               onclick="event.preventDefault();
                                                         document.getElementById('delete-region-{{ $region->id }}').submit();">
                                                Delete
                                            </a>
                                            <form id="delete-region-{{$region->id}}" action="{{ route('configuration.regions.destroy', ['id' => $region->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
            $(".regions").DataTable({
                "language": {
                    "emptyTable": "No Regions found.",
                    "search": "Search Table:"
                },
                "lengthMenu": @json(config('settings.pagination_length')),
            })
        });
    </script>
@endsection
