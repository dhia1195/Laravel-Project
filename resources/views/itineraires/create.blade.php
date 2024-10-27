<x-layouts.app>
    <div class="container">
        <h1>Create New Itinerary</h1>

        <form action="{{ route('itineraires.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control" id="titre" required maxlength="255" pattern="[A-Za-z\s]+" title="Please enter a title using only letters and spaces.">
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" required maxlength="500" title="Please enter a description using only letters and spaces."></textarea>
            </div>
            
            <div class="form-group">
                <label for="duree">Durée</label>
                <select name="duree" class="form-control" id="duree" required title="Please select a duration.">
                    <option value="" disabled selected>Select Duration</option>
                    <option value="1">1 h</option>
                    <option value="2">2 h</option>
                    <option value="3">3 h</option>
                    <option value="4">4 h</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="prix">Prix</label>
                <select name="prix" class="form-control" id="prix" required title="Please select a price.">
                    <option value="" disabled selected>Select Price</option>
                    <option value="10">10 Dinars</option>
                    <option value="20">20 Dinars</option>
                    <option value="30">30 Dollars</option>
                    <option value="100">100 Dinars (Premium)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="difficulte">Difficulté</label>
                <select name="difficulte" class="form-control" id="difficulte" required title="Please select a difficulty level.">
                    <option value="" disabled selected>Select Difficulty</option>
                    <option value="facile">Facile</option>
                    <option value="moyenne">Moyenne</option>
                    <option value="difficile">Difficile</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="impact_carbone">Impact Carbone (kg)</label>
                <input type="number" name="impact_carbone" class="form-control" id="impact_carbone" required min="0" step="0.01" title="Enter the carbon impact in kilograms (minimum 0).">
            </div>
            
            <div class="form-group">
                <label for="image_url">Choose Image</label>
                <input type="file" name="image_url" class="form-control-file" id="image_url" accept=".jpg, .jpeg, .png" title="Choose a JPG or PNG image file (optional).">
            </div>
            <div class="form-group">
                <label for="destination_id">Select Destination</label>
                <select name="destination_id" class="form-control" id="destination_id"  required>
                    <option value="">Sélectionnez une destination</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}">{{ $destination->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Itinerary</button>
        </form>
    </div>
   

    <script>
        function validateForm() {
            const description = document.getElementById('description').value;
            const regex = /^[A-Za-z\s]+$/;

            if (!regex.test(description)) {
                alert('Please enter a description using only letters and spaces.');
                return false;
            }
            return true;
        }
    </script>
</x-layouts.app>
