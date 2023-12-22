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
                    <p style="color: #0E1B4D">{{ $attraction->aboutIt }}</p>
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
            @include('includes.route_card') <!-- Include the new Blade file -->
            @php $imageCount++; @endphp <!-- Increment image count -->
        @endif
    @endforeach
</div>




