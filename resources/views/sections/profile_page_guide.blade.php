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
                    @for ($i = 0; $i < $guideRating; $i++)
                        <span class="star">&#9733;</span>
                    @endfor
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
                    @if($routes->isEmpty())
                        <h2 class="p-5 rating d-flex justify-content-center">NOTHING HERE</h2>
                    @else
                        <div class="row">
                            @php $imageCount = 0; @endphp <!-- Initializing image count -->
                            @foreach($routes as $route)
                                @if($imageCount < 5) <!-- Check if the image count is less than 5 -->
                                <div class="col-md-4"> <!-- Display each card in a column taking 4/12 of the row -->
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
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    @php $imageCount++; @endphp <!-- Increment image count -->
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                        <form {{--action="{{ route('') }}"--}} method="POST" class="text-center">
                            <button type="submit" class="btn btn-primary btn-bg rounded-pill mt-5">Add a route</button>
                        </form>

                        <form {{--action="{{ route('') }}"--}} method="POST" class="text-center">
                            <button type="submit" class="btn btn-primary btn-bg rounded-pill mt-5">Add attraction</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>

