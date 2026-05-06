@extends('layouts.app')

@section('title', 'Edit Task')

@section('nav-links')
<a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-gray-800">← Back to Tasks</a>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Task</h2>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('title') border-red-500 @enderror">
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">{{ old('description', $task->description) }}</textarea>
            @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Priority</label>
            <div class="space-y-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="priority" value="low" {{ old('priority', $task->priority) == 'low' ? 'checked' : '' }} class="mr-2">
                    Low
                </label>
                <label class="inline-flex items-center ml-4">
                    <input type="radio" name="priority" value="medium" {{ old('priority', $task->priority) == 'medium' ? 'checked' : '' }} class="mr-2">
                    Medium
                </label>
                <label class="inline-flex items-center ml-4">
                    <input type="radio" name="priority" value="high" {{ old('priority', $task->priority) == 'high' ? 'checked' : '' }} class="mr-2">
                    High
                </label>
            </div>
            @error('priority')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="due_date" class="block text-gray-700 font-bold mb-2">Due Date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('due_date') border-red-500 @enderror">
            @error('due_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all">
                Update Task
            </button>
            <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition-all">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection