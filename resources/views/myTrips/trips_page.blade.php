<h1 style="margin-top: 7%">Your purchase history</h1>

@foreach ($myTrips as $trip)
    @if(isset($trip->guide_name))
        <p>Guide Name: {{ $trip->guide_name }}</p>
    @else
        <p>Guide Name: Not Available</p>
    @endif
    <p>Route name: {{ $trip->routeName }}</p>
    <p>Purchase date: {{ $trip->date_of_purchase }}</p>
    <hr> {{--Horizontal line--}}
@endforeach
