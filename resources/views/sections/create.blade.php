<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 text-primary fw-bold">
                                اضافة قسم
                            </h3>
                            <a href="{{ route('sections.index') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                                <i class="fas fa-list me-2"></i> عرض الأقسام
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                        <div class="alert alert-danger rounded-pill px-4 py-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form id="sectionForm" action="{{ route('sections.store') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <!-- اسم القسم -->
                            <div class="mb-3">
                                <label for="name" class="form-label text-secondary">اسم القسم</label>
                                <input type="text" class="form-control rounded-pill" id="name" name="name" placeholder="أدخل اسم القسم" required>
                                <div class="invalid-feedback" id="nameError">حقل اسم القسم مطلوب.</div>
                            </div>

                            <!-- ملاحظة -->
                            <div class="mb-3">
                                <label for="note" class="form-label text-secondary">ملاحظة</label>
                                <textarea class="form-control rounded-pill" id="note" name="note" rows="3" placeholder="أدخل ملاحظة عن القسم"></textarea>
                            </div>

                            <!-- القسم الأب -->
                            <div class="mb-3">
                                <label for="section_id" class="form-label text-secondary">القسم الأب</label>
                                <select class="form-control rounded-pill" id="section_id" name="section_id">
                                    <option value="">لا يوجد</option>
                                    @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="sectionError">حقل القسم الأب مطلوب.</div>
                            </div>
                            <!-- صورة القسم -->
                            <div class="mb-3">
                                <label for="image" class="form-label text-secondary">صورة القسم</label>
                                <input type="file" class="form-control rounded-pill" id="image" name="image" accept="image/*">
                                <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                                    <img id="imagePreview" src="" alt="صورة القسم" class="img-thumbnail mb-2" style="max-width: 200px;">
                                    <br>
                                    <button type="button" id="removeImageBtn" class="btn btn-danger btn-sm rounded-pill">
                                        <i class="fas fa-times"></i> إزالة الصورة
                                    </button>
                                </div>
                            </div>

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
        document.getElementById('sectionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // منع إرسال الفورم

            // إعادة تعيين رسائل الأخطاء
            document.querySelectorAll('.form-control').forEach(input => {
                input.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(error => {
                error.style.display = 'none';
            });

            let isValid = true;

            // التحقق من اسم القسم
            const name = document.getElementById('name');
            if (name.value.trim() === '') {
                name.classList.add('is-invalid');
                document.getElementById('nameError').style.display = 'block';
                isValid = false;
            }

            // التحقق من القسم الأب
            // const sectionId = document.getElementById('section_id');
            // if (sectionId.value === '') {
            //     sectionId.classList.add('is-invalid');
            //     document.getElementById('sectionError').style.display = 'block';
            //     isValid = false;
            // }

            // إذا كان كل شيء صحيح، نرسل الفورم
            if (isValid) {
                this.submit();
            }
        });
    </script>

</x-app-layout>