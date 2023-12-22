<h2 style="margin-top: 4%">Remove guide</h2>
<form action="{{ route('delete-guide') }}"{{----}} method="DELETE" style="margin-top: 2%">
    @csrf
    @method('DELETE') <!-- Method spoofing for DELETE request -->
    <div class="form-group">
        <label for="delete_guide_pass_confirmation">Confirm guide function deletion by entering your password:</label>
        <input type="password" class="form-control" id="delete_guide_pass_confirmation" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary mt-10">Confirm</button>
</form>
