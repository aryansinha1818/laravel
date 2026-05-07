@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Task List</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create Task
    </a>
</div>

<!-- Search and Filter Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('tasks.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search tasks..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="priority" class="form-control">
                        <option value="">All Priority</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bulk Delete Form -->
<form id="bulkDeleteForm">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="50"><input type="checkbox" id="selectAll"></th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                        <tr>
                            <td><input type="checkbox" name="ids[]" class="taskCheckbox" value="{{ $task->id }}"></td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->category->name ?? 'Uncategorized' }}</td>
                            <td>
                                <span class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'info') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'primary' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td>{{ $task->formatted_due_date }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No tasks found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <button type="button" id="bulkDeleteBtn" class="btn btn-danger" disabled>
                        Delete Selected
                    </button>
                </div>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Select All functionality
        $('#selectAll').click(function() {
            $('.taskCheckbox').prop('checked', $(this).prop('checked'));
            toggleDeleteButton();
        });

        $('.taskCheckbox').change(function() {
            toggleDeleteButton();
        });

        function toggleDeleteButton() {
            var checked = $('.taskCheckbox:checked').length;
            $('#bulkDeleteBtn').prop('disabled', checked === 0);
        }

        // Bulk delete
        $('#bulkDeleteBtn').click(function() {
            var ids = [];
            $('.taskCheckbox:checked').each(function() {
                ids.push($(this).val());
            });

            if (ids.length > 0 && confirm('Delete ' + ids.length + ' tasks?')) {
                $.ajax({
                    url: '{{ route("tasks.delete.multiple") }}',
                    type: 'DELETE',
                    data: {
                        ids: ids,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        });

        // Individual delete confirmation
        $('.delete-form').submit(function(e) {
            if (!confirm('Are you sure?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush