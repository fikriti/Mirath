<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 text-primary fw-bold">
                                تعديل قسم
                            </h3>
                            <a href="{{ route('sections.index') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                                <i class="fas fa-list me-2"></i> عرض الأقسام
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="sectionForm" enctype="multipart/form-data" action="{{ route('sections.update', $section->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <!-- اسم القسم -->
                            <div class="mb-3">
                                <label for="name" class="form-label text-secondary">اسم القسم</label>
                                <input type="text" class="form-control rounded-pill" id="name" name="name" value="{{ old('name', $section->name) }}" placeholder="أدخل اسم القسم" required>
                                <div class="invalid-feedback" id="nameError">حقل اسم القسم مطلوب.</div>
                            </div>

                            <!-- ملاحظة -->
                            <div class="mb-3">
                                <label for="note" class="form-label text-secondary">ملاحظة</label>
                                <textarea class="form-control rounded-pill" id="note" name="note" rows="3" placeholder="أدخل ملاحظة عن القسم">{{ old('note', $section->note) }}</textarea>
                            </div>

                            <!-- القسم الأب -->
                            <div class="mb-3">
                                <label for="section_id" class="form-label text-secondary">القسم الأب</label>
                                <select class="form-control rounded-pill" id="section_id" name="section_id">
                                    <option value="">لا يوجد</option>
                                    @foreach($sections as $parentSection)
                                    <option value="{{ $parentSection->id }}"
                                        {{ old('section_id', $section->section_id) == $parentSection->id ? 'selected' : '' }}>
                                        {{ $parentSection->name }}
                                    </option>
                                    @endforeach
                                </select>
                                
                                <div class="invalid-feedback" id="sectionError">حقل القسم  مطلوب.</div>
                            </div>
                            <!-- صورة القسم -->
                            <div class="mb-3">
                                <label for="image" class="form-label text-secondary">صورة القسم</label>
                                <input type="file" class="form-control rounded-pill" id="image" name="image" accept="image/*">

                                @if($section->image)
                                <div class="mt-3" id="imagePreviewContainer">
                                    <img id="imagePreview" src="{{ asset( $section->image) }}" alt="صورة القسم" class="img-thumbnail mb-2" style="max-width: 200px;">
                                    <br>
                                   
                                </div>
                                @else
                                <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                                    <img id="imagePreview" src="" alt="صورة القسم" class="img-thumbnail mb-2" style="max-width: 200px;">
                                    <br>
                                  
                                </div>
                                @endif
                            </div>

                            <!-- زر التعديل -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">
                                    <i class="fas fa-edit me-2"></i> تعديل
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
            }

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