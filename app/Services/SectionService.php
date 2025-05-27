<?php

namespace App\Services;

use App\Models\Section;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SectionService
{
    private $model;

    public function __construct(Section $model)
    {
        $this->model = $model;
    }

    /**
     * جلب قائمة الأقسام مع إمكانية البحث والصفحة.
     *
     * @param string|null $searchSection
     * @param int         $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function indexSection($searchSection = null, $perPage = 10)
    {
        return $this->model
            ->with('parent', 'addedBy')
            ->when($searchSection, function ($query) use ($searchSection) {
                $query->where('name', 'like', "%{$searchSection}%")
                    ->orWhere('note', 'like', "%{$searchSection}%");
            })
            ->paginate($perPage);
    }

    /**
     * إنشاء قسم جديد.
     *
     * @param array $data
     * @return array
     */

    public function storeSection(array $data)
    {
        
        try {
            if ($this->model->where('name', $data['name'])->exists()) {
                return ['message' => 'اسم القسم مستخدم بالفعل'];
            }

            $imageUrl = null;

            // معالجة رفع الصورة (لو موجودة ومرفوعة)
            if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $folder = 'assets/sections';
                $directory = public_path($folder);

                // إنشاء المجلد إذا غير موجود
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                $filename = time() . '_' . $data['image']->getClientOriginalName();
                $data['image']->move($directory, $filename);

                // حفظ رابط الصورة كاملًا
                $imageUrl = asset($folder . '/' . $filename);
            }

            // إنشاء القسم
            $this->model->create([
                'name'        => $data['name'],
                'note'        => $data['note'] ?? null,
                'section_id'  => $data['section_id'] ?? null,
                'user_add_id' => Auth::id() ?? null,
                'image'       => $imageUrl, // يتم حفظ رابط الصورة هنا
            ]);

            return ['message' => 'تم إنشاء القسم بنجاح'];
        } catch (\Exception $e) {
            Log::error('Error creating section: ' . $e->getMessage());
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }

    /**
     * جلب بيانات قسم معين للتعديل.
     *
     * @param int $sectionId
     * @return Section|null
     */
    public function editSection(int $sectionId)
    {
        return $this->model->find($sectionId);
    }

    /**
     * تحديث بيانات قسم.
     *
     * @param array $data
     * @param int   $sectionId
     * @return array
     */
    public function updateSection(array $data, $id)
    {
        $section = Section::findOrFail($id);

        if (request()->hasFile('image')) {
            // حذف الصورة القديمة (لو كانت محفوظة كرابط كامل، استخرج اسمها فقط)
            if ($section->image) {
                $oldPath = public_path(parse_url($section->image, PHP_URL_PATH));
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // نفس أسلوب الحفظ المستخدم في الإنشاء
            $folder = 'assets/sections';
            $directory = public_path($folder);

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }

            $filename = time() . '_' . request()->file('image')->getClientOriginalName();
            request()->file('image')->move($directory, $filename);

            $imageUrl = asset($folder . '/' . $filename);
            $data['image'] = $imageUrl;
        } else {
            unset($data['image']); // عشان ما يفضيش الحقل لو مفيش صورة جديدة
        }

        $section->update($data);

        return ['message' => 'تم تحديث القسم بنجاح'];
    }




    /**
     * حذف قسم.
     *
     * @param int $sectionId
     * @return array
     */
    public function destroySection(int $sectionId)
    {
        try {
            $section = $this->model->find($sectionId);
            if (! $section) {
                return ['message' => 'القسم غير موجود'];
            }

            $section->delete();

            return ['message' => 'تم حذف القسم بنجاح'];
        } catch (\Exception $e) {
            Log::error('Error deleting section: ' . $e->getMessage());
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }
}
