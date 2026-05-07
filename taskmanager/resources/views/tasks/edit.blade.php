@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Task</div>
            <div class="card-body">
                <form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="title">Title *</label>
                        <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="category_id">Category</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (string) old('category_id', $task->category_id) === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tags">Tags</label>
                            <select id="tags" name="tags[]" class="form-control" multiple>
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $task->tags->pluck('id')->all())) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priority">Priority *</label>
                            <select id="priority" name="priority" class="form-control" required>
                                @foreach(['low', 'medium', 'high'] as $priority)
                                <option value="{{ $priority }}" {{ old('priority', $task->priority) === $priority ? 'selected' : '' }}>{{ ucfirst($priority) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="status">Status *</label>
                            <select id="status" name="status" class="form-control" required>
                                @foreach(['pending' => 'Pending', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                                <option value="{{ $value }}" {{ old('status', $task->status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="due_date">Due Date</label>
                            <input id="due_date" type="date" name="due_date" class="form-control" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="attachment">Attachment</label>
                        <input id="attachment" type="file" name="attachment" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
