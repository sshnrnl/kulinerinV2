@extends('dashboard.restaurantDashboard')

@section('title', 'Reservation Management')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Manage Reservation</h2>
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body border">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">List of Reservation</h5>

                        </div>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Guest</th>
                                        <th>Table Area</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Booking Code</th>
                                        <th>Menu</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->user->username }}</td>
                                            <td>{{ $reservation->guest }}</td>
                                            <td>{{ $reservation->tableType }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->reservationDate)->format('d/m/y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->reservationTime)->format('H:i') }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge
                                                    {{ $reservation->reservationStatus == 'Arrived'
                                                        ? 'bg-primary'
                                                        : ($reservation->reservationStatus == 'Finished'
                                                            ? 'bg-success'
                                                            : ($reservation->reservationStatus == 'Cancelled'
                                                                ? 'bg-danger'
                                                                : 'bg-warning')) }}">
                                                    {{ $reservation->reservationStatus }}
                                                </span>
                                            </td>
                                            <td>{{ $reservation->bookingCode }}</td>
                                            <td>
                                                {!! !empty($reservation->menuData) ? str_replace(',', '<br>', $reservation->menuData) : 'No menu ordered' !!}
                                            </td>
                                            <td>
                                                {{ !empty($reservation->priceTotal) ? number_format($reservation->priceTotal, 0) : '-' }}
                                            </td>
                                            <td>
                                                @if ($reservation->reservationStatus == 'On Going')
                                                    <button class="btn btn-sm btn-success confirm-arrival"
                                                        data-id="{{ $reservation->id }}">
                                                        Confirm Arrival
                                                    </button>
                                                @elseif ($reservation->reservationStatus == 'Arrived')
                                                    <p class="fst-italic">
                                                        Waiting...
                                                    </p>
                                                @elseif ($reservation->reservationStatus == 'Finished')
                                                    <p class="fst-italic">
                                                        Finished
                                                    </p>
                                                @elseif ($reservation->reservationStatus == 'Cancelled')
                                                    <p class="fst-italic">
                                                        Canceled
                                                    </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center fst-italic">No reservations found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $(".confirm-arrival").click(function() {
                let reservationId = $(this).data("id"); // Ambil ID reservasi dari tombol

                // Tampilkan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: "Are you sure?",
                    text: "Confirm that the guest has arrived!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, confirm it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, jalankan AJAX
                        $.ajax({
                            url: `/reservation/${reservationId}/confirm-arrival`,
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                    "content") // CSRF Token
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    location
                                        .reload(); // Reload halaman setelah sukses
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: "Error!",
                                    text: xhr.responseJSON.message ||
                                        "Something went wrong!",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>


@endsection
