<h1>Route Search</h1>
<p>Write something here</p>
<style>
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-gap: 20px;
    }
</style>

<form action="{{ route('search.routes') }}" method="GET" class="form-grid">
    <div>
        <h5>Search by date:</h5>
        <input type="date" class="form-select form-select-bg mb-3"  id="dateSearch" name="dateToSearch">
    </div>

    <div>
        <h5>Search by guide:</h5>
        <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="guideSelect" name="guideName">
            <option value="" selected disabled>Select a guide</option>
            @foreach($guides as $guide)
                <option value="{{ $guide->id }}">{{ $guide->user->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <h5>Search by city:</h5>
        <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="citySelect" name="cityToSearch_id">
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <h5>Search by rating:</h5>
        <input type="number" class="form-select form-select-bg mb-3" id="ratingSelect" name="ratingToSearch" step="0.5" min="0" max="5">
    </div>

    <div>
        <button type="submit" class="btn btn-primary btn-bg btn btn-primary mt-10">Search</button>
        <button type="button" class="btn btn-primary btn-bg btn btn-primary mt-10" id="clearSearch">Clear</button>
    </div>
</form>


@if(!empty($searchResult))
    <h2 style="margin-top: 7%" >Your search results, {{ session('user_name') }}</h2>
    <div class="row">
        @php $imageCount = 0; @endphp <!-- Initializing image count -->
        @foreach($searchResult as $route)
            @include('includes.route_card') <!-- Include the new Blade file -->
        @endforeach
    </div>
    <button class="btn btn-primary btn-bg btn btn-primary mt-10" onclick="clearSearchResults()">Clear Search Results</button>

@endif

<script>
    const dateSearch = document.getElementById('dateSearch');
    const guideSelect = document.getElementById('guideSelect');
    const citySelect = document.getElementById('citySelect');
    const ratingSelect = document.getElementById('ratingSelect');
    const clearSearch = document.getElementById('clearSearch');


    dateSearch.addEventListener('change', () => {
        if (dateSearch.value !== '') {
            guideSelect.disabled = true;
            citySelect.disabled = true;
            ratingSelect.disabled = true;
        } else {
            guideSelect.disabled = false;
            citySelect.disabled = false;
            ratingSelect.disabled = false;
        }
    });

    guideSelect.addEventListener('change', () => {
        if (guideSelect.value !== '') {
            dateSearch.disabled = true;
            citySelect.disabled = true;
            ratingSelect.disabled = true;
        } else {
            dateSearch.disabled = false;
            citySelect.disabled = false;
            ratingSelect.disabled = false;
        }
    });

    ratingSelect.addEventListener('change', () => {
        if (ratingSelect.value !== '') {
            dateSearch.disabled = true;
            guideSelect.disabled = true;
            citySelect.disabled = true;
        } else {
            dateSearch.disabled = false;
            guideSelect.disabled = false;
            citySelect.disabled = false;
        }
    });

    citySelect.addEventListener('change', () => {
        if (citySelect.value !== '') {
            dateSearch.disabled = true;
            guideSelect.disabled = true;
        } else {
            dateSearch.disabled = false;
            guideSelect.disabled = false;
        }
    });

    const resetForm = () => {
        dateSearch.value = '';
        guideSelect.value = '';
        citySelect.value = '';
        dateSearch.disabled = false;
        guideSelect.disabled = false;
        citySelect.disabled = false;
    };
    clearSearch.addEventListener('click', () => {
        resetForm();
    });

    function clearSearchResults() {
        window.location.href = "{{ route('search.routes') }}?clearSearch=1";
    }
</script>
