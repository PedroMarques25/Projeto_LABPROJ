<h1 style="margin-top: 10%">Add new route</h1>
<form action="{{ route('routes.creation') }}" method="POST">
    @csrf<!-- CSRF protection -->

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="route_image">Route Image:</label>
    <input type="file" id="route_image" name="route_image" accept="image/*" ><br><br>

    <div class="attraction-selection">
        <div class="selection-container">
            <select id="attraction-select" name="attractions[]" class="form-select" aria-label="Select Attraction" multiple>
                @foreach($attractions as $attraction)
                    <option value="{{ $attraction->id }}">{{ $attraction->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary btn-bg rounded-pill" onclick="addSelectedAttractions()">Add attraction</button>
        </div>
    </div>

    <div class="selected-attractions" style="margin-top: 2%">
        <h2>Selected Attractions:</h2>
        <p>Click to remove</p>
        <ul id="selectedList" onclick="removeAttraction(event)">
            <!-- Selected attractions will be dynamically added here -->
        </ul>
    </div>

    <label for="total_slots">Total Slots (1-100):</label>
    <input type="number" id="total_slots" name="total_slots" min="1" max="100" required><br><br>


    <label for="aboutIt">About It:</label><br>
    <textarea id="aboutIt" name="aboutIt" rows="4" cols="50" required></textarea><br>

    <label for="fee">Fee:</label><br>
    <input type="text" id="fee" name="fee" required><br><br>

    <label for="route_date">Route Date:</label>
    <input type="date" id="route_date" name="route_date" required min="{{ date('Y-m-d') }}"><br>

    <button type="submit" class="btn btn-primary btn-bg rounded-pill mt-5">Create Route</button>

    <form action="{{ route('routes.creation') }}" method="POST" class="text-center">
        @csrf
        <button type="submit" class="btn btn-primary btn-bg rounded-pill mt-5">Create new attraction</button>
    </form>
</form>

<script>
    function addSelectedAttractions() {
        let selectElement = document.getElementById("attraction-select");
        let selectedOptions = selectElement.selectedOptions;
        let selectedList = document.getElementById("selectedList");

        for (let i = 0; i < selectedOptions.length; i++) {
            let option = selectedOptions[i];
            if (!isAlreadyAdded(option.textContent, selectedList)) {
                let listItem = document.createElement("li");
                listItem.textContent = option.textContent;
                selectedList.appendChild(listItem);

                // Create hidden input for each selected attraction
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "attractions[]";
                hiddenInput.value = option.value; // Set the value to the attraction ID
                selectedList.appendChild(hiddenInput);
            }
        }
    }


    function isAlreadyAdded(textContent, selectedList) {
        let listItems = selectedList.getElementsByTagName("li");
        for (let i = 0; i < listItems.length; i++) {
            if (listItems[i].textContent === textContent) {
                return true;
            }
        }
        return false;
    }


    function removeAttraction(event) {
        if (event.target.tagName === "LI") {
            event.target.remove();
        }
    }
</script>
