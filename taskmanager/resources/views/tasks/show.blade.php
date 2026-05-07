@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="page-heading">
    <div>
        <h1>{{ $task->title }}</h1>
        <p class="text-muted mb-0">{{ $task->category->name ?? 'Uncategorized' }}</p>
    </div>
    <div class="action-row">
        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card detail-card">
    <div class="card-body">
        <div class="meta-grid">
            <div><span>Priority</span><strong>{{ ucfirst($task->priority) }}</strong></div>
            <div><span>Status</span><strong>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</strong></div>
            <div><span>Due Date</span><strong>{{ $task->formatted_due_date }}</strong></div>
        </div>

        <h5>Description</h5>
        <p>{{ $task->description ?: 'No description provided.' }}</p>

        <h5>Tags</h5>
        <div class="tag-list">
            @forelse($task->tags as $tag)
            <span class="tag-pill">{{ $tag->name }}</span>
            @empty
            <span class="text-muted">No tags assigned.</span>
            @endforelse
        </div>

        @if($task->attachment)
        <a class="btn btn-outline-primary mt-3" href="{{ asset('storage/' . $task->attachment) }}" target="_blank">View Attachment</a>
        @endif
    </div>
</div>
@endsection
