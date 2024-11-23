@extends('layouts.admin')
@section('content')
<!-- Bootstrap and jQuery -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
        <h4>Add Tasks</h4>
        <div class="float-right">
            <a href="{{ url('tasks') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-tasks') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="project_id" class="form-label">Category</label>
                    <select class="form-control" name="project_id" id="project_id">
                        <option value="">Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                
               
                
                <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>

            <div class="col-md-12 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                     </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="attachments" class="form-label">Attachments</label>
                    <input type="file" class="form-control" name="attachments[]" multiple>
                    <small class="text-muted">Allowed files: Images, PDF, DOC, DOCX (Max: 2MB each)</small>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


   <script>
    flatpickr("#income_date", {
        dateFormat: "Y-m-d", // MySQL format
    });
</script>

@endsection
