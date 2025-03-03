@extends('dashboard.restaurantDashboard')

@section('title', 'Edit Menu')

@section('content')
    <div class="form-container padding-top:250px">
        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="menuName">Menu Name:</label>
            <input type="text" name="menuName" value="{{ $menu->menuName }}" required>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="" disabled>Select Category</option>
                    <option value="Appetizer" {{ old('category', $menu->category) == 'Appetizer' ? 'selected' : '' }}>
                        Appetizer</option>
                    <option value="Main Course" {{ old('category', $menu->category) == 'Main Course' ? 'selected' : '' }}>
                        Main Course</option>
                    <option value="Dessert" {{ old('category', $menu->category) == 'Dessert' ? 'selected' : '' }}>Dessert
                    </option>
                    <option value="Beverages" {{ old('category', $menu->category) == 'Beverages' ? 'selected' : '' }}>
                        Beverages</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="desc">Menu Image</label>
                <input class="form-control form-control" name="menuImage" id="image" type="file"
                    onchange="previewImage()" accept=".jpg,.jpeg,.png" value="{{ old('menuImage') }}">
                <img src="{{ asset('storage/' . $menu->menuImage) }}" class="img-preview img-fluid d-block mb-3 col-sm-4">
            </div>
            <label for="menuPrice">Price:</label>
            <input type="text" name="menuPrice" id="menuPrice" value="{{ number_format($menu->menuPrice, 0, '.', ',') }}"
                required oninput="formatPrice(this)">
            <label for="isAVailable">Available:</label>
            <select name="isAVailable" id="isAVailable" required>
                <option value="YES" {{ old('isAVailable', $menu->isAVailable) === 'YES' ? 'selected' : '' }}>YES</option>
                <option value="NO" {{ old('isAVailable', $menu->isAVailable) === 'NO' ? 'selected' : '' }}>NO</option>
            </select>
            <label for="description">Description:</label>
            <textarea name="description">{{ $menu->description }}</textarea>
            <button class="back-button" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
                Back
            </button>
            <button type="submit">Update Menu</button>
        </form>
    </div>
    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = "/menu";
            }
        }

        function previewImage() {
            const image = document.querySelector('#image');

            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function formatPrice(input) {
            // Hapus semua karakter selain angka
            let value = input.value.replace(/,/g, '');

            // Format ulang dengan koma sebagai pemisah ribuan
            input.value = new Intl.NumberFormat('en-US').format(value);
        }

        document.querySelector("form").addEventListener("submit", function() {
            let input = document.getElementById("menuPrice");
            input.value = input.value.replace(/,/g, ''); // Hapus koma sebelum dikirim ke server
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .image-preview {
            display: none;
            margin-top: 10px;
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }

        .form-container {
            background-color: #d3d3d3;
            padding: 20px;
            border-radius: 10px;
            width: 500px;
        }

        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .form-container input[type="file"] {
            display: block;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            border: 1px solid #000;
            background-color: white;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #ddd;
        }
    </style>

@endsection
