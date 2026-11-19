@csrf

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" id="title" name="title"
           value="{{ old('title', $ticket->title) }}"
           class="form-control @error('title') is-invalid @enderror">
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea id="description" name="description" rows="4"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $ticket->description) }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="priority" class="form-label">Priority</label>
        <select id="priority" name="priority" class="form-select @error('priority') is-invalid @enderror">
            @foreach ($priorities as $p)
                <option value="{{ $p }}" @selected(old('priority', $ticket->priority) === $p)>{{ ucfirst($p) }}</option>
            @endforeach
        </select>
        @error('priority')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
            @foreach ($statuses as $s)
                <option value="{{ $s }}" @selected(old('status', $ticket->status) === $s)>
                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                </option>
            @endforeach
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<button type="submit" class="btn btn-primary">Save</button>
<a href="{{ route('tickets.index') }}" class="btn btn-link">Cancel</a>
