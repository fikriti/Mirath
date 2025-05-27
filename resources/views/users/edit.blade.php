<x-app-layout>

    <div class="container-fluid ">
        <div class="row justify-content-center ">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0 text-primary fw-bold">
                                تعديل مستخدم
                            </h3>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                                <i class="fas fa-users me-2"></i> عرض المستخدمين
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-0">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('users.update', $user->id) }}" method="post" class="needs-validation">
                            @csrf
                            @method('PUT') <!-- نستخدم PUT علشان نعمل Update -->
                            
                            <!-- الاسم -->
                            <div class="mb-3">
                                <label for="name" class="form-label text-secondary">الاسم</label>
                                <input type="text" class="form-control rounded-pill @error('name') is-invalid @enderror" id="name" name="name" placeholder="أدخل الاسم" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-secondary">البريد الالكتروني </label>
                                <input type="text" class="form-control rounded-pill @error('email') is-invalid @enderror" id="email" name="email" placeholder="أدخل اسم المستخدم" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- كلمة المرور -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-secondary">كلمة المرور جديده</label>
                                <div class="input-group">
                                    <input type="password" 
                                        class="form-control rounded-end-pill @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password" 
                                        placeholder="أدخل كلمة مرور قوية">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <button type="button" class="btn btn-light rounded-start-pill border-end-0" id="togglePassword">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- تأكيد كلمة المرور -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-secondary">تأكيد كلمة المرور</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control rounded-end-pill" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="أعد إدخال كلمة المرور">
                                    <button type="button" class="btn btn-light rounded-start-pill border-end-0" id="togglePasswordConfirmation">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- الدور -->
                            <div class="mb-3">
                                <label for="role" class="form-label text-secondary">الدور</label>
                                <select class="form-control rounded-pill @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>مستخدم</option>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>مدير</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
            const passwordInput = document.getElementById('password_confirmation');
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
    </script>
</x-app-layout>
