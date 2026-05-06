<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Rules\ValidPriority;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 📌 Display all tasks
    public function index()
    {
        $tasks = Task::latest()->paginate(10);
        $totalTasks = Task::count();
        $completedTasks = Task::where('is_completed', true)->count();

        return view('tasks.index', compact('tasks', 'totalTasks', 'completedTasks'));
    }

    // 📌 Show create form
    public function create()
    {
        return view('tasks.create');
    }

    // 📌 Store new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|string',
            'priority' => ['required', new ValidPriority()],
            'due_date' => 'required|date|after_or_equal:today',
        ], [
            'title.required' => 'Please enter task title',
            'title.min' => 'Title must be at least 3 characters',
            'due_date.after_or_equal' => 'Due date cannot be in the past'
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    // 📌 Show single task
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // 📌 Show edit form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // 📌 Update task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|string',
            'priority' => ['required', new ValidPriority()],
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    // 📌 Delete task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    // 📌 Mark as completed
    public function complete(Task $task)
    {
        $task->markAsCompleted();

        return redirect()->back()
            ->with('success', 'Task marked as completed!');
    }
}
