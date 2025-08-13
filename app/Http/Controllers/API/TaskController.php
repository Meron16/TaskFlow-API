<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // List tasks, optionally filter by status
    public function index(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:pending,in_progress,completed',
        ]);

        $query = Auth::user()->tasks();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        return response()->json($query->get());
    }

    // Create a new task
    public function store(Request $request)
    {
      $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'status' => 'required|string|in:pending,completed,in-progress',
    'priority' => 'nullable|string|in:low,medium,high',
    'due_date' => 'nullable|date',
]);


        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
            'priority' => $request->priority ?? 'medium',
            'due_date' => $request->due_date,
        ]);

        return response()->json($task, 201);
    }

    // Show a specific task owned by the user
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($task);
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

   $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'status' => 'required|string|in:pending,completed,in-progress',
    'priority' => 'nullable|string|in:low,medium,high',
    'due_date' => 'nullable|date',
]);


        $task->update([
    'title' => $request->title,
    'description' => $request->description,
    'status' => $request->status,
    'priority' => $request->priority ?? 'medium',
    'due_date' => $request->due_date,
]);


        return response()->json($task);
    }

    // Delete a task
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->noContent();
    }
}
