<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">

        <!-- Left side -->
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="navbar-brand fw-bold fs-3 me-4">TV.Show</a>

            <ul class="navbar-nav me-3">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link px-3">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" role="button" id="mostWatchedDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Most Watched
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="mostWatchedDropdown">
                        @foreach ($randomShows as $show)
                            <li><a class="dropdown-item"
                                    href="{{ route('tvshows.show', $show->id) }}">{{ $show->title }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tvshows.index') }}" class="nav-link px-3">Browse</a>
                </li>
            </ul>
        </div>

        <!-- Middle: search -->
        <form id="search-form" method="GET" action="{{ route('search.results') }}"
            class="d-flex flex-grow-1 mx-3 position-relative" style="max-width: 400px;">
            <input id="search-input" type="search" name="q" class="form-control rounded-pill me-2"
                placeholder="Search episodes & shows" autocomplete="off" />
            <button type="submit" class="btn btn-primary rounded-pill px-4">Go</button>

            <ul id="search-results" class="list-group position-absolute w-100"
                style="top: 100%; left: 0; z-index: 1050; display:none; max-height: 300px; overflow-y: auto;"></ul>
        </form>

        <!-- Right side -->
        <div class="d-flex align-items-center">
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-light me-2 d-flex align-items-center">
                    <i class="bi bi-person-plus me-1"></i> Sign Up
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            @endguest
        </div>

    </div>
</nav>
