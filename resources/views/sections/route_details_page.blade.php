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
    <p>Fee: {{ $route->fee }} %</p>
    <p>Total Price: € {{ $route->total_price }}</p>
@else
    <p>No attractions associated with this route.</p>
@endif

<!-- Display associated available slots (if any) -->
<h2>Available slots</h2>
<p>{{ $route->remaining_available_slots}}</p>

<h2>Total slots</h2>
<p>{{ $route->total_slots}}</p>

<h2>Rating</h2>

@php
    $fullStars = floor($route->rating); // Get the integer part of the rating
    $halfStar = $route->rating - $fullStars; // Get the decimal part of the rating
    $emptyStars = 5 - ceil($route->rating); // Calculate remaining empty stars
@endphp

@for ($i = 0; $i < $fullStars; $i++)
    <span class="star full" style="font-size: 100%">&#9733;</span>
@endfor

@if ($halfStar >= 0.5)
    <span class="star half" style="font-size: 100%">&#9733;</span>
@else
    <span class="star empty" style="font-size: 100%">&#9734;</span>
@endif

@for ($i = 0; $i < $emptyStars; $i++)
    <span class="star empty" style="font-size: 100%">&#9734;</span>
@endfor

<p>{{ $route->rating}}</p>

<h2>Date</h2>
<p>{{ $route->route_date}}</p>

<h2>Duration</h2>
<p>{{ $route->duration}}</p>

@if(!routeBelongs($route) || !isGuide())
    <a href="{{ route('route.addToCart', ['routeId' => $route->id]) }}" class="btn btn-primary">Add to Cart</a><br><br>
@endif

@if(isGuide())
@if(routeBelongs($route))
    <form method="POST" action="{{ route('route.delete', ['routeID' => $route->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary">Remove Route</button>
    </form>
@endif
@endif



