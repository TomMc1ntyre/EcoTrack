<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Auth::user()->goals()->latest()->paginate(10);
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_count' => 'required|integer|min:1',
            'deadline' => 'nullable|date',
        ]);

        Auth::user()->goals()->create($validated);

        return redirect()->route('goals.index')->with('success', 'Goal created successfully!');
    }

    public function show(Goal $goal)
    {
        $this->authorize('view', $goal);
        return view('goals.show', compact('goal'));
    }

    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_count' => 'required|integer|min:1',
            'current_count' => 'required|integer|min:0',
            'status' => 'required|in:active,completed,cancelled',
            'deadline' => 'nullable|date',
        ]);

        $goal->update($validated);

        if ($validated['status'] === 'completed' && $goal->wasChanged('status') === false) {
            Auth::user()->scoreHistory()->create([
                'points' => 50,
                'description' => 'Goal completed: ' . $goal->title,
                'type' => 'earned',
            ]);
        }

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully!');
    }

    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();
        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully.');
    }
}
