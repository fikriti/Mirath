<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-12 mt-3" style="background-color: #f3f4f6;">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <!-- Card Component -->
                <div class="col-md-4">
                    <a href="{{ route('users.index') }}" class="card-link">
                        <div class="custom-card bg-white shadow rounded-4 p-4 text-center h-100">
                            <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                            <h4 class="fw-bold text-dark">المستخدمين</h4>
                            <p class="text-muted">إدارة المستخدمين والتحكم في صلاحياتهم.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('sections.index') }}" class="card-link">
                        <div class="custom-card bg-white shadow rounded-4 p-4 text-center h-100">
                            <i class="bi bi-diagram-3-fill display-4 text-success mb-3"></i>
                            <h4 class="fw-bold text-dark">الأقسام</h4>
                            <p class="text-muted">عرض وتنظيم الأقسام والمجموعات.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('contents.index') }}" class="card-link">
                        <div class="custom-card bg-white shadow rounded-4 p-4 text-center h-100">
                            <i class="bi bi-journal-text display-4 text-warning mb-3"></i>
                            <h4 class="fw-bold text-dark">المحتوى</h4>
                            <p class="text-muted">إدارة المحتوى الخاص بالأقسام والمستخدمين.</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        .card-link {
            text-decoration: none;
            transition: transform 0.3s ease-in-out;
        }

        .card-link:hover .custom-card {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .custom-card {
            transition: all 0.3s ease-in-out;
            background: linear-gradient(135deg, #ffffff, #f9fafb);
            border: none;
        }

        .custom-card:hover {
            background: linear-gradient(135deg, #eef2f7, #ffffff);
        }

        .custom-card h4 {
            font-size: 1.3rem;
        }

        .custom-card i {
            transition: color 0.3s ease;
        }

        .card-link:hover i {
            color: #0d6efd !important;
        }
    </style>
</x-app-layout>
