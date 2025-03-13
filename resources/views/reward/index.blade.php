<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Redemption</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="{{ asset('css/redem.css') }}" rel="stylesheet">
</head>
@extends('master.masterCustomer')
@section('content')

    <body>
        <div class="container">
            <div class="header">
                <h1>Reward Redemption</h1>
                <div class="user-points">
                    <i class="fas fa-coins"></i>
                    <span>Your Points: <span id="userPoints">{{ $userPoints->point }}</span></span>
                </div>
            </div>

            <div class="tabs">
                <div class="tab active" data-tab="rewards">Available Rewards</div>
                <div class="tab" data-tab="history">Redemption History</div>
            </div>

            <div id="rewards" class="tab-content active">
                <div class="filters">
                    <div class="filter-group">
                        @foreach ($categories as $cat)
                            <button class="filter-btn {{ $category === $cat ? 'active' : '' }}"
                                data-category="{{ $cat }}">
                                {{ $cat === 'all' ? 'All' : ucfirst($cat) }}
                            </button>
                        @endforeach
                    </div>
                    {{-- <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search rewards...">
                </div> --}}
                </div>

                <div class="rewards-grid">
                    @foreach ($rewards as $reward)
                        <div class="reward-card" data-category="{{ $reward->category }}">
                            <div class="reward-image"
                                style="background-image: url('{{ asset('storage/' . $reward->image) }}');">
                                <span class="reward-category">{{ ucfirst($reward->category) }}</span>
                                <span class="reward-stock">Stock: {{ $reward->stock }}</span>
                            </div>
                            <div class="reward-details">
                                <h3 class="reward-name">{{ $reward->name }}</h3>
                                <p class="reward-description">{{ $reward->description }}</p>
                            </div>
                            <div class="reward-footer">
                                <div class="reward-points">
                                    <i class="fas fa-coins"></i>
                                    <span>{{ $reward->points }} points</span>
                                </div>
                                {{-- <button class="redeem-btn" data-id="{{ $reward->id }}" data-name="{{ $reward->name }}"
                                    data-points="{{ $reward->points }}">
                                    Redeem
                                </button> --}}
                                {{-- <form action="{{ route('rewards.redeem', ['id' => $reward->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="redeem-btn">Redeem</button>
                                </form> --}}
                                <form id="redeemForm-{{ $reward->id }}" data-id="{{ $reward->id }}"
                                    action="{{ route('rewards.redeem', ['id' => $reward->id]) }}" method="POST">
                                    @csrf
                                    <button type="button" class="redeem-btn" onclick="redeemReward({{ $reward->id }})">
                                        Redeem
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="history" class="tab-content">
                <h2>Redemption History</h2>

                <div class="filter-controls">
                    <div>
                        <label for="status-filter">Filter by status:</label>
                        <select id="status-filter" class="filter-dropdown">
                            <option value="all">All</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label for="sort-order">Sort by:</label>
                        <select id="sort-order" class="filter-dropdown">
                            <option value="newest">Newest first</option>
                            <option value="oldest">Oldest first</option>
                        </select>
                    </div>
                </div>

                <div class="history-list">
                    @foreach ($redeems as $item)
                        <div class="history-item">
                            <div class="reward-info">
                                <div class="reward-image">
                                    <img src="{{ asset('storage/' . $item->reward->image) }}"
                                        alt="{{ $item->reward->name }}"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                                </div>
                                <div class="reward-details">
                                    <h3 class="text-lg font-semibold mb-2">{{ $item->reward->name ?? 'Reward Not Found' }}
                                    </h3>
                                    <p class="mb-2">Points Used: <strong>{{ $item->points_used }}</strong> Point(s)</p>
                                    <p class="mb-2">Redemption Code: <span
                                            class="fst-italic">{{ $item->redemption_code }}</span></p>
                                </div>
                            </div>
                            <div class="reward-meta">
                                <div class="reward-date">{{ $item->created_at->format('d M Y H:i') }}</div>
                                <div class="reward-status status-completed">{{ $item->status }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination">
                    <button>1</button>
                    <button class="active">2</button>
                    <button>3</button>
                    <button>Next →</button>
                </div>
            </div>
        </div>
        <div id="redeem-modal" class="modal" style="display: none;">
            <div class="modal-content">
                <p id="modal-message"></p>
                <button id="confirm-redeem">Confirm</button>
                <button id="cancel-redeem">Cancel</button>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const selectedCategory = this.getAttribute('data-category');

                // Perbarui URL agar tetap bisa diakses
                const url = new URL(window.location.href);
                url.searchParams.set('category', selectedCategory);
                window.history.pushState({}, '', url);

                // Perbarui tampilan filter aktif
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Filter reward berdasarkan kategori
                document.querySelectorAll('.reward-card').forEach(card => {
                    const rewardCategory = card.getAttribute('data-category');
                    if (selectedCategory === 'all' || rewardCategory === selectedCategory) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Hide all tab content
                    const tabContents = document.querySelectorAll('.tab-content');
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Show the corresponding tab content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });

        function redeemReward(rewardId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to redeem this reward?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Redeem it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById(`redeemForm-${rewardId}`);
                    let formData = new FormData(form);

                    fetch(form.action, {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success!",
                                    html: `<p>${data.message}</p><strong style="color: #D67B47ff;">${data.data}</strong>`,
                                    confirmButtonColor: "#3085d6"
                                }).then(() => {
                                    location.reload(); // Reload halaman setelah sukses
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: data.message,
                                    confirmButtonColor: "#d33"
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Something went wrong. Please try again.",
                                confirmButtonColor: "#d33"
                            });
                        });
                }
            });
        }
    </script>
@endsection
