<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #5a67d8;
            /* Indigo */
            --accent-color: #f59e0b;
            /* Amber */
            --bg-light: #fdfdfd;
            --text-dark: #2d3748;
            --hover-bg: rgba(90, 103, 216, 0.1);
            --active-bg: rgba(90, 103, 216, 0.2);
        }

        body {
            font-family: 'Figtree', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--text-dark);
        }

        .navbar-modern {
            background-color: var(--bg-light);
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease-in-out;
        }

        .navbar-modern .navbar-brand {
            color: var(--text-dark);
            font-size: 1.2rem;
        }

        .navbar-modern .navbar-brand i {
            color: var(--accent-color);
        }

        .navbar-modern .nav-link {
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s, color 0.3s;
            font-weight: 500;
        }

        .navbar-modern .nav-link:hover {
            background-color: var(--hover-bg);
            color: var(--primary-color);
        }

        .navbar-modern .nav-link.active {
            background-color: var(--active-bg);
            color: var(--primary-color);
            font-weight: 600;
        }

        .navbar-modern .dropdown-menu {
            border: none;
            border-radius: 0.5rem;
        }

        .navbar-modern .dropdown-item {
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
        }

        .navbar-modern .dropdown-item:hover {
            background-color: var(--hover-bg);
            color: var(--primary-color);
        }

        .rounded-circle.shadow-sm {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .text-accent {
            color: var(--accent-color);
        }
    </style>
</head>

<body class="antialiased">

    <nav class="navbar navbar-expand-lg navbar-modern sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-semibold" href="/">
                <i class="fas fa-rocket me-2 text-accent"></i> MyApp
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">المستخدمين</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('sections*') ? 'active' : '' }}"
                            href="{{ route('sections.index') }}">الاقسام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contents*') ? 'active' : '' }}"
                            href="{{ route('contents.index') }}">المحتوي</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2">{{ Auth::user()->name }}</span>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                    class="rounded-circle shadow-sm" width="36" height="36" alt="Avatar">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                            class="fas fa-user me-2 text-muted"></i> الملف الشخصي</a></li>
                                {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2 text-muted"></i>
                                        الإعدادات</a></li>
                                <li> --}}
                                <hr class="dropdown-divider">
                        </li>
                        <li>
                            <!-- زر تسجيل الخروج باستخدام SweetAlert -->
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                @csrf
                            </form>

                            <button type="button" class="dropdown-item text-danger" onclick="confirmLogout()">
                                <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                            </button>
                        </li>
                    </ul>
                    </li>
                @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        {{-- @isset($header)
            <header class="mb-4">
                <div class="bg-white shadow-sm rounded p-3">
                    {{ $header }}
                </div>
            </header>
        @endisset --}}

        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "ستقوم بتسجيل الخروج من الحساب.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، سجل الخروج',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
