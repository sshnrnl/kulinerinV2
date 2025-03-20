@extends('dashboard.restaurantDashboard')

@section('title', 'Settings')

@section('content')
<div class="container">
    <h3>Welcome to Dashboard Settings, {{ $restaurant->restaurantName }}</h3>

    <form id="settings_form" action="{{ route('restaurant.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="input-group">
            <label for="name">Restaurant Name</label>
            <input type="text" name="name" id="name" placeholder="Restaurant Name"
                value="{{ old('name', $restaurant->restaurantName) }}" required>
        </div>

        <div class="input-group">
            <label for="number">Restaurant Phone Number</label>
            <input type="text" name="number" id="number" placeholder="Phone Number"
                value="{{ old('number', $restaurant->restaurantPhoneNumber) }}" required>
        </div>

        <div class="input-group">
            <label for="city">Restaurant City</label>
            <input type="text" name="city" id="city" placeholder="City"
                value="{{ old('city', $restaurant->restaurantCity) }}" required>
        </div>

        <div class="input-group">
            <label for="address">Restaurant Address</label>
            <input type="text" name="address" id="address" placeholder="Address"
                value="{{ old('address', $restaurant->restaurantAddress) }}" required>
        </div>

        <div class="input-group">
            <label for="desc">Restaurant Description</label>
            <textarea name="desc" id="desc" placeholder="Description" required>{{ old('desc', $restaurant->restaurantDescription) }}</textarea>
        </div>

        <div class="input-group" style="display: grid;">
            <label for="style">Restaurant Category</label>
            <select name="style" id="style" required>
                <option value="Asian" {{ $restaurant->restaurantStyle == 'Asian' ? 'selected' : '' }}>Asian</option>
                <option value="Western" {{ $restaurant->restaurantStyle == 'Western' ? 'selected' : '' }}>Western</option>
                <option value="Fine Dining" {{ $restaurant->restaurantStyle == 'Fine Dining' ? 'selected' : '' }}>Fine Dining</option>
                <option value="Bar" {{ $restaurant->restaurantStyle == 'Bar' ? 'selected' : '' }}>Bar</option>
            </select>
        </div>


        <div class="input-group" style="grid-column: span 2; display: grid;">
            <label for="image">Update Images (Min 3)</label>

            <div id="imagePreviewContainer" style="display: flex; gap: 10px; margin-top: 10px;">
                @php
                $images = explode(',', $restaurant->restaurantImage);
                $images = array_map('trim', $images);
                $maxSlots = 3; // Ensure 3 slots exist

                // Adjust array to always have exactly 3 slots
                for ($i = 0; $i < $maxSlots; $i++) {
                    if (!isset($images[$i])) {
                    $images[$i]=null; // Fill missing slots with null
                    }
                    }
                    @endphp

                    @foreach($images as $index=> $image)
                    <div class="image-wrapper">
                        <img src="{{ $image ? asset('storage/' . $image) : asset('storage/restaurant/default.jpg') }}"
                            class="preview-image" data-index="{{ $index }}" onclick="triggerFileInput({{ $index }})"
                            style="width: 100px; height: 100px; cursor: pointer; object-fit: cover;">

                        <!-- Hidden input to maintain null values -->
                        <input type="hidden" name="existing_images[{{ $index }}]" value="{{ $image ?? 'null' }}">

                        <input type="file" name="image[{{ $index }}]" class="image-input" data-index="{{ $index }}"
                            accept="image/*" style="display: none;" onchange="replaceImage(event, {{ $index }})">
                    </div>
                    @endforeach
            </div>

            <small id="imageError" style="color: red; display: none;">Please upload at least 3 images.</small>
        </div>


        <button type="submit">Update Restaurant</button>
    </form>
</div>

<script>
    function triggerFileInput(index) {
        document.querySelector(`input.image-input[data-index="${index}"]`).click();
    }

    function replaceImage(event, index) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector(`.preview-image[data-index="${index}"]`).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection