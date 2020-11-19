@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'KPIC Mobility List'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-12">
                                <label for="code">KPIC Code:</label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') ?: $short_kpic_code }}">
                            </div>
                        </div>
                        <div class="form-actions text-right border-top mt-4">
                            <div class="mt-2">
                                <button type="reset" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">KPIC Mobility List</h6>
                    <p class="card-description">
                        Below is a list of all KPIC Mobility List.
                    </p>
                    <div class="table-responsive">
                        <table class="table questions">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Service Entry Point</th>
                                <th>Region</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Service Entry Point</th>
                                <th>Region</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($trails as $trail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trail->created_at->format('g:i a') }}</td>
                                    <td>{!! $trail->created_at->format('j<\s\up>S</\s\up> F Y') !!}</td>
                                    <td>{{ $trail->sep->name }}</td>
                                    @if($trail->sep->region)
                                        <td>{{ $trail->sep->region->name }}</td>
                                    @else
                                        <td class="text-danger">N/A</td>
                                    @endif
                                    <td>{{ $trail->action }}</td>
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
            $(".questions").DataTable({
                "language": {
                    "emptyTable": "No KPIC found.",
                    "search": "Search Table:"
                },
                "lengthMenu": @json(config('settings.pagination_length')),
            })
        });
    </script>
@endsection
