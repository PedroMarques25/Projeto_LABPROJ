<header class="masthead text-center text-white" style="margin-top: 6%; padding-top: 0.5%; padding-bottom: 0.5%">
    <div>
        <div class="sm-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </div>
</header>
<h2 style="margin-top: 2%">Countries where we are</h2>
<div class="countries" style="margin-top: 5%">
    @foreach($countries as $country)
        <div class="country_flags">
            <img src="{{ asset($country->country_flag ?? 'storage/flag-default.jpg') }}" alt="{{ $country->name }}" class="country-image">
            <p class="country-name">{{ strtoupper(substr($country->name, 0, 2)) }}</p>
        </div>
    @endforeach
</div>
