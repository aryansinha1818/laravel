@extends('layouts.app')

@section('title', 'Task List')

@section('nav-links')
<a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all">
    + New Task
</a>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded text-center">
            <h3 class="text-lg font-semibold">Total Tasks</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalTasks }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded text-center">
            <h3 class="text-lg font-semibold">Completed</h3>
            <p class="text-3xl font-bold text-green-600">{{ $completedTasks }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded text-center">
            <h3 class="text-lg font-semibold">Pending</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $totalTasks - $completedTasks }}</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($tasks as $task)
        <div class="border rounded-lg p-4 hover:shadow-lg transition-all">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h3 class="text-xl font-semibold {{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                        {{ $task->title }}
                    </h3>
                    <p class="text-gray-600 mt-1">{{ Str::limit($task->description, 100) }}</p>
                    <div class="flex gap-2 mt-2">
                        <span class="px-2 py-1 text-xs rounded 
                                    @if($task->priority == 'high') bg-red-100 text-red-700
                                    @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-700
                                    @else bg-green-100 text-green-700
                                    @endif">
                            {{ ucfirst($task->priority) }}
                        </span>
                        @if($task->due_date)
                        <span class="px-2 py-1 text-xs bg-gray-100 rounded">
                            📅 Due: {{ $task->due_date->format('M d, Y') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('tasks.show', $task) }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm transition-all">
                        View
                    </a>
                    <a href="{{ route('tasks.edit', $task) }}"
                        class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm transition-all">
                        Edit
                    </a>
                    @if(!$task->is_completed)
                    <form action="{{ route('tasks.complete', $task) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-sm transition-all">
                            Complete
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                        onsubmit="return confirm('Delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition-all">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-gray-500">
            No tasks yet. Create your first task!
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
</div>
@endsection