<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('q', ''));

        $totalUsers = User::students()->count();
        $totalSubjects = Subject::whereHas('user', fn ($q) => $q->students())->count();

        $contents = fn () => Content::whereHas('subject.user', fn ($q) => $q->students());
        $totalContents = $contents()->count();
        $doneContents = $contents()->where('status', true)->count();
        $progress = $totalContents ? round($doneContents / $totalContents * 100) : 0;

        $newUsers = User::students()->where('created_at', '>=', now()->subDays(7))->count();

        $users = User::students()
            ->withCount([
                'subjects',
                'contents',
                'contents as done_contents_count' => fn ($q) => $q->where('contents.status', true),
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.dashboard', compact(
            'search', 'users',
            'totalUsers', 'totalSubjects', 'totalContents', 'progress', 'newUsers',
        ));
    }
}
