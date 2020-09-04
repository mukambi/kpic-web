@extends('layouts.app')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs',['name' => 'KPIC Code'])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All KPIC codes</h6>
                    <p class="card-description">
                        Below is a list of all KPIC.
                    </p>
                    <div class="table-responsive">
                        <table class="table questions">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>KPIC Code</th>
                                <th>Hash</th>
                                <th>Service Entry Point</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Year of Birth</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>KPIC Code</th>
                                <th>Hash</th>
                                <th>Service Entry Point</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Year of Birth</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <code>{{ $patient->kpic_code }}</code>
                                    </td>
                                    <td>
                                        <code>{{ $patient->hash }}</code>
                                    </td>
                                    <td>{{ $patient->sep->name }}</td>
                                    <td>{{ $patient->first_name }}</td>
                                    <td>{{ $patient->last_name }}</td>
                                    <td>{{ $patient->yob }}</td>
                                    <td>

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
            $(".questions").DataTable({
                "language": {
                    "emptyTable": "No KPIC found."
                }
            })
        });
    </script>
@endsection
