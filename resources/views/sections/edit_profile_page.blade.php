{{--
<h1 style="padding-top: 5%">Edit Profile</h1>
<form action="{{ route('update-bio') }}" method="POST">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="bio_edit">Bio:</label>
        <label for="bio_edit"></label><textarea class="form-control" id="bio_edit" name="bio"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Save Changes</button>
</form>
<form action="{{ route('index') }}" method="POST">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="bio" style="padding-top: 2%">Name:</label>
        <label for="name_edit"></label><textarea class="form-control" id="name_edit" name="name_edit"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Save Changes</button>
</form>
<form action="{{ route('index') }}" method="POST">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="bio" style="padding-top: 2%">City:</label>
        <label for="city_edit"></label><textarea class="form-control" id="city_edit" name="city_edit"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Save Changes</button>
</form>
<form action="{{ route('index') }}" method="POST">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="bio" style="padding-top: 2%">Password:</label>
        <label for="password_edit"></label><textarea class="form-control" id="password_edit" name="password_edit"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Save Changes</button>
</form>
<div class="col-2" style="padding-top: 2%">
    <a href="{{ route('profile') }}">
        <div class="d-grid">
            <button class="btn btn-primary" id="cancelEditButton" type="submit" >Cancel</button>
        </div>
    </a>
</div>
--}}

<h1 style="padding-top: 5%">Edit Profile</h1>
<form action="{{ route('update-profile') }}" method="POST">
    @csrf <!-- CSRF protection -->
    <div class="form-group">
        <label for="bio_edit">Bio:</label>
        <label for="bio_edit"></label><textarea class="form-control" id="bio_edit" name="bio"></textarea>
    </div>
    <div class="form-group">
        <label for="name" style="padding-top: 2%">Name:</label>
        <label for="name_edit"></label><textarea class="form-control" id="name_edit" name="name_edit"></textarea>
    </div>
    <div class="form-group">
        <label for="city" style="padding-top: 2%">City:</label>
        <label for="city_edit"></label><textarea class="form-control" id="city_edit" name="city_edit"></textarea>
    </div>
    <div class="form-group">
        <label for="password" style="padding-top: 2%">Password:</label>
        <label for="password_edit"></label><textarea class="form-control" id="password_edit" name="password_edit"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Save Changes</button>
</form>

<form action="{{ route('delete-profile') }}" method="POST" style="margin-top: 2%">
    @csrf
    @method('DELETE') <!-- Method spoofing for DELETE request -->
    <div class="form-group">
        <label for="delete_account_pass_confirmation">Confirm account deletion by entering your password:</label>
        <input type="password" class="form-control" id="delete_account_pass_confirmation" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Delete</button>
</form>
