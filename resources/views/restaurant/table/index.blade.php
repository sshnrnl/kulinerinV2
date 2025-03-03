<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Table</title>
</head>

<body>
    <div id="dashboard-page" class="container-fluid p-4 content-page">
        <h2>Manage Table</h2>
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">Table List</h5>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-plus"></i> Add Table
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
</body>

</html>
