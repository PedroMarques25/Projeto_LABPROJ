<h1 style="margin-top: 10%">Edit Profile</h1>
<form action="{{ route('update-profile') }}" method="POST">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="name">Name:</label>
        <label for="name_edit"></label><textarea class="form-control" id="name_edit" name="name_edit"></textarea>

        <label for="bio_edit" style="margin-top: 2%">Bio:</label>
        <label for="bio_edit"></label><textarea class="form-control" id="bio_edit" name="bio"></textarea>

        <label for="city" style="margin-top: 2%">City:</label>
        <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="city_edit" name="city_edit">
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>

        <label for="password" style="margin-top: 2%">New password:</label>
        <label for="password_edit"></label><input type="password" class="form-control" id="password_edit" name="password_edit">

        <label for="password" style="margin-top: 2%">Current password confirmation:</label>
        {{--<label for="password_edit"></label>--}}<label for="password_confirmation_edit"></label><input type="password" class="form-control" id="password_confirmation_edit" name="password_confirmation_edit">
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Save Changes</button>
</form>
<h2 style="margin-top: 4%"> Delete account</h2>
<form action="{{ route('delete-profile') }}" method="POST" style="margin-top: 2%">
    @csrf
    @method('DELETE') <!-- Method spoofing for DELETE request -->
    <div class="form-group">
        <label for="delete_account_pass_confirmation">Confirm account deletion by entering your password:</label>
        <input type="password" class="form-control" id="delete_account_pass_confirmation" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Delete</button>
</form>
