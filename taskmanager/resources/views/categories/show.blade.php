@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="page-heading">
    <div>
        <h1>{{ $category->name }}</h1>
        <p class="text-muted mb-0">{{ $category->description ?: 'No description' }}</p>
    </div>
    <a class="btn btn-secondary" href="{{ route('categories.index') }}">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <h5>Tasks in this category</h5>
        <ul class="task-list">
            @forelse($category->tasks as $task)
            <li><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a><span>{{ ucfirst($task->status) }}</span></li>
            @empty
            <li>No tasks yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
