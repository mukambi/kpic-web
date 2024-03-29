@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Icons'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @can('create_icon')
                        <a href="{{ route('configuration.icons.create') }}" class="btn btn-primary">Add new Icon</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Icons</h6>
                    <p class="card-description">
                        Below is a list of all Icons.
                    </p>
                    <div class="table-responsive">
                        <table class="table seps">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Image Url</th>
                                <th>Image</th>
                                <th>Added on</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Image Url</th>
                                <th>Image</th>
                                <th>Added on</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($icons as $icon)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <code>{{ $icon->code }}</code>
                                    </td>
                                    <td>{{ $icon->name }}</td>
                                    <td>
                                        <a href="{{ $icon->asset_url }}" class="">{{ $icon->asset_url }}</a>
                                    </td>
                                    <td>
                                        <img src="{{ $icon->asset_url }}" alt="{{ $icon->name }}">
                                    </td>
                                    <td>{!! $icon->created_at->format('j<\s\up>S</\s\up> F Y') !!}</td>
                                    <td>
                                        @can('edit_icon')
                                            <a href="{{ route('configuration.icons.edit', ['id' => $icon->id]) }}" class="btn btn-primary">Edit</a>
                                        @endcan
                                        @can('delete_icon')
                                            <a class="btn btn-danger" href="#"
                                               onclick="event.preventDefault();
                                                         document.getElementById('delete-icon-{{$icon->id}}').submit();">
                                                Delete
                                            </a>
                                            <form id="delete-icon-{{$icon->id}}" action="{{ route('configuration.icons.destroy', ['id' => $icon->id]) }}" method="post">
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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".seps").DataTable({
                "language": {
                    "emptyTable": "No Population Category Numbers found.",
                    "search": "Search Table:"
                },
                "lengthMenu": @json(config('settings.pagination_length')),
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
