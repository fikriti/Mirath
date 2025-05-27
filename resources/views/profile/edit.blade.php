<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            {{ __('الملف الشخصي') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- بيانات المستخدم -->
            <div class="p-6 sm:p-8 bg-white shadow-md rounded-2xl border border-gray-200">
                <div class="max-w-xl mx-auto text-right space-y-2" dir="rtl">
                    <h3 class="text-lg font-semibold text-gray-800">بيانات الحساب</h3>
                    
                    <div class="text-sm text-gray-700">
                        <span class="font-medium">الاسم:</span> {{ Auth::user()->name }}
                    </div>
                    
                    <div class="text-sm text-gray-700">
                        <span class="font-medium">البريد الإلكتروني:</span> {{ Auth::user()->email }}
                    </div>

                    <div class="text-sm text-gray-700">
                        <span class="font-medium">تاريخ التسجيل:</span>
                        {{ Auth::user()->created_at->format('Y-m-d') }}
                    </div>
                </div>
            </div>

            <!-- تم تعليق هذه الأجزاء بناءً على طلبك -->
            <!--
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            -->

            <!-- فورم تغيير كلمة المرور -->
            <div class="p-6 sm:p-8 bg-white shadow-md rounded-2xl border border-gray-200">
                <div class="max-w-xl mx-auto">
                    <section dir="rtl">
                        <header>
                            <h2 class="text-lg font-bold text-gray-800">
                                تحديث كلمة المرور
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                تأكد من أن حسابك يستخدم كلمة مرور قوية وعشوائية للحفاظ على أمانه.
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="update_password_current_password" value="كلمة المرور الحالية" />
                                <x-text-input id="update_password_current_password" name="current_password" type="password"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password" value="كلمة المرور الجديدة" />
                                <x-text-input id="update_password_password" name="password" type="password"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password_confirmation" value="تأكيد كلمة المرور" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg">
                                    حفظ التغييرات
                                </x-primary-button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 3000)"
                                        class="text-sm text-green-600"
                                    >
                                        تم الحفظ بنجاح.
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- تم تعليق هذه الأجزاء بناءً على طلبك -->
            <!--
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            -->
        </div>
    </div>
</x-app-layout>
