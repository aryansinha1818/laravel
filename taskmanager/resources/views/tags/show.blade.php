@extends('layouts.app')

@section('title', $tag->name)

@section('content')
<div class="page-heading">
    <div>
        <h1>{{ $tag->name }}</h1>
        <p class="text-muted mb-0">{{ $tag->slug }}</p>
    </div>
    <a class="btn btn-secondary" href="{{ route('tags.index') }}">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <h5>Tasks with this tag</h5>
        <ul class="task-list">
            @forelse($tag->tasks as $task)
            <li><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a><span>{{ ucfirst($task->status) }}</span></li>
            @empty
            <li>No tasks yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
