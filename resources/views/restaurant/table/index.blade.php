@extends('dashboard.restaurantDashboard')

@section('title', 'Table Management')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Manage Table</h2>
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body border">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">Table List</h5>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addMenuModal">
                                <i class="bi bi-plus"></i> Add Table
                            </a>
                        </div>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Table Capacity</th>
                                        <th>Available Tables</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tableRestaurant as $table)
                                        <tr>
                                            <td>{{ $table->tableCapacity }} People(s)</td>
                                            <td>{{ $table->availableTables }} Table(s)</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editMenuModal" data-id="{{ $table->id }}">
                                                        <i class="bi bi-pencil-square">Edit</i>
                                                    </a>
                                                    <form class="delete-form d-inline"
                                                        action="{{ route('table.destroy', $table->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn">
                                                            <i class="bi bi-trash">Delete</i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
        //AJAX FOR DELETE
        $(document).ready(function() {
            $(".delete-btn").click(function(e) {
                e.preventDefault();

                let btn = $(this);
                let form = btn.closest("form");
                let url = form.attr("action");
                // console.log(url);
                let token = $('meta[name="csrf-token"]').attr("content");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                _token: token,
                                _method: "DELETE"
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", "The item has been deleted.",
                                        "success")
                                    .then(() => location
                                        .reload());
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", "Failed to delete item.", "error");
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        //
    </script>
    @include('restaurant.menu.createMenu')
    @include('restaurant.menu.updateMenu')
@endsection
