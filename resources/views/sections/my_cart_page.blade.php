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
                                <div class="d-flex flex-column align-items-center"> <!-- Added this div for flex container -->
                                <div class="d-flex justify-content-between mb-2">
                                <form action="{{ route('increase-quantity') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info">+</button>
                                </form> 
                            <form action="{{ route('decrease-quantity') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">-</button>
                            <select name="selected_time" id="selected_time">
                                <option value="8:00 - 9:00">8:00 - 9:00</option>
                                <option value="10:00 - 11:00">10:00 - 11:00</option>
                                <option value="12:00 - 13:00">12:00 - 13:00</option>
                                <option value="14:00 - 15:00">14:00 - 15:00</option>
                                <option value="16:00 - 17:000">16:00 - 17:00</option>
                                <option value="18:00 - 19:00">18:00 - 19:00</option>

           
        </select>
    </form>

                            </form>
            </div>
    <form action="{{ route('route.removeFromCart', ['routeId' => $route->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Remove from Cart</button>
    </form>
</div>


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
