@extends('layouts.app')
@section('css')
    @parent
    <link href="{{ asset('/css/toastr.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('layouts.components.breadcrumbs', ['name' => 'Api Credetials '])@endcomponent
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Authentication Credentials</h6>
                    <p class="card-description">
                        Below is the list of Api Credentials for Authentication
                    </p>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Application Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control text-success copy-data" id="name"
                                       value="{{ $credential->name }}" style="height: 50px;" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="name-btn" class="input-group-text copy-clipboard"><i class="link-icon" data-feather="copy"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="id">Client ID</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control text-success copy-data" id="id"
                                       value="{{ $credential->id }}" style="height: 50px;" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="id-btn" class="input-group-text copy-clipboard"><i class="link-icon" data-feather="copy"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="secret">Client Secret</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control text-success copy-data" id="secret"
                                       value="{{ $credential->secret }}" style="height: 50px;" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="secret-btn" class="input-group-text copy-clipboard"><i class="link-icon" data-feather="copy"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <script>
        $(window).on("load", function () {
            $('.copy-clipboard').click(function (){
                $(this).parent().siblings(':input').select();
                document.execCommand("copy");
                toastr.info('Text has copied to clipboard.');
            });
        });
    </script>
@endsection
