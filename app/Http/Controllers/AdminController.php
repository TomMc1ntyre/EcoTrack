<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use App\Models\Goal;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalLogs = Log::count();
        $totalGoals = Goal::count();
        $totalCategories = Category::count();
        
        return view('admin.index', compact('totalUsers', 'totalLogs', 'totalGoals', 'totalCategories'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function toggleRole(User $user)
    {
        $user->update([
            'role' => $user->role === 'admin' ? 'user' : 'admin'
        ]);
        return back()->with('success', 'User role updated successfully.');
    }

    public function stats()
    {
        $recentLogs = Log::with('user', 'category')->latest()->limit(10)->get();
        $topUsers = User::withCount('logs')
            ->orderBy('logs_count', 'desc')
            ->limit(5)
            ->get();
            
        return view('admin.stats', compact('recentLogs', 'topUsers'));
    }
}
