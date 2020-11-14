<section id="alert">
    <div class="row">
        <div class="col-md-12">
            @if(session('warning_kpic_duplicate'))
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="card bd-dark bg-warning">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="text-center">
                                            <h4 class="mb-4">Existing KPIC Found!</h4>
                                            <h1><strong>{{ session('warning_kpic_duplicate')->kpic_code }}</strong></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="bg-white text-center">
                                            <img src="{{ session('warning_kpic_duplicate')->icon->asset_url }}" height="150"
                                                 alt="test">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <strong>Created:</strong> {{ ucwords(strtolower(session('warning_kpic_duplicate')->sep->name)) }}
                                        </p>
                                        <p>
                                            <strong>Created By:</strong> {{ ucwords(strtolower(session('warning_kpic_duplicate')->creator->name)) }}
                                        </p>
                                        <p>
                                            <strong>Created On:</strong> {!! session('warning_kpic_duplicate')->created_at->format('j<\s\up>S</\s\up> F Y')  !!}
                                            at {{ session('warning_kpic_duplicate')->created_at->format('g:i a') }}
                                        </p>
                                        <p class="pt-2">
                                            If you are certain a KPIC has not already been created for this client,
                                            click on
                                            <a href="{{ route('list.kpic.create') }}" class="btn-link text-body">
                                                <strong>[Generate KPIC]</strong>
                                            </a> and enter in the same information again and <strong>select a new
                                                ICON</strong>.
                                        </p>
                                        <p class="pt-2">
                                            If you are not certain whether a KPIC has already been created, mark down
                                            this KPIC and
                                            <strong>generate</strong> a new one, and flag the "potential duplicate" box.
                                            Submit both
                                            KPICs to SITES for deduplication.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session('success_kpic_generated'))
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="card bd-dark bg-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="text-center">
                                            <h4 class="mb-4">Success! New KPIC Generated</h4>
                                            <h1><strong>{{ session('success_kpic_generated')->kpic_code }}</strong></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="bg-white text-center">
                                            <img src="{{ session('success_kpic_generated')->icon->asset_url }}"
                                                 height="150" alt="test">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <strong>Created:</strong> {{ ucwords(strtolower(session('success_kpic_generated')->sep->name)) }}
                                        </p>
                                        <p>
                                            <strong>Created By:</strong> {{ ucwords(strtolower(session('success_kpic_generated')->creator->name)) }}
                                        </p>
                                        <p>
                                            <strong>Created
                                                On:</strong> {!! session('success_kpic_generated')->created_at->format('j<\s\up>S</\s\up> F Y')  !!}
                                            at {{ session('success_kpic_generated')->created_at->format('g:i a') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Warning!</strong> {{ session('warning') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            @endif
            @if(session('info'))
                <div class="alert alert-primary alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Info!</strong> {{ session('info') }}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
