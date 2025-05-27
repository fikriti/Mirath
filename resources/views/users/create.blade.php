<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 text-primary fw-bold">
                                اضافة مستخدم
                            </h3>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                                <i class="fas fa-users me-2"></i> عرض المستخدمين
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="userForm" action="{{ route('users.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <!-- الاسم -->
                            <div class="mb-3">
                                <label for="name" class="form-label text-secondary">الاسم</label>
                                <input type="text" class="form-control rounded-pill" id="name" name="name" placeholder="أدخل الاسم" required>
                                <div class="invalid-feedback" id="nameError">حقل الاسم مطلوب.</div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-secondary">اسم البريد الالكتروني</label>
                                <input type="text" class="form-control rounded-pill" id="email" name="email" placeholder="أدخل اسم البريد الالكتروني" required>
                                <div class="invalid-feedback" id="emailError">حقل اسم البريد الالكتروني مطلوب.</div>
                            </div>

                            <!-- كلمة المرور -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-secondary">كلمة المرور</label>
                                <div class="input-group">
                                    <input type="password" 
                                        class="form-control rounded-end-pill" 
                                        id="password" 
                                        name="password" 
                                        placeholder="أدخل كلمة مرور قوية" 
                                        required>
                                    <button type="button" class="btn btn-light rounded-start-pill border-end-0" id="togglePassword">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="passwordError">حقل كلمة المرور مطلوب.</div>
                            </div>

                            <!-- تأكيد كلمة المرور -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-secondary">تأكيد كلمة المرور</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control rounded-end-pill" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="أعد إدخال كلمة المرور" 
                                           required>
                                    <button type="button" class="btn btn-light rounded-start-pill border-end-0" id="togglePasswordConfirmation">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="passwordConfirmationError">تأكيد كلمة المرور غير متطابق.</div>
                            </div>

                            <!-- الدور -->
                            <div class="mb-3">
                                <label for="role" class="form-label text-secondary">الدور</label>
                                <select class="form-control rounded-pill" id="role" name="role" required>
                                    <option value="0">مستخدم</option>
                                    <option value="1">مدير</option>
                                </select>
                                <div class="invalid-feedback" id="roleError">حقل الدور مطلوب.</div>
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
        // إظهار/إخفاء كلمة المرور
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });

        // إظهار/إخفاء تأكيد كلمة المرور
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            
            if (passwordConfirmationInput.type === 'password') {
                passwordConfirmationInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordConfirmationInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });

        // الفاليديشن بالجافا سكريبت
        document.getElementById('userForm').addEventListener('submit', function (event) {
            event.preventDefault(); // منع إرسال الفورم

            // إعادة تعيين رسائل الأخطاء
            document.querySelectorAll('.form-control').forEach(input => {
                input.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(error => {
                error.style.display = 'none';
            });

            let isValid = true;

            // التحقق من الاسم
            const name = document.getElementById('name');
            if (name.value.trim() === '') {
                name.classList.add('is-invalid');
                document.getElementById('nameError').style.display = 'block';
                isValid = false;
            }

            // التحقق من اسم البريد الالكتروني
            const email = document.getElementById('email');
            if (email.value.trim() === '') {
                email.classList.add('is-invalid');
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            }

            // التحقق من كلمة المرور
            const password = document.getElementById('password');
            if (password.value.trim() === '') {
                password.classList.add('is-invalid');
                document.getElementById('passwordError').style.display = 'block';
                isValid = false;
            }

            // التحقق من تأكيد كلمة المرور
            const passwordConfirmation = document.getElementById('password_confirmation');
            if (passwordConfirmation.value.trim() === '' || passwordConfirmation.value !== password.value) {
                passwordConfirmation.classList.add('is-invalid');
                document.getElementById('passwordConfirmationError').style.display = 'block';
                isValid = false;
            }

            // التحقق من الدور
            const role = document.getElementById('role');
            if (role.value === '') {
                role.classList.add('is-invalid');
                document.getElementById('roleError').style.display = 'block';
                isValid = false;
            }

           

            // إذا كان كل شيء صحيح، نرسل الفورم
            if (isValid) {
                this.submit();
            }
        });
    </script>
</x-app-layout>
