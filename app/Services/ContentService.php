<?php

namespace App\Services;

use App\Models\Content;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ContentService
{
    private $model;

    public function __construct(Content $model)
    {
        $this->model = $model;
    }

    public function indexContent($search = null, $perPage = 10)
    {
        return $this->model->when($search, function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('note', 'like', '%' . $search . '%');
        })->paginate($perPage);
    }

    public function storeContent($requestData)
    {
        try {
            $fileUrl = null;

            if (!empty($requestData['image']) && $requestData['image'] instanceof \Illuminate\Http\UploadedFile) {
                $folder = 'assets/contents';
                $directory = public_path($folder);

                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                $filename = time() . '_' . $requestData['image']->getClientOriginalName();
                $requestData['image']->move($directory, $filename);
                $fileUrl = asset($folder . '/' . $filename);
            }

            $this->model->create([
                'title'       => $requestData['title'],
                'section_id'  => $requestData['section_id'],
                'type'        => $requestData['type'],
                'value'       => $requestData['value'] ?? null,
                'note'        => $requestData['note'] ?? null,
                'image'        => $fileUrl,
                'user_add_id' => Auth::id() ?? null,
            ]);

            return ['message' => 'تم إنشاء المحتوى بنجاح'];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }



    public function editContent($contentId)
    {
        return $this->model->find($contentId);
    }

    public function updateContent($requestData, $contentId)
    {
        try {
            $content = $this->model->find($contentId);

            if (!$content) {
                return ['message' => 'المحتوى غير موجود'];
            }

            // تحديث الملف لو فيه رفع جديد
            if (!empty($requestData['image']) && $requestData['image'] instanceof \Illuminate\Http\UploadedFile) {
                if ($content->file) {
                    $oldPath = public_path(parse_url($content->file, PHP_URL_PATH));
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $folder = 'assets/contents';
                $directory = public_path($folder);

                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                $filename = time() . '_' . $requestData['image']->getClientOriginalName();
                $requestData['image']->move($directory, $filename);
                $content->file = asset($folder . '/' . $filename);
            }

            // تحديث باقي البيانات
            $content->update([
                'title'       => $requestData['title'] ?? $content->title,
                'section_id'  => $requestData['section_id'] ?? $content->section_id,
                'type'        => $requestData['type'] ?? $content->type,
                'value'       => $requestData['value'] ?? $content->value,
                'note'        => $requestData['note'] ?? $content->note,
                'image'        => $content->file,
            ]);

            return ['message' => 'تم تحديث المحتوى بنجاح'];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }




    public function destroyContent($contentId)
    {
        try {
            $content = $this->model->find($contentId);

            if (!$content) {
                return ['message' => 'المحتوى غير موجود'];
            }

            $content->delete();

            return ['message' => 'تم حذف المحتوى بنجاح'];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }
}
