<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        $admin = auth()->guard('admin')->user();
        $employee = auth()->guard('employee')->user();

        if ($admin && $admin->status >= 1) {
            $permissionsArray = json_decode($admin->administrationGroup->permission, true);
            if ($permission && !in_array($permission, $permissionsArray)) {
                return redirect()->route('dashboard')->with('error', 'Bạn không có quyền truy cập trang này');
            }
        } elseif ($employee && $employee->status >= 1) {
        } else {
            return redirect()->route('adminLogin')->with('error', 'Đăng nhập tại đây.');
        }

        return $next($request);
    }
}
