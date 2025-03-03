<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Restaurant</title>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: #212529;
            transition: all 0.3s ease-in-out;
        }

        .sidebar-collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 20px 15px;
            background: #141619;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 5px;
            margin: 2px 10px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .nav-link.active {
            background: #0d6efd;
            color: white;
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .toggle-btn {
            cursor: pointer;
            position: absolute;
            right: -15px;
            top: 15px;
            width: 30px;
            height: 30px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            z-index: 100;
        }

        .content {
            flex: 1;
            transition: all 0.3s;
        }

        /* Small text for the icon-only view */
        .menu-text {
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.2s;
        }

        .sidebar-collapsed .menu-text {
            opacity: 0;
            display: none;
        }

        .sidebar-collapsed .nav-link {
            text-align: center;
            padding: 12px 5px;
        }

        .sidebar-collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.4rem;
        }

        /* Mobile view */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -80px;
                /* Changed from -280px to -80px */
                position: fixed;
                z-index: 1040;
                height: 100%;
                width: 80px;
                /* Fixed width for mobile */
            }

            .sidebar.show {
                margin-left: 0;
            }

            /* Always hide text in mobile view */
            .sidebar .menu-text {
                opacity: 0;
                display: none;
            }

            .sidebar .nav-link {
                text-align: center;
                padding: 12px 5px;
            }

            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.4rem;
            }

            .backdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1030;
            }

            .backdrop.show {
                display: block;
            }
        }

        /* Page content styles */
        .content-page {
            display: none;
        }

        .content-page.active {
            display: block;
        }

        /* Animation for page transition */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .content-page.active {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar position-relative" id="sidebar">
            <div class="sidebar-header d-flex justify-content-between align-items-center">
                <h5 class="text-light mb-0 menu-text">Dashboard</h5>
                {{-- TANDA X
                <div class="d-flex align-items-center justify-content-center w-100">
                    <span class="text-light fs-4 d-md-none" id="close-sidebar">
                        <i class="bi bi-x"></i>
                    </span>
                </div> --}}
            </div>

            <button class="toggle-btn d-none d-md-flex" id="toggle-sidebar">
                <i class="bi bi-chevron-left" id="toggle-icon"></i>
            </button>

            <div class="mt-2">
                <ul class="nav flex-column sidebar-nav">
                    <li class="nav-item">
                        <a href="#home" class="nav-link active" title="Home" data-page="home-page">
                            <i class="bi bi-house-door"></i>
                            <span class="menu-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#dashboard" class="nav-link" title="Menu" data-page="dashboard-page">
                            <i class="bi bi-cup-hot"></i>
                            <span class="menu-text">Menu</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#users" class="nav-link" title="Table" data-page="users-page">
                            <i class="bi bi-people"></i>
                            <span class="menu-text">Table</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#events" class="nav-link" title="Order" data-page="events-page">
                            <i class="bi bi-cart3"></i>
                            <span class="menu-text">Order</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#reports" class="nav-link" title="Payment" data-page="reports-page">
                            <i class="bi bi-credit-card"></i>
                            <span class="menu-text">Payment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#messages" class="nav-link" title="Transaction Report" data-page="messages-page">
                            <i class="bi bi-file-earmark-text"></i>
                            <span class="menu-text">Transaction Report</span>
                        </a>
                    </li>
                </ul>

                <hr class="text-light opacity-25 mx-3">

                <ul class="nav flex-column sidebar-nav">
                    <li class="nav-item">
                        <a href="#settings" class="nav-link" title="Settings" data-page="settings-page">
                            <i class="bi bi-gear"></i>
                            <span class="menu-text">Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logoutRestaurant') }}" class="nav-link" title="Logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="menu-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Backdrop for mobile -->
        <div class="backdrop" id="backdrop"></div>

        <!-- Main Content -->
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="btn d-md-none" id="show-sidebar">
                    <i class="bi bi-list"></i>
                </button>
                {{-- <div class="container-fluid ">
                    <button class="btn d-md-none" id="show-sidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <p class="navbar-brand ms-2" href="#">KulinerIN</p>
                </div> --}}
            </nav>

            <!-- Home Page Content -->
            <div id="home-page" class="container-fluid p-4 content-page active">
                <h2>Home</h2>
                <p>Welcome to your dashboard. This sidebar template shows active state when clicking menu items.</p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Quick Stats</h5>
                                <div class="d-flex justify-content-between mt-3">
                                    <div class="text-center">
                                        <h3>3,540</h3>
                                        <p>Users</p>
                                    </div>
                                    <div class="text-center">
                                        <h3>8,294</h3>
                                        <p>Orders</p>
                                    </div>
                                    <div class="text-center">
                                        <h3>$12.4k</h3>
                                        <p>Revenue</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Recent Activity</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-0 ps-0">New user registered</li>
                                    <li class="list-group-item border-0 ps-0">Product update deployed</li>
                                    <li class="list-group-item border-0 ps-0">Server maintenance completed</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Page Content -->
            <div id="dashboard-page" class="container-fluid p-4 content-page">
                <h2>Manage Menu</h2>
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">Menu List</h5>
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-plus"></i> Add Menu
                            </button>
                        </div>
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
                                    <tr>
                                        <td>John Doe</td>
                                        <td>john@example.com</td>
                                        <td>Admin</td>
                                        <td>Admin</td>
                                        <td><span class="badge bg-success">Yes</span></td>
                                        {{-- <td>
                                            <span class="badge {{ $value === 'Yes' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $value }}
                                            </span>
                                        </td> --}}

                                        <td>DESC</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Page Content -->
            <div id="users-page" class="container-fluid p-4 content-page">
                <h2>User Management</h2>
                <p>View and manage user accounts.</p>
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">User List</h5>
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-plus"></i> Add User
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>john@example.com</td>
                                        <td>Admin</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jane Smith</td>
                                        <td>jane@example.com</td>
                                        <td>User</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Robert Johnson</td>
                                        <td>robert@example.com</td>
                                        <td>User</td>
                                        <td><span class="badge bg-secondary">Inactive</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Page Content -->
            <div id="events-page" class="container-fluid p-4 content-page">
                <h2>Event Calendar</h2>
                <p>View and manage upcoming events.</p>
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Events</h5>
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Product Launch</h6>
                                    <small class="text-muted">February 28, 2025</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">3 days left</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Team Meeting</h6>
                                    <small class="text-muted">February 22, 2025</small>
                                </div>
                                <span class="badge bg-success rounded-pill">Today</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Client Presentation</h6>
                                    <small class="text-muted">March 5, 2025</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">12 days left</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Reports Page Content -->
            <div id="reports-page" class="container-fluid p-4 content-page">
                <h2>Reports</h2>
                <p>Access and generate reports.</p>
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">Sales Reports</h5>
                                <p>View and download sales performance reports.</p>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary me-2">Generate Report</button>
                                    <button class="btn btn-outline-secondary">View Archive</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">User Activity</h5>
                                <p>Monitor user engagement and activity.</p>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary me-2">Generate Report</button>
                                    <button class="btn btn-outline-secondary">View Archive</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Page Content -->
            <div id="messages-page" class="container-fluid p-4 content-page">
                <h2>Messages</h2>
                <p>Check your inbox and send messages.</p>
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Inbox</h5>
                        <div class="list-group mt-3">
                            <a href="#" class="list-group-item list-group-item-action border-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3"
                                        alt="User">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">John Doe</h6>
                                            <small class="text-muted">3m ago</small>
                                        </div>
                                        <p class="mb-0 text-truncate">Hi there! I wanted to discuss the project
                                            timeline...</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3"
                                        alt="User">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Sarah Williams</h6>
                                            <small class="text-muted">2h ago</small>
                                        </div>
                                        <p class="mb-0 text-truncate">The latest designs have been uploaded for
                                            review...</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action border-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3"
                                        alt="User">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Mike Johnson</h6>
                                            <small class="text-muted">Yesterday</small>
                                        </div>
                                        <p class="mb-0 text-truncate">Can we schedule a meeting to discuss the new
                                            feature?</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Page Content -->
            <div id="settings-page" class="container-fluid p-4 content-page">
                <h2>Settings</h2>
                <p>Manage your account and application settings.</p>
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Account Settings</h5>
                                <form class="mt-3">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" value="username">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            value="user@example.com">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Notification Settings</h5>
                                <div class="mt-3">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="emailNotification"
                                            checked>
                                        <label class="form-check-label" for="emailNotification">Email
                                            Notifications</label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="smsNotification">
                                        <label class="form-check-label" for="smsNotification">SMS
                                            Notifications</label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="pushNotification"
                                            checked>
                                        <label class="form-check-label" for="pushNotification">Push
                                            Notifications</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Preferences</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize tooltips for icon-only navigation
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Set up nav link click handlers
            var navLinks = document.querySelectorAll('.sidebar-nav .nav-link');
            navLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') === '#logout') {
                        // Handle logout specially
                        return;
                    }

                    e.preventDefault();

                    // Remove active class from all nav links
                    navLinks.forEach(function(navLink) {
                        navLink.classList.remove('active');
                    });

                    // Add active class to clicked link
                    this.classList.add('active');

                    // Hide all content pages
                    var contentPages = document.querySelectorAll('.content-page');
                    contentPages.forEach(function(page) {
                        page.classList.remove('active');
                    });

                    // Show the corresponding content page
                    var pageId = this.getAttribute('data-page');
                    if (pageId) {
                        document.getElementById(pageId).classList.add('active');
                    }

                    // On mobile, close the sidebar after navigation
                    if (window.innerWidth <= 768) {
                        document.getElementById('sidebar').classList.remove('show');
                        document.getElementById('backdrop').classList.remove('show');
                    }
                });
            });
        });

        // Toggle sidebar on desktop
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggle-icon');

            sidebar.classList.toggle('sidebar-collapsed');

            if (sidebar.classList.contains('sidebar-collapsed')) {
                toggleIcon.classList.remove('bi-chevron-left');
                toggleIcon.classList.add('bi-chevron-right');
            } else {
                toggleIcon.classList.remove('bi-chevron-right');
                toggleIcon.classList.add('bi-chevron-left');
            }
        });

        // Show sidebar on mobile
        document.getElementById('show-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('show');
            document.getElementById('backdrop').classList.add('show');
        });

        // Hide sidebar on mobile when clicking the backdrop or close button
        document.getElementById('backdrop').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('backdrop').classList.remove('show');
        });

        document.getElementById('close-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('backdrop').classList.remove('show');
        });
    </script>
</body>

</html>
