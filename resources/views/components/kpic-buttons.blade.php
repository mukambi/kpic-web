<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @can('create_kpic')
                    <a href="{{ route('list.kpic.create') }}" class="btn btn-primary">Generate KPIC</a>
                @endcan
                @can('lookup_kpic')
                    <a href="{{ route('list.lookup.create') }}" class="btn btn-success">Search KPIC</a>
                @endcan
            </div>
        </div>
    </div>
</div>
