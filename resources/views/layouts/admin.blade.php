<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Admin CSS -->
    <style>
        /* body {
            background-color: #f8f9fa;
        } */

        .sidebar {
            min-height: 100vh;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white !important;
        }
    </style>
</head>

<body class="bg-dark">

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar py-4">
                <div class="text-center mb-4">
                    <h4 class="fw-bold">Admin</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/tvshows*') ? 'active' : '' }}"
                            href="{{ route('admin.tvshows.index') }}">
                            TV Shows & Episodes

                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/episodes*') ? 'active' : '' }}"
                            href="{{ route('admin.episodes.index') }}">
                            Episodes
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                            href="{{ route('admin.users.index') }}">
                            Users
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <h2 class="mb-4">@yield('title')</h2>

                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showsTable').DataTable();
        });
    </script>
</body>

</html>
