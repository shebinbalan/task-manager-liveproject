@extends('layouts.admin')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-header">
        <h4>Show Tasks</h4>
        <div class="float-right"> 
            <a href="{{ url('tasks') }}" class="btn btn-primary">Back</a> 
        </div>
    </div>
    <div class="card-body">
    <h4>Task Time Tracking</h4>

<!-- Display total time spent on the task -->
<p>Total Time Spent: {{ $task->timeLogs->sum('total_time') }} seconds</p>

<!-- Display time logs -->
<table class="table">
    <thead>
        <tr>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Total Time (Seconds)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($task->timeLogs as $timeLog)
            <tr>
                <td>{{ $timeLog->start_time }}</td>
                <td>{{ $timeLog->end_time }}</td>
                <td>{{ $timeLog->total_time }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('tasks.startTimer', $task->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Start Timer</button>
</form>

<!-- Stop Timer Button -->
<form action="{{ route('tasks.stopTimer', $task->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Stop Timer</button>
</form>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $task->title }}" readonly>  
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $task->description }}" readonly>  
            </div>
           
           
            <div class="col-md-12 mb-3">
                <label for="due_date" class="form-label">Project Name</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $task->project->name }}" readonly>  
            </div>
           
            <div class="col-md-12 mb-3">
                <label for="due_date" class="form-label">Status</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $task->status }}" readonly>  
            </div>
            
          
        </div>
   
</div>
</div>
<div class="task-comments">
    <h3>Comments</h3>
    @foreach($task->comments as $comment)
        <div class="comment">
            <strong>{{ $comment->user->name }}:</strong>
            <p>{{ $comment->content }}</p>
           
            @can('update', $comment)
                <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-success btn-sm">Edit</a>
            @endcan
            @can('delete', $comment)
                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            @endcan
        </div>
    @endforeach

    @auth
    <form action="{{ route('admin.comments.store', $task->id) }}" method="POST">
    @csrf
    <textarea name="content" rows="3" placeholder="Add your comment..." required></textarea>
    <button type="submit">Add Comment</button>
</form>
    @endauth

    @guest
    <p>You must be logged in to add comments.</p>
    @endguest
</div>


@endsection