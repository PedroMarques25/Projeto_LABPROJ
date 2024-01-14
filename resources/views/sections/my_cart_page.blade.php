<section id="buy-tickets" class="section-with-bg">
    <div class="container" data-aos="fade-up">
        @php $totalPrice = 0; $sessionTotalPrice = 0;
        @endphp
        <div class="section-header">
            <h2>We are going to</h2>
            <p>Check the details of your next trip</p>
        </div>
        <div class="row justify-content-center">
            @foreach($routesInCart as $route)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body">
                            <h5 class="card-title text-muted text-uppercase text-center">{{ $route->name }}</h5>
                            <hr>
                            @if($route->attractions->isNotEmpty())
                                <ul>
                                    @foreach($route->attractions as $attraction)
                                        <li>{{ $attraction->name }} € {{ $attraction->price }}</li>
                                        @php $totalPrice += $attraction->price; @endphp <!-- Add attraction price to total -->
                                    @endforeach
                                    <li>
                                        Fee: {{ $route->fee }}{{ fmod($route->fee, 1) !== 0 ? '%' : '' }}
                                    </li>
                                </ul>
                                <h6 class="card-price text-center">€ {{$route->total_price}}</h6>

                                <hr>
                                <form action="{{ route('route.removeFromCart', ['routeId' => $route->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                </form>

                                @php
                                    // Add the route's total price to the session accumulator
                                    $sessionTotalPrice += $route->total_price;
                                    session(['total_price' => $sessionTotalPrice]);
                                @endphp
                            @else
                                <p>No attractions associated with this route.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
                @php
                    $quantity = $routesInCart->count();
                    session(['cart_quantity' => $quantity]);
                @endphp
            <div class="text-center" style="margin-top: 5%">
                <form action="{{ route('checkout') }}" method="POST">
                    <button type="submit" name="_token" value="{{csrf_token()}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" data-ticket-type="standard-access">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
</section>