<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContentRequest extends FormRequest
{
    /**
     * تحديد صلاحية تنفيذ هذا الطلب.
     */
    public function authorize(): bool
    {
        return true; // مسموح للجميع مؤقتًا
    }

    /**
     * القواعد المطلوبة للتحقق من الطلب.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() === 'POST') {
            // القواعد عند إنشاء محتوى جديد
            return [
                'title' => 'required|string|max:255',
                'section_id' => 'required|exists:sections,id',
                'type' => 'required|in:text,file,link', // أنواع المحتوى المتاحة
                'value' => 'required|string', // ممكن يكون نص أو رابط أو اسم ملف
                'note' => 'nullable|string|max:1000',
                'image' => 'nullable|file|max:20480', // أي نوع، وحد أقصى 20MB
                'user_add_id' => 'nullable|exists:users,id',
            ];
        } elseif ($this->method() === 'PATCH' || $this->method() === 'PUT') {
            $contentId = $this->route('content');
            return [
                'title' => 'sometimes|string|max:255',
                'section_id' => 'sometimes|exists:sections,id',
                'type' => 'sometimes|in:text,file,link',
                'value' => 'sometimes|string',
                'note' => 'nullable|string|max:1000',
                'image' => 'nullable|file|max:20480',
                'user_add_id' => 'nullable|exists:users,id',
            ];
        }

        return [];
    }

    /**
     * الرسائل المخصصة للأخطاء.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان المحتوى مطلوب.',
            'section_id.required' => 'القسم المرتبط مطلوب.',
            'section_id.exists' => 'القسم غير موجود.',
            'type.required' => 'نوع المحتوى مطلوب.',
            'type.in' => 'نوع المحتوى يجب أن يكون نص، ملف، أو رابط.',
            'value.required' => 'قيمة المحتوى مطلوبة.',
        ];
    }

    // يمكنك تفعيل هذا الجزء لو حابب ترجع استجابة JSON بدلاً من تحويل الصفحة
    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'errors' => $validator->errors()
    //     ], 422));
    // }
}
