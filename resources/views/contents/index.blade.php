<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mt-4" dir="rtl">
                    <div class="row justify-content-center">
                        <h1 class="text-center mb-4" style="font-size: 2rem; font-weight: bold; color: #2c3e50;">مرحبًا بكم في إدارة المحتويات</h1>
                        <div class="col-md-12">
                            @if (Session::has('Done'))
                                <div class="alert alert-success alert-dismissible fade index" role="alert">
                                    {{ Session::get('Done') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="card shadow-lg border-0">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="d-flex justify-content-between align-items-center mb-0">
                                        قائمة المحتويات
                                        <a href="{{ route('contents.create') }}" class="btn btn-light btn-sm text-dark bg-light">إضافة محتوى</a>
                                    </h4>
                                </div>

                                <div class="card-body bg-light">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <button onclick="printTable()" class="btn btn-outline-dark btn-sm shadow-sm">
                                            <i class="bi bi-printer"></i> طباعة
                                        </button>
                                        <form action="{{ route('contents.index') }}" method="GET" class="d-flex w-100">
                                            <input type="text" name="search" class="form-control me-2" placeholder="ابحث عن محتوى..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-primary">بحث</button>
                                        </form>
                                    </div>

                                    <div id="printArea">
                                        <div class="table-responsive">
                                            <table class="table table-hover text-center align-middle mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>عنوان المحتوى</th>
                                                        <th>القسم</th>
                                                        <th>النوع</th>
                                                        <th>القيمة</th>
                                                        <th>ملاحظة</th>
                                                        <th>أُضيف بواسطة</th>
                                                        <th colspan="2">الإجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($contents as $content)
                                                        <tr class="hover-shadow">
                                                            <td class="fw-bold">{{ $loop->iteration }}</td>
                                                            <td>{{ $content->title }}</td>
                                                            <td>{{ $content->section ? $content->section->name : 'لا يوجد' }}</td>
                                                            <td>{{ $content->type }}</td>
                                                            <td>{{ $content->value }}</td>
                                                            <td>{{ $content->note }}</td>
                                                            <td>{{ $content->addedBy->name ?? 'لايوجد' }}</td>
                                                            <td>
                                                                <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-warning btn-sm">
                                                                    <i class="bi bi-pencil"></i> تعديل
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا المحتوى؟')">
                                                                        <i class="bi bi-trash"></i> حذف
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center text-muted py-4">
                                                                <i class="bi bi-info-circle"></i> لا يوجد محتويات متاحة.
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $contents->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .hover-shadow:hover {
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        transition: box-shadow 0.3s ease;
                    }
                    .card {
                        border-radius: 15px;
                    }
                    .card-header {
                        border-radius: 15px 15px 0 0;
                    }
                    .table th, .table td {
                        vertical-align: middle;
                    }
                </style>

                <script>
                    function printTable() {
                        var printContents = document.getElementById('printArea').innerHTML;
                        var originalContents = document.body.innerHTML;

                        document.body.innerHTML = `
                            <html>
                            <head>
                                <title>طباعة قائمة المحتويات</title>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                                <style>
                                    @media print {
                                        .no-print { display: none !important; }
                                        body {
                                            font-family: Arial, sans-serif;
                                            direction: rtl;
                                            text-align: center;
                                        }
                                        h3 {
                                            font-weight: bold;
                                            color: black;
                                            margin-bottom: 20px;
                                        }
                                        table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin-top: 10px;
                                        }
                                        th, td {
                                            border: 1px solid #000;
                                            padding: 10px;
                                            text-align: center;
                                        }
                                        th {
                                            background-color: #343a40;
                                            color: white;
                                            font-size: 1.1rem;
                                            font-weight: bold;
                                        }
                                        td {
                                            font-size: 1rem;
                                            color: #333;
                                        }
                                        tr:nth-child(even) { background-color: #f8f9fa; }
                                    }
                                </style>
                            </head>
                            <body>
                                <h3>قائمة المحتويات</h3>
                                ${printContents}
                            </body>
                            </html>
                        `;

                        window.print();
                        location.reload();
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>