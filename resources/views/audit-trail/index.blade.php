@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @if(count($regions))
        <div class="row">
            <div class="mr-auto">
                <div class="col mb-4">
                    <nav class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ 'KPIC List' }}</li>
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
                               href="{{ route('list.index') }}">All Regions</a>
                            @foreach($regions as $region)
                                <a class="dropdown-item {{ $selected_region && ($selected_region->id == $region->id) ? 'active' : null }}"
                                   href="{{ route('list.index', ['region' => $region->id]) }}">{{ ucwords(strtolower($region->name)) }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <x-kpic-buttons/>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">KPIC List</h6>
                    <p class="card-description">
                        Below is a list of KPICs Audit Trails.
                    </p>
                    <div class="table-responsive">
                        <table class="table questions">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Service Entry Point</th>
                                <th>Region</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Service Entry Point</th>
                                <th>Region</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($trails as $trail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <code>{{ $trail->patient->kpic_code }}</code>
                                    </td>
                                    <td>{{ $trail->created_at->format('g:i a') }}</td>
                                    <td>{!! $trail->created_at->format('j<\s\up>S</\s\up> F Y') !!}</td>
                                    <td>{{ $trail->sep->name }}</td>
                                    <td>{{ $trail->sep->region->name }}</td>
                                    <td>{{ $trail->user->name }}</td>
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
                    "emptyTable": "No KPICs found."
                },
                "lengthMenu": @json(config('settings.pagination_length')),
            })
        });
    </script>
@endsection
