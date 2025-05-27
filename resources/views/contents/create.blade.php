<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 text-primary fw-bold">
                                إضافة محتوى جديد
                            </h3>
                            <a href="{{ route('contents.index') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                                <i class="fas fa-list me-2"></i> عرض المحتويات
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="contentForm" enctype="multipart/form-data" action="{{ route('contents.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf

                            <!-- عنوان المحتوى -->
                            <div class="mb-3">
                                <label for="title" class="form-label text-secondary">عنوان المحتوى</label>
                                <input type="text" class="form-control rounded-pill" id="title" name="title" placeholder="أدخل عنوان المحتوى" required>
                                <div class="invalid-feedback" id="titleError">حقل عنوان المحتوى مطلوب.</div>
                            </div>

                            <!-- ملاحظة -->
                            <div class="mb-3">
                                <label for="note" class="form-label text-secondary">ملاحظة</label>
                                <textarea class="form-control rounded-pill" id="note" name="note" rows="3" placeholder="أدخل ملاحظة عن المحتوى"></textarea>
                            </div>

                            <!-- القسم المرتبط -->
                            <div class="mb-3">
                                <label for="section_id" class="form-label text-secondary">القسم</label>
                                <select class="form-control rounded-pill" id="section_id" name="section_id" required>
                                    <option value="">اختر القسم</option>
                                    @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="sectionError">حقل القسم مطلوب.</div>
                            </div>

                            <!-- نوع المحتوى -->
                            <div class="mb-3">
                                <label for="type" class="form-label text-secondary">نوع المحتوى</label>
                                <select class="form-control rounded-pill" id="type" name="type" required>
                                    <option value="">اختر النوع</option>
                                    <option value="text">نص</option>
                                    <option value="link">رابط</option>
                                    <option value="pdf">pdf</option>
                                    <option value="video">فديوا</option>
                                    <option value="image">صوره</option>
                                    <!-- يمكنك إضافة المزيد من الأنواع حسب الحاجة -->
                                </select>
                                <div class="invalid-feedback" id="typeError">حقل نوع المحتوى مطلوب.</div>
                            </div>

                            <!-- القيمة -->
                            <div class="mb-3">
                                <label for="value" class="form-label text-secondary">القيمة</label>
                                <input type="text" class="form-control rounded-pill" id="value" name="value" placeholder="أدخل قيمة المحتوى" required>
                                <div class="invalid-feedback" id="valueError">حقل القيمة مطلوب.</div>
                            </div>
                            <!-- رفع ملف (أي نوع) -->
                            <!-- <div class="mb-3">
                                <label for="image" class="form-label text-secondary">ارفق ملف (صورة، فيديو، صوت، PDF، ...)</label>
                                <input type="file" class="form-control rounded-pill" id="image" name="image">
                            </div> -->

                            <!-- زر الحفظ -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">
                                    <i class="fas fa-save me-2"></i> حفظ
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // عرض الصورة بعد اختيارها
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('imagePreview');
            const removeBtn = document.getElementById('removeImageBtn');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
                previewImage.src = '';
            }

            // عند الضغط على زر الإزالة
            removeBtn.onclick = function() {
                document.getElementById('image').value = '';
                previewImage.src = '';
                previewContainer.style.display = 'none';
            };
        });

        // الفاليديشن بالجافا سكريبت
        document.getElementById('contentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // منع إرسال الفورم

            // إعادة تعيين رسائل الأخطاء
            document.querySelectorAll('.form-control').forEach(input => {
                input.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(error => {
                error.style.display = 'none';
            });

            let isValid = true;

            // التحقق من عنوان المحتوى
            const title = document.getElementById('title');
            if (title.value.trim() === '') {
                title.classList.add('is-invalid');
                document.getElementById('titleError').style.display = 'block';
                isValid = false;
            }

            // التحقق من القسم
            const sectionId = document.getElementById('section_id');
            if (sectionId.value === '') {
                sectionId.classList.add('is-invalid');
                document.getElementById('sectionError').style.display = 'block';
                isValid = false;
            }

            // التحقق من نوع المحتوى
            const type = document.getElementById('type');
            if (type.value === '') {
                type.classList.add('is-invalid');
                document.getElementById('typeError').style.display = 'block';
                isValid = false;
            }

            // التحقق من القيمة
            const value = document.getElementById('value');
            if (value.value.trim() === '') {
                value.classList.add('is-invalid');
                document.getElementById('valueError').style.display = 'block';
                isValid = false;
            }

            // إذا كان كل شيء صحيح، نرسل الفورم
            if (isValid) {
                this.submit();
            }
        });
    </script>

</x-app-layout>