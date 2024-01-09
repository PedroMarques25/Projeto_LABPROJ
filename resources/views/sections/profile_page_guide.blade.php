<section id="scroll">
    <div class="container px-5" >
        <div class="row gx-5 align-items-center">
            <div class="row-lg-6 order-lg-1">
                <div class="p-5 rating d-flex justify-content-center">
                    <h2>Your rating</h2>
                </div>
                <div class="rating d-flex justify-content-center">
                    @php
                        $guideRating = session('guide_rating', 0); // Get the guide rating from the session or set default to 0
                    @endphp

                    @php
                        $fullStars = floor($guideRating); // Get the integer part of the guide's rating
                        $halfStar = $guideRating - $fullStars; // Get the decimal part of the guide's rating
                        $emptyStars = 5 - ceil($guideRating); // Calculate remaining empty stars
                    @endphp

                    @for ($i = 0; $i < $fullStars; $i++)
                        <span class="star full" style="font-size: 300%">&#9733;</span>
                    @endfor

                    @if ($halfStar >= 0.5)
                        <span class="star half" style="font-size: 300%">&#9733;</span>
                    @else
                        <span class="star empty" style="font-size: 300%">&#9734;</span>
                    @endif

                    @for ($i = 1; $i < $emptyStars; $i++)
                        <span class="star empty" style="font-size: 300%">&#9734;</span>
                    @endfor
                </div>
                <div class="rating d-flex justify-content-center">
                    <p>{{$guideRating}}</p>
                </div>
                <header class="masthead text-center text-white" style="margin-top: 6%; padding-top: 0.5%; padding-bottom: 0.5%">
                    <div>
                        <div class="sm-circle-1 bg-circle"></div>
                        <div class="bg-circle-2 bg-circle"></div>
                        <div class="bg-circle-3 bg-circle"></div>
                        <div class="bg-circle-4 bg-circle"></div>
                    </div>
                </header>
                <div class="p-5 rating d-flex justify-content-center">
                    <h2>Your languages</h2>
                </div>

                @if(isset($languages) && $languages->count() > 0)
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <ul class="list-group">
                                    @foreach($languages as $language)
                                        <li class="p-5 rating d-flex justify-content-center" style="font-size: 25px">{{ $language->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-5 rating d-flex justify-content-center">
                        <p>No languages found.</p>
                    </div>
                @endif

                <header class="masthead text-center text-white" style="margin-top: 6%; padding-top: 0.5%; padding-bottom: 0.5%">
                    <div>
                        <div class="sm-circle-1 bg-circle"></div>
                        <div class="bg-circle-2 bg-circle"></div>
                        <div class="bg-circle-3 bg-circle"></div>
                        <div class="bg-circle-4 bg-circle"></div>
                    </div>
                </header>

                <div class="p-5 rating d-flex justify-content-center">
                    <h2>Your routes</h2>
                </div>
                <div class="routes">
                    @if($routes_guide->isEmpty())
                        <h2 class="p-5 rating d-flex justify-content-center">NOTHING HERE</h2>
                    @else
                        <div class="row">
                            @php $imageCount = 0; @endphp <!-- Initializing image count -->
                            @foreach($routes_guide as $route)
{{--                                @if($imageCount < 15)--}}
                                <div class="col-md-2"> <!-- Display each card in a column taking 4/12 of the row -->
                                    <div class="card mb-4">
                                        @if($route->route_path_image)
                                            <img class="card-img-top" src="{{ asset($route->route_path_image) }}" alt="Route Image">
                                        @else
                                            <img class="card-img-top" src="{{ asset('storage/route-default-image.jpg') }}" alt="Default Image">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $route->name }}</h5>
                                            <p class="card-text">{{ substr($route->aboutIt, 0, 15) }}...</p>
                                            <p class="card-text">Available spots: {{ $route->remaining_available_slots }}</p>
                                            <p class="card-text">Total slots: {{ $route->total_slots }}</p>
                                            <p class="card-text">Rating: {{ $route->rating }}</p>
                                            <a href="{{ route('routes.show', ['id' => $route->id]) }}" class="btn btn-primary">Details</a>
                                        </div>
                                    </div>
                                    @php $imageCount++; @endphp <!-- Increment image count -->
                                </div>
{{--                                @endif--}}
                            @endforeach
                        </div>

                    @endif
                </div>
                <form action="{{ route('routes.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-bg rounded-pill mt-5">Add a route</button>
                </form>
                <form action="{{ route('attraction.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-bg rounded-pill mt-5">Add new attraction</button>
                </form>
            </div>
        </div>
    </div>
    <header class="masthead text-center text-white" style="margin-top: 6%; padding-top: 0.5%; padding-bottom: 0.5%">
        <div>
            <div class="sm-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        </div>
    </header>
    <h2 style="margin-top: 2%">Recently added routes</h2>
    <div class="row">
        @php $imageCount = 0; @endphp <!-- Initializing image count -->
        @foreach($routes as $route)
            @if($imageCount < 4) <!-- Check if the image count is less than 5 -->
            <div class="col-md-3"> <!-- Display each card in a column taking 4/12 of the row -->
                <div class="card mb-4">
                    <!-- Example image, replace with your route's image -->
                    @if($route->route_path_image)
                        <img class="card-img-top" src="{{ asset($route->route_path_image) }}" alt="Route Image">
                    @else
                        <!-- If there's no route image path available -->
                        <img class="card-img-top" src="{{ asset('storage/route-default-image.jpg') }}" alt="Default Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $route->name }}</h5>
                        <p class="card-text">Default</p>
                        <p class="card-text">Available spots: {{ $route->remaining_available_slots }}</p>
                        <p class="card-text">Total slots: {{ $route->total_slots }}</p>
                        <p class="card-text">Rating: {{ $route->rating }}</p>
                        <a href="{{ route('routes.show', ['id' => $route->id]) }}" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                @php $imageCount++; @endphp <!-- Increment image count -->
            </div>
            @endif
        @endforeach
    </div>
</section>

{{--<script>
    $('.carousel .carousel-item').each(function () {
        var minPerSlide = 4;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < minPerSlide; i++) { next=next.next(); if (!next.length) { next=$(this).siblings(':first'); } next.children(':first-child').clone().appendTo($(this)); } });
</script>--}}

