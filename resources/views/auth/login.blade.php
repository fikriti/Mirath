<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>
    <div class="container mt-5 fade-in">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4 class="mb-0">تسجيل الدخول</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="close-btn"
                            onclick="window.location.href='{{ url('/') }}'">×</button>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email or Username -->
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">البريد الإلكتروني أو اسم المستخدم</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="loginEmail" name="email" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">تـسـجـيـل الـدخـول</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <p>ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => { // fade in , fade in left
            const fadeInElements = document.querySelectorAll(".fade-in, .fade-in-left");

            const observer = new IntersectionObserver(
                (entries, observer) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("visible");
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                }
            );
            fadeInElements.forEach((el) => {
                observer.observe(el);
            });
        });
    </script>

</body>

</html>
