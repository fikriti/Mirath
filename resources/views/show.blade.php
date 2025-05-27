<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معهد ميراث النبوة</title>
    <link rel="stylesheet" href="{{ asset('/css/section.css') }}">
    <link rel="icon" href="{{ asset('/images/font.png') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg sticky-top fade-in">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main"
                aria-controls="main" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars "></i>
            </button>
            <div class="logo1">
                <a class="navbar-brand d-block d-lg-none me-4" href="#"><img src="{{ asset('/images/font.png') }}"
                        alt=""></a>
            </div>

            <div class="left-nav d-flex align-items-center me-auto">
                @auth
                <!-- زر تسجيل الخروج باستخدام SweetAlert -->
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>

                <button type="button" class="nav-link btn btn-link text-decoration-none logout-btn"
                    style="padding: 0; border: none;" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </button>
                @else
                <a href="{{ route('login') }}" class="nav-link login">
                    <i class="fas fa-user"></i> إنشاء حساب / تسجيل الدخول
                </a>
                @endauth
            </div>
            <div class="collapse navbar-collapse" id="main">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="direction: rtl;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">الصفحة الرئيسية</a>
                    </li>
                    @foreach ($mainSections as $section)
                    @if ($section->children->isNotEmpty())
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center gap-1" href="{{ route('show', $section->id) }}" role="button">
                            {{ $section->name }} <i class="fas fa-chevron-down small"></i>
                        </a>
                        <ul class="menu dropdown-menu text-start">
                            @foreach ($section->children as $child)
                            <li><a class="dropdown-item" href="{{ route('show', $child->id) }}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ $section->name }}</a>
                    </li>
                    @endif
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="#Contact">تواصل معنا</a>
                    </li>
                </ul>


                <div class="logo">
                    <a class="navbar-brand ms-auto fw-bold d-none d-lg-block pt-3" href="#"><img
                            src="{{ asset('/images/font.png') }}" alt=""></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar -->

    <!-- libirary-title -->
    <div class="libirary-title" dir="rtl">
        <div class="container mb-5 ">
            <h1 class="fade-in">{{ $sec->name }}</h1>
            <!-- يعرض الأقسام الفرعية فقط لو موجودة -->
            @if ($children->isNotEmpty())
            <div class="items fade-in-left">
                @foreach ($children as $child)
                <a class="item {{ $loop->first ? 'active' : '' }}" style="text-decoration: none;" href="{{ route('show',  $child->id) }}">
                    {{ $child->name }} </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <!-- libirary-title -->
    <!-- section content -->
    @if($children->isEmpty())
    <section class="services text-center mt-4 mb-5" style="direction: rtl;">
        <div class="container">
            @if($contents->isNotEmpty())
            <div class="row mt-4 fade-in">
                @foreach($contents as $content)
                <div class="col-lg-4 col-md-6 col-12 all-cards mb-4 fade-in">
                    <div class="service-card p-4 mb-4 text-center ">
                        <p>{{ $content->title }}</p>

                        <div class="d-flex justify-content-evenly align-items-center mt-3 fade-in-left">
                            @if($content->value)
                            <button class="click" onclick="window.open('{{ $content->value }}', '_blank')">
                                <i class="fas fa-info-circle ms-2"></i>معرفة المزيد
                            </button>  
                            @else
                            <button class="click disabled" style="cursor: not-allowed;">
                                <i class="fas fa-info-circle ms-2"></i>لا توجد تفاصيل
                            </button>
                            @endif

                            <i class="arrowRight fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-warning mt-4">
                سيتم نزول المحتوى قريبًا إن شاء الله
            </div>
            @endif
        </div>
    </section>
    @endif



    <!-- scroll Up -->
    <div class="up">
        <img src="{{ asset('/images/arrow.png') }}" alt="">
    </div>
    <!-- scroll Up -->
    <!-- Contact  -->
    <div class="Contact pt-5 pt-5" id="Contact">
        <img src="{{ asset('/images/OIP.jpeg') }}" alt="" class="bg-img">
        <div class="container">
            <div class="main-title mb-5 mt-5 text-center">
                <h1 class=" fw-bold fa-3x mb-3 text-light fade-in-left ">تواصلي معنا</h1>
                <p class="text-white-50 fs-5 fst-italic fade-in ">بوابة التواصل مع إدارة المنصة</p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form class="Fform fs-5 fade-in ">
                        <input type="text" placeholder="الأسـم" required class="w-100 mb-4 fade-in"
                            style="height: 70px; border-radius: 5px;">
                        <input type="email" placeholder="الأيـمـيـل" required class="w-100 mb-4 fade-in"
                            style="height: 70px; border-radius: 5px;">
                        <input type="number" placeholder="رقـم الـهـاتـف" required class="w-100 mb-4 fade-in"
                            style="height: 70px; border-radius: 5px;">
                    </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <form class="fade-in">
                        <textarea placeholder="الـرسـالـة" required class="w-100 mb-3 pt-4 fade-in"
                            style="height: 260px; border-radius: 5px;"></textarea>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-around align-items-center fade-in">
                <p>
                    <button class="click">إرسال</button>
                </p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f fa-bounce"></i></a>
                    <a href="#"><i class="fab fa-twitter fa-bounce"></i></a>
                    <a href="#"><i class="fab fa-youtube fa-bounce"></i></a>
                    <a href="#"><i class="fab fa-telegram fa-bounce"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact  -->

    <!-- footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="footer-container">
                <div class="footer-about fade-in-left ">
                    <div class="footer-logo">
                        <img src="{{ asset('/images/font.png') }}" alt="شعار الأكاديمية">
                    </div>
                    <h4>عن المنصة :</h4>
                    <p>
                        منصة تعليمية شرعية تهدف لنشر العلم الشرعي الموثوق بأسلوب عصري وميسر.
                        نُقدّم برامج متكاملة لتأصيل طالبات العلم وربطهم بالكتاب والسنة بفهم السلف الصالح. </p>
                </div>

                <div class="footer-links  fade-in-left ">
                    <h4>روابط مهمة :</h4>
                    <ul>
                        <li><a href="/">-الصفحة الرئيسية</a></li>
                        <li><a href="#About">-ما تقدمه المنصة</a></li>
                        <li><a href="#shariea">-أقسام العلوم الشرعية</a></li>
                        <li><a href="#">-البرامج التعليمية</a></li>
                        <li><a href="#">-الدورات التعليمية</a></li>
                        <li><a href="#Contact">-تواصل معنا</a></li>
                        <li><a href="{{ route('register') }}">- إنشاء حساب جديد</a></li>
                        <li><a href="{{ route('login') }}">- تسجيل الدخول</a></li>
                    </ul>
                </div>

                <div class="footer-contact  fade-in-left ">
                    <h4>طرق التواصل معنا :</h4>
                    <p><i class="fas fa-envelope"></i> info@example.com</p>
                    <p><i class="fab fa-whatsapp"></i> 00000000000</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f fa-bounce"></i></a>
                        <a href="#"><i class="fab fa-twitter fa-bounce"></i></a>
                        <a href="#"><i class="fab fa-youtube fa-bounce"></i></a>
                        <a href="#"><i class="fab fa-telegram fa-bounce"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom  fade-in ">
                © 2025 <a href="https://fikrati-roan.vercel.app" target="_blank">Fikriti Software Development</a> جميع
                الحقوق محفوظة.
            </div>
        </div>
    </footer>
    <!-- footer -->
    <script>
        document.addEventListener("DOMContentLoaded", function() { // navbar
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    navLinks.forEach(function(navLink) {
                        navLink.classList.remove('active');
                    });
                    link.classList.add('active');
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function() { // libirary-title
            const items = document.querySelectorAll(".libirary-title .item");
            items.forEach(function(item) {
                item.addEventListener("click", function() {
                    items.forEach(function(el) {
                        el.classList.remove("active");
                    });
                    item.classList.add("active");
                });
            });
        });
    </script>

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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>