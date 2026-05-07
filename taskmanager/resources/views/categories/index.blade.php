@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="page-heading">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Tasks</th>
                        <th width="170">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?: 'No description' }}</td>
                        <td>{{ $category->tasks_count }}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('categories.show', $category) }}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('categories.edit', $category) }}"><i class="fas fa-edit"></i></a>
                            <form class="d-inline" method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Delete this category?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
    </div>
</div>
@endsection
