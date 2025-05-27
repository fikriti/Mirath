<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معهد ميراث النبوة</title>
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
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
    <!-- section two -->
    <section id="hero" class="hero section dark-background">
        <div class="main-img">
            <img src="{{ asset('images/islamic-pattern-white-background_691635-5.avif') }}" alt="" />
        </div>
        <div class="container fade-in">
            <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-xl-8 col-lg-6">
                    <div class="image-home fade-in">
                        <img src="{{ asset('/images/01000.png') }}" alt="">
                    </div>
                    <h2 class="fade-in"> مرحباً بكِ فى منصة معهد ميراث النبوة</h2>
                    <p class="fade-in">
                        نحن منصة رقمية للمعهد تسّهل على الطالبات عملية التعلم وتتيح للإدارة التنظيم الذكي
                    </p>
                    <p class="fade-in">
                        <button class="click mt-5">إنضمي إلينا الآن</button>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- section two -->

    <!-- scroll Up -->
    <div class="up">
        <img src="{{ asset('/images/arrow.png') }}" alt="">
    </div>
    <!-- scroll Up -->

    <!-- section three -->
    <div class="container py-5" id="About">
        <div class="values">
            <div class="text-center mb-4">
                <h2 class="section-title fade-in-left">ما تقدمه المنصة</h2>
                <p class="fade-in">
                    تقدّم المنصة برامج دراسية متدرجة في العلوم الشرعية، تشمل الفقه، التفسير، والحديث، عبر دورات متنوعة
                    تغطي مستويات متعددة تناسب المبتدئات والمتقدمات. تشرف على هذه البرامج نخبة من الشيخات والمعلمات
                    المؤهلات، بهدف ترسيخ الفهم الشرعي الصحيح وربط الطالبات بالمنهج العلمي المنضبط. وتسعى المنصة من خلال
                    ذلك إلى تمكين طالبات العلم من الجمع بين التأصيل العلمي والتأهيل العملي، بما يتيح لهن خدمة مجتمعاتهن
                    ونشر القيم الإسلامية السمحة
            </div>

            <div class="values-container fade-in">
                <div class="value-card">
                    <!-- <div class="value-icon"></div> -->
                    <h5 class="fw-bold mt-2 fade-in-left "> أحكام التجويد</h5>
                </div>
                <div class="value-card">
                    <!-- <div class="value-icon"></div> -->
                    <h5 class="fw-bold mt-2 fade-in-left">جميع القراءات</h5>
                </div>
                <div class="value-card">
                    <!-- <div class="value-icon"></div> -->
                    <h5 class="fw-bold mt-2 fade-in-left">الفقه وأصوله</h5>
                </div>
                <div class="value-card">
                    <!-- <div class="value-icon"></div> -->
                    <h5 class="fw-bold mt-2 fade-in-left">المذاهب الفقهية</h5>
                </div>
                <div class="value-card">
                    <!-- <div class="value-icon"></div> -->
                    <h5 class="fw-bold mt-2 fade-in-left">التفسير وأصوله</h5>
                </div>
                <div class="value-card">
                    <!-- <div class="value-icon"></div> -->
                    <h5 class="fw-bold mt-2 fade-in-left">السيرة النبوية</h5>
                </div>
                <div class="value-card">
                    <!-- <div class="value-icon"></div> -->
                    <h5 class="fw-bold mt-2 fade-in-left">الأدب الأسلامي</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- section three -->

    <!-- section: main sections and their children -->
    <section class="services text-center py-5" style="direction: rtl;">
        <div class="container">
            <h1 class="text-end fw-bold fade-in-left">الأقسام</h1>

            @foreach ($mainSections->take(2) as $mainSection)
            @if ($mainSection->children->isNotEmpty())
            <div class="main-section my-5 fade-in">
                <h2 class="text-center fw-semibold fade-in-left">{{ $mainSection->name }}</h2>
                <div class="row mt-4">
                    @foreach ($mainSection->children as $child)
                    <div class="col-lg-4 col-md-6 col-12 all-cards mb-4 fade-in">
                        <div class="service-card p-4 mb-4 text-center">
                            @if($child->image)
                            <img src="{{ asset( $child->image) }}" alt="{{ $child->image }}" class="service-img mb-3">
                            @else
                            <img src="{{ asset('/images/default.png') }}" alt="default image" class="service-img mb-3">
                            @endif

                            <h5 class="fw-bold">{{ $child->name }}</h5>

                            @if($child->description)
                            <p>{{ Str::limit($child->description, 100) }}</p>
                            @endif

                            <p class="fade-in-left">
                                <a href="{{ route('show', $child->id) }}" class="click btn btn-primary">
                                    <i class="fas fa-info-circle ms-2"></i> إنضم الآن
                                </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </section>


    <!-- section five -->
    <div class="container py- Our fade-in" style="direction: rtl;">
        <div class="row mb-5 align-items-center">
            <div class="col-12 d-flex">
                <div class="icon-title me-4 text-center">
                    <img src="{{ asset('/images/vision.png') }}" alt="Vision Icon" class="icon-img">
                    <h2 class="fw-bold fade-in-left ms-2" data-i18n="ourVision">رؤيتنا</h2>
                </div>
                <div class="vision-message w-100">
                    <p class="fade-in">
                        "إعداد معلمات متقنات وذوات كفاءة عالية في تدريس القرآن الكريم، وداعيات متخصصات في العلوم
                        الشرعية، يجمعن بين الفهم العميق والواسع لأصول الشريعة الإسلامية وفق منهج سلف الأمة الصالح، بحيث
                        يتمكنّ من أداء رسالتهن التربوية والدعوية بأعلى درجات الإتقان والقدرة على التأثير الإيجابي." </p>
                </div>
            </div>
        </div>
        <div class="row mb-5 align-items-center">
            <div class="col-12 d-flex flex-row-reverse">
                <div class="icon-title ms-4 text-center">
                    <img src="{{ asset('/images/target.png') }}" alt="Message Icon" class="icon-img">
                    <h2 class="fw-bold fade-in-left me-2" data-i18n="ourMessage">أهدافنا</h2>
                </div>
                <div class="vision-message w-100">
                    <p class="fade-in">
                        ١. الوصول إلى أكبر عدد من الأفراد على مستوى العالم لتعلم القرآن الكريم وما لايسع المسلمة جهله من
                        العلوم الشرعية بفهم سلف الأمة
                        <br>
                        ٢. تعزيز دور القرآن والعلوم الشرعية في بناء شخصية المسلمة وتنمية القيم الإيجابية وحماية المعتقد
                        من الأفكار الضالة
                        <br>
                        ٣. تفعيل دور المشاركة من كل من تستطيع النهوض بالعملية التعليمية للقرآن والعلوم الشرعية بمنهج
                        السلف
                        <br>
                        ٤. تخريج دارسات مؤهلات للإجازة و معلمات متقنات لتلاوة القرآن لديهن القدرة على تصحيح أخطاء
                        التلاوة
                        <br>
                        ٥. توفير بيئة علمية متكاملة للتأهيل للتخصص في فروع علوم الشريعة وفق منهج السلف التأصيلي والطرق
                        العصرية وتشجيع البحث العلمي
                        <br>
                        ٦. مد المجتمع العالمي بداعيات متخصصات مؤهلات بدرجة عالية لنشر العلم الشرعي ومواجهة قضايا العصر
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- section five -->

    <!-- Opinions -->
    <section class="testimonials-section container mb-4" id="">
        <h1 class="text-center fw-bold fade-in-left py-4" data-i18n="ourProducts">شهادات الطالبات</h1>
        <div class="section-content fade-in">
            <div class="slider-container swiper">
                <div class="slider-wrapper2 fade-in">
                    <ul class="testimonials-list swiper-wrapper">




                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_1.jpg') }}" alt="User"
                                class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_3.jpg') }}" alt="User" class="user-image2" />

                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_001.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_002.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_2.jpg') }}" alt="User"
                                class="user-image2" />
                        </li>

                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_4.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_5.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_6.jpg') }}" alt="User" class="user-image2" />
                        </li>

                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_8.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_9.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_01.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_02.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_09.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_03.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_04.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_05.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_06.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_0.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_07.jpg') }}" alt="User" class="user-image2" />
                        </li>
                        <li class="testimonial2 swiper-slide fade-in-left">
                            <img src="{{ asset('assets/sh/photo_08.jpg') }}" alt="User" class="user-image2" />
                        </li>


                    </ul>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-slide-button swiper-button-prev"></div>
                    <div class="swiper-slide-button swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Opinions -->

    <!-- team -->
    <section class="testimonials-section container mb-4" id="">
        <h1 class="text-center fw-bold fade-in-left py-4" data-i18n="ourProducts">فريق العمل </h1>
        <div class="section-content fade-in">
            <div class="slider-container swiper">
                <div class="slider-wrapper fade-in">
                    <ul class="testimonials-list swiper-wrapper">
                        <li class="testimonial swiper-slide fade-in-left">
                            <img src="{{ asset('/images/muslim woman.avif') }}" alt="User" class="user-image" />
                            <h3 class="name text-uppercase" data-i18n="product1Title">الشيخة أم حفص الدمياطية ، عبير بنت الشويحي</h3>
                            <i class="feedback" data-i18n="product1Desc">مديرة معهد ميراث النبوة للنساء
                                والقائمة على المركز الرئيسي لأنصار السنة قسم النساء في دمياط القديمة</i>
                        </li>
                        <li class="testimonial swiper-slide fade-in-left">
                            <img src="{{ asset('/images/muslim woman.avif') }}" alt="User" class="user-image" />
                            <h3 class="name text-uppercase" data-i18n="product2Title">الشيخة صفا بنت درويش</h3>
                            <i class="feedback" data-i18n="product2Desc">المجازة المقرئة بالقراءات العشر</i>
                        </li>
                        <li class="testimonial swiper-slide fade-in-left">
                            <img src="{{ asset('/images/muslim woman.avif') }}" alt="User" class="user-image" />
                            <h3 class="name text-uppercase" data-i18n="product3Title">د. أميرة بنت محمد</h3>
                            <i class="feedback" data-i18n="product3Desc"> المجازة بالعشر الصغرى والكبرى والشواذ</i>
                        </li>
                        <li class="testimonial swiper-slide fade-in-left">
                            <img src="{{ asset('/images/muslim woman.avif') }}" alt="User" class="user-image" />
                            <h3 class="name text-uppercase" data-i18n="product3Title">الشيخة نادية بنت بركات</h3>
                            <i class="feedback" data-i18n="product3Desc">المجازة المقرئة ، مديرة دور تحفيظ الخلفاء الراشدين بجميع فروعها</i>
                        </li>
                        <li class="testimonial swiper-slide fade-in-left">
                            <img src="{{ asset('/images/muslim woman.avif') }}" alt="User" class="user-image" />
                            <h3 class="name text-uppercase" data-i18n="product3Title">الشيخة نوال بنت أنور</h3>
                            <i class="feedback" data-i18n="product3Desc">الشيخة المجازة المتخصصة في النحو البلاغة واللغة العربية بفروعها</i>
                        </li>

                        <!-- <li class="testimonial swiper-slide fade-in-left">
                            <img src="{{ asset('/images/muslim woman.avif') }}" alt="User" class="user-image" />
                            <h3 class="name text-uppercase" data-i18n="product3Title">الاسم</h3>
                            <i class="feedback" data-i18n="product3Desc">وصف الوظيفة</i>
                        </li> -->
                    </ul>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- team -->

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
                    <a href="https://x.com/merathalnobowa?s=09"><i class="fab fa-twitter fa-bounce"></i></a>
                    <a href="#"><i class="fab fa-youtube fa-bounce"></i></a>
                    <a href="https://t.me/meyratalnoboah"><i class="fab fa-telegram fa-bounce"></i></a>
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
                        <li><a href="https://t.me/+KY0gv4VJWUk3NWM0">-تفاعلية معهد ميراث النبوي</a></li>
                        <li><a href="#">-الدورات التعليمية</a></li>
                        <li><a href="https://t.me/meyratalnoboah">-تواصل معنا</a></li>
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
                        <a href="https://x.com/merathalnobowa?s=09"><i class="fab fa-twitter fa-bounce"></i></a>
                        <a href="#"><i class="fab fa-youtube fa-bounce"></i></a>
                        <a href="https://t.me/meyratalnoboah"><i class="fab fa-telegram fa-bounce"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom  fade-in ">
                © 2025 <a href="http://fikriti.com/" target="_blank">Fikriti Software Development</a> جميع
                الحقوق محفوظة.
            </div>
        </div>
    </footer>
    <!-- footer -->


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