@extends('layouts.app')

@section('title', 'Tags')

@section('content')
<div class="page-heading">
    <h1>Tags</h1>
    <a href="{{ route('tags.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Tag</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Tasks</th>
                        <th width="170">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>{{ $tag->tasks_count }}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('tags.show', $tag) }}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('tags.edit', $tag) }}"><i class="fas fa-edit"></i></a>
                            <form class="d-inline" method="POST" action="{{ route('tags.destroy', $tag) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Delete this tag?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center">No tags found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $tags->links() }}
    </div>
</div>
@endsection
