<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $section)
    {
        $user = Auth::user();
        if (!$user || !$user->canAccess($section)) {
            if ($request->expectsJson()) return response()->json(['message' => 'Forbidden'], 403);
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke bagian ini.');
        }
        return $next($request);
    }
}
