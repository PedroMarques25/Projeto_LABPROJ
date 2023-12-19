<!-- Content section 1-->
<section id="scroll">
    <div class="col-lg-9 order-lg-2">
        <form action="{{ route('become-guide') }}" method="GET">
            <button type="submit" class="btn btn-primary btn-xl rounded-pill mt-5">Become a guide</button>
        </form>
    </div>
    <header class="masthead text-center text-white" style="margin-top: 6%; padding-top: 0.5%; padding-bottom: 0.5%">
        <div>
            <div class="sm-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        </div>
    </header>
</section>
<h2 style="margin-top: 2%">Recently added attractions</h2>

<div id="attractionCarousel" class="carousel slide" data-bs-ride="carousel" style="margin-top: 4%">
    <div class="carousel-inner">
        @foreach($attractions as $attraction)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{asset($attraction->attraction_image_path) }}" class="d-block w-100" alt="Attraction Image">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $attraction->name }}</h5>
                    <p>{{ $attraction->aboutIt }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#attractionCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#attractionCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
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
        @if($imageCount < 4)
        <div class="col-md-3"> <!-- Display each card in a column taking 4/12 of the row -->
            <div class="card mb-4">
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



