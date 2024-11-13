<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background and Card Styling */
        body {
            background-color: #f3f6fa;
        }

        .container {
            max-width: 1000px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #343a40;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 1rem 2rem;
        }

        .table-responsive {
            padding: 1rem;
        }

        /* Table Styling */
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table th,
        .table td {
            padding: 1rem;
            vertical-align: middle;
            text-align: center;
        }

        .table td {
            color: #343a40;
        }

        .table tbody tr:hover {
            background-color: #f1f5ff;
        }

        /* Pagination Styling */
        .pagination .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            font-size: 1rem;
            color: #007bff;
            border: 1px solid #dee2e6;
            margin: 0 5px;
            border-radius: 50%;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination .page-item .page-link:hover {
            background-color: #f1f1f1;
        }

        /* Select Dropdown Styling */
        .form-select {
            border-radius: 20px;
            padding: 0.6rem 1.5rem;
            color: #007bff;
            font-weight: bold;
            border: 1px solid #007bff;
        }

        .form-select:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        /* Filter Section Styling */
        .card-header .row {
            gap: 0.5rem;
        }

        /* Additional padding and centering for the content */
        .content-centered {
            padding: 1rem 2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table th, .table td {
                padding: 0.5rem;
            }

            .card-header {
                padding: 1rem;
            }

            .form-select {
                padding: 0.4rem 1rem;
                font-size: 0.9rem;
            }

            .pagination .page-item .page-link {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                max-width: 100%;
                padding: 0 15px;
            }

            .table-responsive {
                padding: 0.5rem;
            }

            .card-header .row {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="mb-4 text-center">
            <h1 class="h3">Customer Database</h1>
            <p class="text-muted small">Manage and view all user information in one place</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <form method="GET" action="{{ route('index') }}" class="row g-3 align-items-center">
                    <!-- Gender Filter -->
                    <div class="col-md-4">
                        <select name="gender" class="form-select" onchange="this.form.submit()">
                            <option value="">Filter by Gender</option>
                            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Birthday Filter -->
                    <div class="col-md-4">
                        <select name="birthday" class="form-select" onchange="this.form.submit()">
                            <option value="">Filter by Birthday</option>
                            <option value="after2000" {{ request('birthday') == 'after2000' ? 'selected' : '' }}>Born After 2000</option>
                        </select>
                    </div>

                    <!-- Rows Per Page -->
                    <div class="col-md-4">
                        <select name="rowsPerPage" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ request('rowsPerPage') == 10 ? 'selected' : '' }}>10 per page</option>
                            <option value="20" {{ request('rowsPerPage') == 20 ? 'selected' : '' }}>20 per page</option>
                            <option value="50" {{ request('rowsPerPage') == 50 ? 'selected' : '' }}>50 per page</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0 mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $index => $customer)
                        <tr>
                            <!-- Display sequential numbering, adjusted for pagination -->
                            <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->phoneNumber }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td>{{ \Carbon\Carbon::parse($customer->birthday)->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No Data Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{ $customers->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
