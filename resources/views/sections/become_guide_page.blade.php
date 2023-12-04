<h1 style="padding-top: 5%">Became a guide</h1>
<p>It'll be a pleasure to have you showing your city!</p>

<form action="{{ route('register-guide') }}" method="POST" style="margin-top: 2%">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="languages">Languages:</label>
        <div style="margin-top: 2%">
            @foreach($languages as $language)
                <label>
                    <input type="checkbox" name="languages[]" value="{{ $language->id }}">
                    {{ $language->name }}
                </label><br>
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Welcome aboard!</button>
    <a href="/profile" class="btn btn-primary" style="margin-top: 1%">Return to Profile</a>
</form>
