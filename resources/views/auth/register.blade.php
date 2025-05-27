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
    <div class="container mt-2 mb-2 fade-in">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4 class="mb-0">إنشاء حساب جديد</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <button type="button" class="close-btn"
                                onclick="window.location.href='{{ url('/') }}'">×</button>

                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required autocomplete="username">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control" id="password" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2 form-check">
                                <input type="checkbox" class="form-check-input" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">
                                    أوافق على
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">الشروط
                                        والأحكام</a>
                                </label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">إنـشـاء حـسـاب</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <p>لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- مودال الشروط والأحكام -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close text-start" data-bs-dismiss="modal"
                        aria-label="إغلاق"></button>
                    <h5 class="modal-title" id="termsModalLabel">الشروط والأحكام</h5>
                </div>
                <div class="modal-body">
                    <p>يرجى قراءة الشروط والأحكام التالية بعناية قبل إنشاء حساب على منصتنا:</p>
                    <ul>
                        <li><strong>1. الالتزام الشرعي:</strong> باستخدامك لهذا الموقع، فإنك توافق على استخدامه فيما يرضي الله، والامتناع عن أي محتوى أو تصرف يخالف الشريعة الإسلامية.</li>
                        <li><strong>2. صحة البيانات:</strong> يجب إدخال بيانات صحيحة عند التسجيل، وعدم استخدام معلومات مضللة أو منتحلة.</li>
                        <li><strong>3. خصوصية المستخدم:</strong> نلتزم بالحفاظ على بياناتك الشخصية، ولن يتم مشاركتها مع أي جهة دون إذن منك.</li>
                        <li><strong>4. حقوق المحتوى:</strong> كل ما يُنشر في الموقع هو للاستخدام الشخصي فقط، ولا يجوز نسخه أو نشره دون الإشارة إلى المصدر.</li>
                        <li><strong>5. التوجيه الشرعي:</strong> المحتوى يهدف للتثقيف الشرعي، ولا يغني عن الرجوع إلى العلماء في الفتاوى الخاصة أو القضايا الدقيقة.</li>
                    </ul>
                    <p class="mt-3">
                        إذا كان لديك أي استفسار حول هذه الشروط، يمكنك التواصل معنا من خلال صفحة
                        <a href="#">اتصل بنا</a>.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- سكربتات -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const fadeInElements = document.querySelectorAll(".fade-in, .fade-in-left");
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
            });
            fadeInElements.forEach((el) => observer.observe(el));
        });
    </script>
</body>

</html>
