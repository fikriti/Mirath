<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

class SectionRequest extends FormRequest
{
    /**
     * تحديد إذا ما كان المستخدم مخول لتنفيذ الطلب.
     */
    public function authorize(): bool
    {
        return true; // مؤقتاً السماح للجميع
    }

    /**
     * قواعد التحقق للطلب.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() === 'POST') {
            // عند إنشاء قسم جديد
            return [
                'name' => 'required|string|max:255',
                'note' => 'nullable|string|max:1000',
                'section_id' => 'nullable|exists:sections,id',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'user_add_id' => 'nullable|exists:users,id',
            ];
        } elseif ($this->method() === 'PATCH' || $this->method() === 'PUT') {
            $sectionId = $this->route('section'); // الحصول على معرف القسم من الرابط

            return [
                'name' => 'sometimes|string|max:255',
                'note' => 'nullable|string|max:1000',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'section_id' => [
                    'nullable',
                    'exists:sections,id',
                    Rule::notIn([$sectionId]), // منع ربط القسم بنفسه
                ],
                'user_add_id' => 'nullable|exists:users,id',
            ];
        }

        // في حالة أخرى (مثلاً GET أو DELETE)
        return [];
    }

    /**
     * الرسائل المخصصة للأخطاء.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم القسم مطلوب.',
            'name.string' => 'اسم القسم يجب أن يكون نصاً.',
            'name.max' => 'اسم القسم لا يجب أن يتجاوز 255 حرفاً.',

            'note.string' => 'الملاحظات يجب أن تكون نصاً.',
            'note.max' => 'الملاحظات لا يجب أن تتجاوز 1000 حرف.',

            'section_id.exists' => 'القسم الأب غير موجود.',
            'section_id.not_in' => 'لا يمكن أن يكون القسم تابعاً لنفسه.',

            'user_add_id.exists' => 'المستخدم غير موجود.',
        ];
    }

    // لو حبيت تفعّل رسائل JSON مخصصة بدل redirect في الـ API:
    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'errors' => $validator->errors(),
    //     ], 422));
    // }
}
