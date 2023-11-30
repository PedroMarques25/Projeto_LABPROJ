{{----}}
<section id="buy-tickets" class="section-with-bg">
    <div class="container" data-aos="fade-up">

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
                                    @php $totalPrice = 0; @endphp <!-- Initialize total price variable -->
                                    @foreach($route->attractions as $attraction)
                                        <li>{{ $attraction->name }} € {{ $attraction->price }}</li>
                                        @php $totalPrice += $attraction->price; @endphp <!-- Add attraction price to total -->
                                    @endforeach
                                    <li>
                                        Fee: 10%
                                    </li>
                                </ul>
                                <p>Total: € {{ $totalPrice }}</p>
                                <p>After fee:</p>
                                <h6 class="card-price text-center">€ {{ $totalPrice }} + {{ $totalPrice }}*0.1</h6>
                            @else
                                <p>No attractions associated with this route.</p>
                            @endif
                            <div class="text-center">
                                <button type="button" class="btn btn-primary">Buy Now</button>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
            {{--<div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">Standard Access</h5>
                        <h6 class="card-price text-center">$150</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Regular Seating</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Coffee Break</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Custom Badge</li>
                            <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Community Access</li>
                            <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Workshop Access</li>
                            <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>After Party</li>
                        </ul>
                        <hr>
                        <div class="text-center">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" data-ticket-type="standard-access">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
</section>


<!-- Your HTML structure -->
<section id="buy-tickets" class="section-with-bg">
    <div class="container" data-aos="fade-up">
        <!-- Section header -->

        <div class="row justify-content-center">
            @foreach($routesInCart as $route)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body">
                            <h5 class="card-title">{{ $route->name }}</h5>
                            <!-- Display other route details -->
                            <p>Available spots: {{ $route->remaining_available_slots }}</p>
                            <p>Total slots: {{ $route->total_slots }}</p>
                            <!-- Other details -->

                            <!-- Example Buy Now button -->
                            <div class="text-center">
                                <button type="button" class="btn btn-primary">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

