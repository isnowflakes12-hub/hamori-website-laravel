<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Only super admin can access
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $query = Activity::with('causer')->latest();

        // Optional filtering by module (using class basename)
        if ($request->filled('module')) {
            $query->where('subject_type', 'like', '%' . $request->module);
        }

        // Optional filtering by action
        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        // Optional filtering by user
        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        $logs = $query->paginate(20)->withQueryString();
        $users = User::orderBy('name')->get();
        $modules = Activity::select('subject_type')->distinct()->pluck('subject_type');

        return view('admin.activity-log.index', compact('logs', 'users', 'modules'));
    }
}
