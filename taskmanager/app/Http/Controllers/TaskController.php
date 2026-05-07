<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['category', 'tags'])
            ->where('user_id', Auth::id());

        // Search functionality
        if ($request->search) {
            $query->where(function ($searchQuery) use ($request) {
                $searchQuery->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('tasks.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:tasks,title',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date|after:today',
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // File upload
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment'] = $path;
        }

        $validated['user_id'] = Auth::id();

        $task = Task::create($validated);

        // Attach tags
        if ($request->has('tags')) {
            $task->tags()->attach($request->tags);
        }

        // Flash session message
        Session::flash('success', 'Task created successfully!');

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        $this->ensureOwner($task);
        $task->load(['category', 'tags']);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->ensureOwner($task);

        $categories = Category::all();
        $tags = Tag::all();
        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    public function update(Request $request, Task $task)
    {
        $this->ensureOwner($task);

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:tasks,title,' . $task->id,
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        if ($request->hasFile('attachment')) {
            if ($task->attachment) {
                Storage::disk('public')->delete($task->attachment);
            }
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $task->update($validated);
        $task->tags()->sync($request->input('tags', []));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $this->ensureOwner($task);

        if ($task->attachment) {
            Storage::disk('public')->delete($task->attachment);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function deleteMultiple(Request $request)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:tasks,id'],
        ]);

        Task::whereIn('id', $validated['ids'])->where('user_id', Auth::id())->delete();

        return response()->json(['success' => true]);
    }

    private function ensureOwner(Task $task): void
    {
        abort_unless($task->user_id === Auth::id(), 403, 'Unauthorized access to this task');
    }
}
