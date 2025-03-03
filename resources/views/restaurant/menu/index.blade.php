@extends('dashboard.restaurantDashboard')

@section('title', 'Menu Management')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Manage Menu</h2>
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body border">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">Menu List</h5>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addMenuModal">
                                <i class="bi bi-plus"></i> Add Menu
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
                                        <th>Menu Name</th>
                                        <th>Category</th>
                                        <th>Menu Image</th>
                                        <th>Menu Price</th>
                                        <th>Is Available</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $item)
                                        <tr>
                                            <td>{{ $item->menuName }}</td>
                                            <td>{{ $item->category }}</td>
                                            <td>
                                                @if ($item->menuImage)
                                                    <img src="{{ asset('storage/' . $item->menuImage) }}" width="50"
                                                        height="50" alt="Menu Image">
                                                    {{-- <img src="{{ asset('storage/' . $item->image) }}" width="50"> --}}
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->menuPrice, 0, '.', ',') }}</td>
                                            <td>
                                                {{-- {{ $item->isAVailable }} --}}
                                                <span
                                                    class="badge {{ $item->isAVailable == 'YES' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->isAVailable == 'YES' ? 'YES' : 'NO' }}
                                                </span>
                                            </td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editMenuModal" data-id="{{ $item->id }}">
                                                        <i class="bi bi-pencil-square">Edit</i>
                                                    </a>
                                                    <form class="delete-form d-inline"
                                                        action="{{ route('menu.destroy', $item->id) }}" method="POST">
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
