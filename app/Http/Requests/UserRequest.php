<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تم السماح للجميع مؤقتًا
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() === 'POST') {
            // قواعد التحقق عند إنشاء مستخدم جديد
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users', // email يجب أن يكون فريدًا
                'password' => ['required', 'confirmed', Rules\Password::defaults()], // كلمة المرور مؤكدة
                'role' => 'nullable|integer|between:0,1', // role يمكن أن يكون 0 أو 1
                'type' => 'nullable|integer|between:0,1', // type يمكن أن يكون 0 أو 1
                'user_add_id' => 'nullable|exists:users,id', // user_add_id يجب أن يكون موجودًا في جدول users
            ];
        } elseif ($this->method() === 'PATCH' || $this->method() === 'PUT') {
            // قواعد التحقق عند تحديث مستخدم موجود
            $userId = $this->route('user'); // الحصول على معرف المستخدم من الرابط
            return [
                'name' => 'sometimes|string|max:255', // name اختياري عند التحديث
                'email' => [
                    'sometimes',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($userId), // email فريد مع تجاهل المستخدم الحالي
                ],
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // كلمة المرور اختيارية
                'role' => 'sometimes|integer|between:0,1', // role اختياري
                'type' => 'sometimes|integer|between:0,1', // type اختياري
                'user_add_id' => 'nullable|exists:users,id', // user_add_id اختياري
            ];
        }

        // إرجاع مصفوفة فارغة إذا لم يكن الطلب POST أو PATCH/PUT
        return [];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'error' => $validator->errors()
    //     ], 422));
    // }
    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'email.required' => 'حقل اسم المستخدم مطلوب.',
            'email.unique' => 'اسم المستخدم مستخدم بالفعل.',
            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'role.between' => 'الصلاحيه يجب أن يكون مستخدم أو مدير.',
            'type.between' => 'النوع يجب أن يكون اكاديميه أو شركه.',
        ];
    }
}