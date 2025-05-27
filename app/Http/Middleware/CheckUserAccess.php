<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // 🔒 لو مش مسجل دخول، رجعه للـ login
        if (!$user) {
            return redirect('/login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        // 🛑 لو الـ role مش متحدد
        if (!isset($user->role)) {
            Auth::logout(); // نخرج المستخدم لعدم وجود صلاحية
            return redirect('/login')->with('error', 'الصلاحيات غير معرفة');
        }
        // dd($user->role);
        // ✅ لو المستخدم أدمن (role = 1) => يدخل على طول
        if ($user->role == 1) {

            return $next($request);
        } else {
            return redirect('/')->with('error', 'الصلاحيات غير معرفة');
        }

        //  لو المستخدم مش أدمن
        // نحميه من الوصول لأي رابط غير مسموح به
        // ممكن تحدد المسارات هنا لو عاوز تزيد حماية حسب route
        // if ($request->is('dashboard*') || $request->routeIs('admin.*')) {
        //     return redirect('/login')->with('error', 'ليس لديك صلاحية الوصول لهذه الصفحة');
        // }

        // ✅ لو المستخدم عادي ومفيش عليه مانع تقدر تخليه يكمل على واجهة المستخدم فقط
        // return $next($request);
    }
}
