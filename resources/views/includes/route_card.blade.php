<div class="col-md-3">
    <div class="card mb-4">
        @if($route->route_path_image)
            <img class="card-img-top" src="{{ asset($route->route_path_image) }}" alt="Route Image">
        @else
            <img class="card-img-top" src="{{ asset('storage/route-default-image.jpg') }}" alt="Default Image">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $route->name }}</h5>
            <p class="card-text">Bio: {{ $route->aboutIt }}</p>
            <p class="card-text">Available spots: {{ $route->remaining_available_slots }}</p>
            <p class="card-text">Total slots: {{ $route->total_slots }}</p>
            <p class="card-text">Rating: {{ $route->rating }}</p>
            <a href="{{ route('routes.show', ['id' => $route->id]) }}" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>

