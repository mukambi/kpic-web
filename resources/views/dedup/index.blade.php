@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'Duplicate KPICs'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Possible Duplicate KPICs</h6>
                    <p class="card-description">
                        Below is a list of all possible duplicate KPICs.
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
                                <th>Type</th>
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
                                <th>Type</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($lookups as $lookup)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <code>{{ $lookup->patient->kpic_code }}</code>
                                    </td>
                                    <td>{{ $lookup->created_at->format('g:i a') }}</td>
                                    <td>{!! $lookup->created_at->format('j<\s\up>S</\s\up> F Y') !!}</td>
                                    <td>{{ $lookup->patient->sep->name }}</td>
                                    <td>{{ $lookup->patient->name }}</td>
                                    <td>{{ count($lookup->duplicates) ? 'Multiple match with code ' . implode(",", $lookup->duplicates->pluck('kpic_code')->toArray()) : 'Not Found' }}</td>
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
                    "emptyTable": "No Duplicate KPICs found."
                }
            })
        });
    </script>
@endsection
