@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Service Entry Points Types'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('create_sep_type')
                        <a href="{{ route('configuration.sep-type.create') }}" class="btn btn-primary">Add new Service Entry Point Type</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Service Entry Points Types</h6>
                    <p class="card-description">
                        Below is a list of all Service Entry Points Types.
                    </p>
                    <div class="table-responsive">
                        <table class="table seps">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($sep_types as $sep_type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sep_type->name }}</td>
                                    <td>{{ $sep_type->code }}</td>
                                    <td>
                                        @can('edit_sep_type')
                                            <a href="{{ route('configuration.sep-type.edit', ['id' => $sep_type->id]) }}" class="btn btn-primary">Edit</a>
                                        @endcan
                                        @can('delete_sep_type')
                                            <a class="btn btn-danger" href="#"
                                               onclick="event.preventDefault();
                                                         document.getElementById('delete-sep-type-{{ $sep_type->id }}').submit();">
                                                Delete
                                            </a>
                                            <form id="delete-sep-type-{{$sep_type->id}}" action="{{ route('configuration.sep-type.destroy', ['id' => $sep_type->id]) }}" method="post">
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
            $(".seps").DataTable({
                "language": {
                    "emptyTable": "No Service Entry Points Type found."
                },
                "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
            })
        });
    </script>
@endsection
