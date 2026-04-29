<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\Category;
use App\Models\ScoreHistory;

class LogController extends Controller
{
    public function index()
    {
        $logs = Auth::user()->logs()->with('category')->latest()->paginate(10);
        return view('logs.index', compact('logs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('logs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
        ]);

        $category = Category::find($validated['category_id']);
        
        $log = Auth::user()->logs()->create([
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'points_earned' => $category->points,
            'logged_at' => now(),
        ]);

        Auth::user()->scoreHistory()->create([
            'points' => $category->points,
            'description' => 'Logged: ' . $category->name,
            'type' => 'earned',
        ]);

        return redirect()->route('logs.index')->with('success', 'Action logged successfully!');
    }

    public function show(Log $log)
    {
        $this->authorize('view', $log);
        return view('logs.show', compact('log'));
    }

    public function destroy(Log $log)
    {
        $this->authorize('delete', $log);
        $categoryName = $log->category->name;
        $pointsEarned = $log->points_earned;
        $log->delete();
        Auth::user()->scoreHistory()->create([
            'points' => -$pointsEarned,
            'description' => 'Deleted log: ' . $categoryName,
            'type' => 'deducted',
        ]);
        return redirect()->route('logs.index')->with('success', 'Log deleted successfully.');
    }
}
