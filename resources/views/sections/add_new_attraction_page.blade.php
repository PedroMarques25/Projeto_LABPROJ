<h1 style="margin-top: 10%">Add new attraction</h1>

<form method="POST" action="{{ route('attraction.creation') }}">
    @csrf
    <div class="form-group" >
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="cityAttraction" style="margin-top: 2%">City:</label>
        <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="cityAttraction" name="city_id">
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>

        <label for="typeAttraction" style="margin-top: 2%">Type:</label>
        <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="typeAttraction" name="type_id">
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

        <label for="aboutAttraction" style="margin-top: 2%">About:</label>
        <textarea id="aboutAttraction" name="aboutIt" style="width: 100%; min-height: 50px;" required></textarea>

        <label for="price" style="margin-top: 2%">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="attraction_image" style="margin-top: 2%">Attraction Image:</label>
        <input type="file" id="attraction_image" name="attraction_image">
    </div>
    <button type="submit" class="btn btn-primary btn-bg rounded-pill mt-5">Add Attraction</button>
</form>

<script>
    const textarea = document.getElementById('aboutAttraction');

    textarea.addEventListener('input', function() {
        this.style.height = 'auto'; // Reset height to auto
        this.style.height = (this.scrollHeight) + 'px'; // Set height based on content
    });
</script>
