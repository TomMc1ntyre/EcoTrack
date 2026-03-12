<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalPoints = $user->scoreHistory()->sum('points');
        $totalLogs = $user->logs()->count();
        $activeGoals = $user->goals()->where('status', 'active')->count();
        $recentLogs = $user->logs()->with('category')->latest()->limit(5)->get();
        
        return view('dashboard', compact('totalPoints', 'totalLogs', 'activeGoals', 'recentLogs'));
    }
}
