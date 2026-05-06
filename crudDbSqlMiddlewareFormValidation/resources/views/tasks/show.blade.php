@extends('layouts.app')

@section('title', 'Task Details')

@section('nav-links')
<a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-gray-800">← Back to Tasks</a>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-start mb-4">
        <h2 class="text-2xl font-bold">{{ $task->title }}</h2>
        <div class="flex gap-2">
            <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">Delete</button>
            </form>
        </div>
    </div>

    <div class="space-y-4">
        <div>
            <h3 class="font-bold text-gray-700">Status:</h3>
            <p class="mt-1">
                @if($task->is_completed)
                <span class="bg-green-100 text-green-700 px-2 py-1 rounded">✅ Completed</span>
                @else
                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">⏳ Pending</span>
                @endif
            </p>
        </div>

        <div>
            <h3 class="font-bold text-gray-700">Priority:</h3>
            <p class="mt-1">
                <span class="px-2 py-1 text-sm rounded 
                        @if($task->priority == 'high') bg-red-100 text-red-700
                        @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-700
                        @else bg-green-100 text-green-700
                        @endif">
                    {{ ucfirst($task->priority) }}
                </span>
            </p>
        </div>

        <div>
            <h3 class="font-bold text-gray-700">Due Date:</h3>
            <p class="mt-1">{{ $task->due_date ? $task->due_date->format('F j, Y') : 'Not set' }}</p>
        </div>

        <div>
            <h3 class="font-bold text-gray-700">Description:</h3>
            <p class="mt-1 text-gray-600">{{ $task->description ?: 'No description provided' }}</p>
        </div>

        <div>
            <h3 class="font-bold text-gray-700">Created:</h3>
            <p class="mt-1 text-sm text-gray-500">{{ $task->created_at->format('F j, Y g:i A') }}</p>
        </div>
    </div>
</div>
@endsection