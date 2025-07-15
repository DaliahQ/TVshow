<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Show.TV') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- @include('layouts.navigation') --}}
        @include('layouts.newNavigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        {{-- <main>
                {{ $slot }}
            </main> --}}
        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>


    <!-- Auth Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Please Login or Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-3" id="authTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                                type="button" role="tab">Login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                                type="button" role="tab">Sign Up</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            @include('auth.partials.login-form')

                        </div>
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            @include('auth.partials.register-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @stack('scripts')


    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: '{{ route('search.suggestions') }}',
                        type: 'GET',
                        data: {
                            q: query
                        },
                        success: function(data) {
                            $('#search-results').html(data).show();
                        }
                    });
                } else {
                    $('#search-results').hide();
                }
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search-form').length) {
                    $('#search-results').hide();
                }
            });
        });

        $(document).ready(function() {

            // LOGIN FORM
            $('#login-form').submit(function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('login') }}',
                    data: {
                        email: $('#login-email').val(),
                        password: $('#login-password').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        //  Success: reload to reflect auth status
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.email) {
                                $('#login-email-error').text(errors.email[0]);
                                $('#login-email').addClass('is-invalid');
                            }
                            if (errors.password) {
                                $('#login-password-error').text(errors.password[0]);
                                $('#login-password').addClass('is-invalid');
                            }
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            // REGISTER FORM
            $('#register-form').submit(function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                let formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('register') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // ✅ Success: reload to reflect auth status
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#register-name-error').text(errors.name[0]);
                                $('#register-name').addClass('is-invalid');
                            }
                            if (errors.email) {
                                $('#register-email-error').text(errors.email[0]);
                                $('#register-email').addClass('is-invalid');
                            }
                            if (errors.password) {
                                $('#register-password-error').text(errors.password[0]);
                                $('#register-password').addClass('is-invalid');
                            }
                            if (errors.profile_image) {
                                $('#register-profile_image-error').text(errors.profile_image[
                                    0]);
                                $('#register-profile_image').addClass('is-invalid');
                            }
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });

        });
    </script>

</body>

</html>
