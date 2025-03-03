<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View | {{$restaurants->restaurantName}}</title>
    <link rel="icon" href="{{ asset('asset/kulinerinLogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body style="background-color: #DECEB0ff">
    <style>
      .stars {
      color: #f97e0a;
      }
      .fade-out {
      opacity: 0;
      transition: opacity 0.25s ease-in-out;
      }
      .fade-in {
      opacity: 1;
      transition: opacity 0.25s ease-in-out;
      }
      .modal {
      display: none; 
      position: fixed; 
      z-index: 1; 
      left: 0;
      top: 0;
      width: 100%; 
      height: 100%; 
      overflow: auto; 
      background-color: rgb(0,0,0); 
      background-color: rgba(0,0,0,0.4); 
      }
      .modal-content {
      background-color: #fefefe;
      margin: 15% auto; 
      padding: 20px;
      border: 1px solid #888;
      width: 50%; 
      }
      .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      }
      .close:hover,
      .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
      }
      .reservation-details {
      padding: 20px 0;
      border-bottom: 1px solid #eee;
      }
      .reservation-text {
      color: #333;
      font-size: 16px;
      line-height: 1.5;
      margin: 0 0 4px 0;
      }
      .button-group {
      display: flex;
      padding-top: 2.5rem;
      gap: 12px;
      margin-top: 20px;
      justify-content: flex-end;
      }
      .button {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s;
      }
      .cancel-button {
      background-color: #e0e0e0;
      color: #333;
      }
      .cancel-button:hover {
      background-color: #d0d0d0;
      }
      .book-button {
      background-color: #007AFF;
      color: white;
      }
      .book-button:hover {
      background-color: #0066CC;
      }
      .image_style{
        height: 148px;
        width: 180px;
        border-radius: 20px 0px 0px 20px;
    }
      
    </style>
    @extends('master.masterCustomer')
    @section('content')
    <div class="container py-4" style="max-width: 100%; padding-left: 2rem;padding-right: 2rem">
      <div class="card shadow-sm border-dark" style="border-radius: 15px">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h2 class="card-title mb-3">{{$restaurants->restaurantName}}</h2>
              <div class="mb-3">
                {{-- Generate star ratings dynamically --}}
                @php
                    $averageScore = $ratingData['averageScore'];
                    $totalReviewers = $ratingData['totalReviewers'];

                    $fullStars = floor($averageScore); // Full stars (integer part)
                    $halfStar = ($averageScore - $fullStars) >= 0.5 ? true : false; // Check if there's a half star
                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Remaining empty stars
                @endphp
            
                {{-- Display full stars --}}
                @for ($i = 0; $i < $fullStars; $i++)
                    <span class="stars">★</span>
                @endfor
            
                {{-- Display half star if applicable --}}
                @if ($halfStar)
                    <span class="stars">⯪</span>
                @endif
            
                {{-- Display empty stars --}}
                @for ($i = 0; $i < $emptyStars; $i++)
                    <span class="text-muted">☆</span>
                @endfor
            
                <span class="ms-2 text-muted">({{ $totalReviewers }} Reviews)</span>
              </div>
            </div>
            <hr>
            <div class="row" style="padding-left: 1.5rem; padding-right:0rem">
              <div class="col-md-8">
                <div class="bg-light mb-3 border overflow-hidden" style="height: 500px; border-radius: 8px; transition: opacity 0.5s ease-in-out;">
                  <div class="h-100">
                    <img id="mainImage" src="{{URL::to('/') ."/". $images[0]}}" style="width: 100%; height: 100%; object-fit: fill;">
                  </div>
                </div>
              </div>
              <div class="col-md-4" >
                @foreach ($images as $image)
                <div class="bg-light mb-3 overflow-hidden" style="height: 155px; border-radius: 8px;">
                  <div class="h-100">
                    <img src="{{URL::to('/') ."/". $image}}" style="width: 100%; height: 100%; object-fit: fill; cursor: pointer;" onclick="changeImage('{{$image}}')">
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Review</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="book-table-tab" data-bs-toggle="tab" data-bs-target="#book-table" type="button" role="tab" aria-controls="book-table" aria-selected="false">Book Table</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" type="button" role="tab" aria-controls="menu" aria-selected="false">Menu</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <!-- Overview Tab Content -->
        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
          <div class="row mt-4">
            <div class="col-md-6">
              <h5>About</h5>
              <p><strong>Location:</strong> {{$restaurants->restaurantAddress}}</p>
              <p><strong>Opening Hours:</strong> Mon-Sun: 6am-9pm</p>
              <p><strong>Contact:</strong> {{$restaurants->restaurantPhoneNumber}} | {{$restaurants->restaurantEmail}}</p>
            </div>
            <div class="col-md-6">
              <h5>Book Table</h5>
              {{-- 
              <form>
                --}}
                <div class="mb-3">
                  <label for="people" class="form-label">People</label>
                  <input type="number" class="form-control" id="people">
                </div>
                <div class="mb-3">
                  <label for="date" class="form-label">Date</label>
                  <input type="date" class="form-control" id="date">
                </div>
                <button id="myBtn" onclick="myBtnClick()" class="btn btn-primary">Book Now</button>
                {{-- 
              </form>
              --}}
            </div>
          </div>
        </div>
        
        <!-- Review Tab Content -->
        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
          <div class="col-md-8" style="padding-top:1rem">
              <div class="card p-3 h-auto">
                  <h5><strong>Customer Reviews</strong></h5>
                  <hr>
                  @if ($ratingData['reviews']->isEmpty())
                      <p class="text-muted text-center">No reviews yet. Be the first to review!</p>
                  @else
                  {{-- <h5><strong>Customer Reviews</strong></h5>
                  <hr> --}}
                      @foreach ($ratingData['reviews'] as $review)
                          <div class="card p-2 mb-2 h-auto" style="height: auto;">
                              <!-- User and Time -->
                              <div class="d-flex justify-content-between align-items-center">
                                  <p class="fst-italic m-0"><strong>By {{ $review->user->username }} :</strong></p>
                                  <span class="fw-light text-muted small">{{ $review->created_at->diffForHumans() }}</span>
                              </div>
                              
                              <!-- Rating -->
                              <p class="m-0 stars">
                                  <strong>
                                      @for ($i = 0; $i < $review->score; $i++)
                                          &#9733;
                                      @endfor
                                      @for ($i = $review->score; $i < 5; $i++)
                                          &#9734;
                                      @endfor
                                  </strong>
                              </p>
                              
                              <!-- Review Content -->
                              <p class="m-0">{{ $review->review }}</p>
                          </div>
                      @endforeach
                  @endif
              </div>
          </div>
      </div>

        {{-- <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
            <h5 style="padding-top:1rem">Customer Reviews</h5>
        
            @if($ratingData['reviews']->isEmpty())
                <p>No reviews yet. Be the first to review!</p>
            @else
                @foreach ($ratingData['reviews'] as $review)
                    <div class="review-item">
                        <p><strong style="font-style: italic">By {{ $review->user->username }} :</strong> <br>
                            @for ($i = 0; $i < $review->score; $i++)
                                ★
                            @endfor
                            @for ($i = $review->score; $i < 5; $i++)
                                ☆
                            @endfor
                            <p>{{ $review->review }}</p>
                        </p>
                    </div>
                @endforeach
            @endif
        
            <button class="btn btn-secondary">See All Reviews</button>
        </div> --}}
      

        <!-- Book Table Tab Content -->
        <div class="tab-pane fade" id="book-table" role="tabpanel" aria-labelledby="book-table-tab">
          <h5 style="padding-top:1rem">Reserve a Table</h5>
          <div class="mb-3">
            <label for="people-book" class="form-label">Number of People</label>
            <input type="number" id="inputGuest" name="guest" class="form-control" id="people-book" required>
          </div>
          <div class="mb-3">
            <label for="date-book" class="form-label">Reservation Date</label>
            <input type="date" id="inputDate" name="reservationDate" class="form-control" required id="date-book">
          </div>
          <div class="mb-3">
            <label for="time-book" class="form-label">Reservation Time</label>
            <input type="time" id="inputTime" name="reservationTime" class="form-control" required id="time-book">
          </div>
          <button id="myBtn" onclick="myBtnClick()" class="btn btn-primary">Reserve Now</button>
        </div>

        
        <!-- Menu Tab Content -->
        <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
          <h3 class="mb-4" style="padding-top:1rem">Appetizer</h3>
          <div class="row g-4">
              @foreach ($appetizer as $appetizerMenu)
              <div class="col-lg-6 d-flex">
                <div class="card" style="height: 150px; border-radius: 20px; width: 100%; background-color: #DECEB0ff; border-color: white">
                  <div class="row">
                      <div class="col" >
                          <img src={{ asset($appetizerMenu->menuImage) }} class="image_style img-fluid object-fit-cover" alt="Menu Image">
                      </div>
                      <div class="col-6 mt-3 mb-3" >
                          <h5>{{$appetizerMenu->menuName}}</h5>
                          <p>{{$appetizerMenu->description}}</p>
                      </div>
                      <div class="col">
                        <p class="col d-flex justify-content-center align-items-center" style="height: 100%;">
                          {{-- {{ number_format($appetizerMenu->menuPrice) }} --}}
                          {{ number_format($appetizerMenu->menuPrice, 0, '.', ',') }}
                      </p>
                      </div>
                  </div>                  
              </div>
              </div>
              @endforeach
          </div>
        </div>
      </div>
    </div>
    <div id="myModal" class="modal">
      <div class="modal-content">
        <hr>
        <p class="reservation-text">You are making a reservation for</p>
        <p class="reservation-text" id="guest-info"></p>
        <p class="reservation-text" id="restaurant-name">{{$restaurants->restaurantName}} ({{$restaurants->restaurantCity}}) on</p>
        <p class="reservation-text" id="reservation-info"></p>
        <div class="button-group">
          <button class="button cancel-button" onclick="spanClick()">Cancel</button>
          <form action="{{ route('booking') }}" method="POST">
            @csrf
            <input type="hidden" name="guest" id="guest_hidden">
            <input type="hidden" name="reservationDate" id="date_hidden">
            <input type="hidden" name="reservationTime" id="time_hidden">
            <button type="submit" class="button book-button">Book Table</button>
          </form>
          <button class="button book-button" onclick="redirectToMenu()">Book Menu</button>
        </div>
      </div>
    </div>
    <script>
      var modal = document.getElementById("myModal");
      var span = document.getElementsByClassName("close")[0];
      const inputGuest = document.getElementById("inputGuest");
      const inputDate = document.getElementById("inputDate");
      const inputTime = document.getElementById("inputTime");
      
      const guestInfo = document.getElementById("guest-info");
      const reservationInfo = document.getElementById("reservation-info");
      
      
      function myBtnClick (event) {
        //event.preventDefault(); // Prevent form submission
        // console.log("test")
        const guestValue = inputGuest.value;
        const dateValue = inputDate.value;
        const timeValue = inputTime.value;
      
        const dateObject = new Date(dateValue);
      
        const formattedDate = dateObject.toLocaleDateString('en-GB', {
        weekday: 'short',  // "Tue"
        day: '2-digit',    // "31"
        month: 'short',    // "Dec"
        year: 'numeric'    // "2024"
      });
      
        guestInfo.textContent = `${guestValue} guests at `;
        reservationInfo.innerHTML = `${formattedDate}, ${timeValue}WIB`;
      
        const guest_hidden = document.getElementById("guest_hidden");
        guest_hidden.value = inputGuest.value;
      
        const date_hidden = document.getElementById("date_hidden");
        date_hidden.value = inputDate.value;
      
        const time_hidden = document.getElementById("time_hidden");
        time_hidden.value = inputTime.value;
      
        modal.style.display = "block";
      }

      function redirectToMenu(){
        const guestInfo = document.getElementById('guest-info').textContent;
        const restaurantName = '{{$restaurants->restaurantName}}';
        const restaurantCity = '{{$restaurants->restaurantCity}}';
        const reservationInfo = document.getElementById('reservation-info').textContent;

        // console.log(restaurantCity);
        const restaurantId = '{{ $restaurants->id }}';
        // const nextPageUrl = `/restaurantMenu/${restaurantId}?guest_info=${encodeURIComponent(guestInfo)}&reservation_info=${encodeURIComponent(reservationInfo)}&restaurant_name=${encodeURIComponent(restaurantName)}&restaurant_city=${encodeURIComponent(restaurantCity)}`;
        const nextPageUrl = `{{ route('indexMenu', '') }}/${restaurantId}?guest_info=${encodeURIComponent(guestInfo)}&reservation_info=${encodeURIComponent(reservationInfo)}&restaurant_name=${encodeURIComponent(restaurantName)}&restaurant_city=${encodeURIComponent(restaurantCity)}`;

        window.location.href = nextPageUrl;
      }
      
      
      function spanClick () {
        modal.style.display = "none";
      }
      
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
      
      
      function changeImage(newSrc) {
        // Get the main image element
        const mainImage = document.getElementById('mainImage');
      
        mainImage.classList.remove('fade-in');
        // Add the fade-out class to initiate the fade-out effect
        mainImage.classList.add('fade-out');
      
        // Wait for the fade-out animation to complete (0.5s duration)
        setTimeout(function() {
          // Change the image source
          mainImage.src = "{{ URL::to('/') ."/" }}" + newSrc;
      
          // Remove fade-out and add fade-in for the new image
          mainImage.classList.remove('fade-out');
          mainImage.classList.add('fade-in');
        }, 500); // This timeout corresponds to the fade-out duration
      }
      
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
      $(document).ready(function() {
          // Display error messages if any
          @if ($errors->any())
              @foreach ($errors->all() as $error)
                  toastr.error("{{ $error }}");
              @endforeach
          @endif
          
          // Display success message if session has success message
          @if (session('success'))
              toastr.success("{{ session('success') }}");
          @endif
      });
    </script>
    @endsection
  </body>
</html>