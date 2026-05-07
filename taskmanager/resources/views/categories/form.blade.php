<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if($method !== 'POST')
                    @method($method)
                    @endif

                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" value="{{ old('name', $category?->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $category?->description) }}</textarea>
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                    <a class="btn btn-secondary" href="{{ route('categories.index') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
