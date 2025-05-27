<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // إضافة Log
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function indexUser($searchUser = null, $perPageUser = 10)
    {
        // Get ID of the first user (أول يوزر خالص)
        $firstUser = $this->model->orderBy('id')->first();

        return $this->model
            ->when($searchUser, function ($query) use ($searchUser) {
                $query->where(function ($q) use ($searchUser) {
                    $q->where('name', 'like', '%' . $searchUser . '%')
                        ->orWhere('email', 'like', '%' . $searchUser . '%');
                });
            })
            ->when($firstUser, function ($query) use ($firstUser) {
                // استبعاد أول يوزر
                $query->where('id', '!=', $firstUser->id);
            })
            ->paginate($perPageUser);
    }
    
    public function storeUser($requestData)
    {
        try {
            if ($this->model->where('email', $requestData['email'])->exists()) {
                return ['message' => 'اسم المستخدم مستخدم بالفعل'];
            }

            $this->model->create([
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                // 'password' => $requestData['password'],
                'password' => Hash::make($requestData['password']),
                'role' => $requestData['role'] ?? 0,
                // 'type' => $requestData['type'] ?? 0,
                'user_add_id' => Auth::id()  ?? null,
            ]);

            return ['message' => 'تم إنشاء المستخدم بنجاح'];
        } catch (\Exception $e) {
            Log::error($e->getMessage()); // استخدام Log لتسجيل الأخطاء
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }

    public function editUser($userId)
    {
        return $this->model->find($userId);
    }

    public function updateUser($requestData, $userId)
    {

        try {
            $user = $this->model->find($userId);

            if (!$user) {
                return ['message' => 'المستخدم غير موجود'];
            }

            $dataToUpdate = $requestData;

            // لو الباسوورد الجديد مش موجود، نستخدم الباسوورد القديم
            if (empty($requestData['password'])) {
                unset($dataToUpdate['password']); // نمسح الباسوورد من البيانات اللي هتتحدد
            } else {
                // $dataToUpdate['password'] = Hash::make($requestData['password']); // نعمّل Hash للباسوورد الجديد
                $dataToUpdate['password'] = Hash::make($requestData['password']); // نعمّل Hash للباسوورد الجديد
            }
            // لو اليوزر نيم الجديد هو نفسه القديم، نمسحه من البيانات علشان ميتمش تحديثه
            if ($requestData['email'] === $user->email) {
                unset($dataToUpdate['email']);
            }

            $user->update($dataToUpdate);

            return ['message' => 'تم تحديث المستخدم بنجاح'];
        } catch (\Exception $e) {
            Log::error($e->getMessage()); // استخدام Log لتسجيل الأخطاء
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }

    public function destroyUser($userId)
    {
        try {
            $user = $this->model->find($userId);

            if (!$user) {
                return ['message' => 'المستخدم غير موجود'];
            }

            $user->delete();

            return ['message' => 'تم حذف المستخدم بنجاح'];
        } catch (\Exception $e) {
            Log::error($e->getMessage()); // استخدام Log لتسجيل الأخطاء
            return ['message' => 'حدث خطأ في الخادم'];
        }
    }
}
