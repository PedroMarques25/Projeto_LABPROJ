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
                    @foreach($guides as $guide)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                @if(empty($guide->user->image_path))
                                    <img class="card-img-top rounded-circle" src="{{ asset('profile_default-removebg.png') }}" alt="Default Image">
                                @else
                                    <img class="card-img-top rounded-circle" src="{{ $guide->user->image_path }}" alt="User Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $guide->user->name }}</h5>
                                    <p class="card-text">Bio: {{ $guide->user->bio }}</p>
                                    <p class="card-text">Rating: {{ $guide->rating }}</p>
                                    <p class="card-text">Join date: {{ $guide->created_at }}</p>
                                    <p class="card-text">Routes: {{ $guide->rating }}</p>
                                    @if(isset($guide->routes) && $guide->routes->isNotEmpty())
                                        <p>Associated routes</p>
                                        <button class="btn btn-link toggle-routes" data-target="{{ $guide->id }}">Show Routes</button>
                                        <ul class="routes-list" id="routes-{{ $guide->id }}" style="display: none;">
                                            @foreach($guide->routes as $routes)
                                                <li>{{ $routes->name }} € {{ $routes->total_price }}</li>
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
    All guides
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



