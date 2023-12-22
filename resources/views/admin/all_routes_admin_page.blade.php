@extends(('layouts.app_admin'))
<div class="row">
    <div class="col-md-3">
        @include('admin.side_bar_page')
    </div>
    <div class="col-md-9">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <div class="row" style="margin-left: 2%; margin-right: 2%">
                    @php $imageCount = 0; @endphp
                    @foreach($routes as $route)
                        @include('includes.route_card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@section('title')
    All routes
@endsection


