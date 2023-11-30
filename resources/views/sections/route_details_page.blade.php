<!-- Assuming $route contains the Route model with associated guide and attractions -->
<h1>Route Details</h1>
<p>{{ $route->name }}</p>

<!-- Display associated guide's name -->
@if($route->guide)
    <h2>Guide</h2>
    <p>{{ $route->guide->user->name}}</p>
@else
    <p>No guide associated with this route.</p>
@endif

<!-- Display associated attractions (if any) -->
@if($route->attractions->isNotEmpty())
    <h2>Associated Attractions</h2>
    <ul>
        @php $totalPrice = 0; @endphp <!-- Initialize total price variable -->
        @foreach($route->attractions as $attraction)
            <li>{{ $attraction->name }} € {{ $attraction->price }}</li>
            @php $totalPrice += $attraction->price; @endphp <!-- Add attraction price to total -->
        @endforeach
    </ul>
    <p>Total Price: € {{ $totalPrice }}</p>
@else
    <p>No attractions associated with this route.</p>
@endif

<!-- Display associated available slots (if any) -->
<h2>Available slots</h2>
<p>{{ $route->remaining_available_slots}}</p>

<h2>Total slots</h2>
<p>{{ $route->total_slots}}</p>

<h2>Rating</h2>
<p>{{ $route->rating}}</p>

<a href="{{ route('route.addToCart', ['routeId' => $route->id]) }}" class="btn btn-primary">Add to Cart</a>

