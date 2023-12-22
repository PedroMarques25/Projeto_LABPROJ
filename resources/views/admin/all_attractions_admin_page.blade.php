@extends('layouts.app_admin')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('admin.side_bar_page')
            </div>
            <!-- Main Content -->
            <div class="col-md-9">
                <h1 style="margin-top: 2%; margin-left: 3%">All guides registered</h1>
                <div class="row" style="margin-left: 2%; margin-right: 2%">
                    @foreach($attractions as $attraction)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                @if(empty($attraction->attraction_image_path))
                                    <img class="card-img-top rounded-circle" src="{{ asset('profile_default-removebg.png') }}" alt="Default Image">
                                @else
                                    <img class="card-img-top rounded-circle" src="{{ $attraction->attraction_image_path }}" alt="User Image">
                                @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $attraction->name }}</h5>
                                        <p class="card-text">Type: {{ $attraction->type->name }}</p>
                                        <p class="card-text">City: {{ $attraction->city->name }}</p>
                                        @if(isset($attraction->hasRoute))
                                            <p>In routes</p>
                                            <button class="btn btn-link toggle-routes" data-target="{{ $attraction->id }}">Show Routes</button>
                                            <ul class="routes-list" id="routes-{{ $attraction->id }}" style="display: none;">
                                                @foreach($attraction->hasRoute as $routes)
                                                    <li>{{ $routes->name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@section('title')
    All attractions
@endsection

<script>
    document.querySelectorAll('.toggle-routes').forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-target');
            const routesList = document.getElementById(`routes-${targetId}`);
            routesList.style.display = routesList.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>





