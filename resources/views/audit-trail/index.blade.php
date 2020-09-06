@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'KPIC List'])@endcomponent
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
                }
            })
        });
    </script>
@endsection
