<h1>Route Search</h1>
<p>Write something here</p>
<form action="{{ route('search.result') }}" method="GET">

    <h5>Search by date:</h5>
    <label for="date">Date:</label>
    <input type="date" id="dateSearch" name="dateToSearch">
    <br><br>

    <h5>Search by guide:</h5>
    <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="guideSelect" name="guideName">
        @foreach($guides as $guide)
            <option value="{{ $guide->id }}">{{ $guide->user->name }}</option>
        @endforeach
    </select>

    <div class="selected-attractions">
        <h5>Search routes that contain at least one of the following attractions:</h5>
        <div class="attraction-selection">
            <div class="selection-container">
                <select id="attraction-search" name="attractionsToSearch[]" class="form-select" aria-label="Select Attraction" multiple>
                    @foreach($attractions as $attraction)
                        <option value="{{ $attraction->id }}">{{ $attraction->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-primary btn-bg rounded-pill" onclick="addSelectedAttractions(event)">Add</button>
            </div>
        </div>
        <p>Click to remove</p>
        <ul id="selectedListToSearch" onclick="removeAttraction(event)">
            <!-- Selected attractions will be dynamically added here -->
        </ul>
    </div>

    <h5>Search routes that take place in one of the following cities:</h5>
    <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="citySelect" name="cityToSearch_id">
        @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>

    <h5>Search routes that take place in one of the following countries:</h5>
    <select class="form-select form-select-bg mb-3" aria-label=".form-select-lg example" id="citySelect" name="typeToSearch_id">
        @foreach($cities->unique('country_id') as $city)
            <option value="{{ $city->id }}">{{ $city->country->name }}</option>
        @endforeach
    </select>

    <h5>Search routes with rating equal or greater than:</h5>


    <button type="submit" class="btn btn-primary btn-bg btn btn-primary mt-10">Search</button>
</form>

<script>
    function addSelectedAttractions() {

        event.preventDefault();
        let selectElement = document.getElementById("attraction-search");
        let selectedOptions = selectElement.selectedOptions;
        let selectedList = document.getElementById("selectedListToSearch");

        for (let i = 0; i < selectedOptions.length; i++) {
            let option = selectedOptions[i];
            if (!isAlreadyAdded(option.textContent, selectedList)) {
                let listItem = document.createElement("li");
                listItem.textContent = option.textContent;
                selectedList.appendChild(listItem);

                // Create hidden input for each selected attraction
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "attractionsToSearch[]";
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
