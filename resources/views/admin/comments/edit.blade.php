@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">Edit Comment</div>
    <div class="card-body">
        <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="content" class="form-label">Comment</label>
                <textarea name="content" id="content" class="form-control" rows="3">{{ $comment->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Comment</button>
        </form>
    </div>
</div>

@endsection