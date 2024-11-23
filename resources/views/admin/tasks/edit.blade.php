@extends('layouts.admin')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div class="card">
    <div class="card-header">
        <h4>Edit Tasks</h4>
        <div class="float-right">
            <a href="{{ url('incomes') }}" class="btn btn-primary">Back</a> 
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card-body">
    <form action="{{url('update-tasks/'.$task->id)}}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
        <div class="row">
       
        <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title"  value="{{ $task->title }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="project_id" class="form-label">Project </label>
                    <select class="form-control" name="project_id" id="project_id">
                        <option value="">Select Project</option>
                        @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                          
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{$task->description }}</textarea>
                </div>

               

                <div class="col-md-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                    <label for="attachments" class="form-label">Add New Attachments</label>
                    <input type="file" class="form-control" name="attachments[]" multiple>
                    <small class="text-muted">Allowed files: Images, PDF, DOC, DOCX (Max: 2MB each)</small>
                </div>

                @if($task->attachments->count() > 0)
<div class="col-md-12 mb-3">
    <label class="form-label">Current Attachments</label>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($task->attachments as $attachment)
                <tr id="attachment-row-{{ $attachment->id }}">
                    <td>{{ $attachment->original_filename }}</td>
                    <td>{{ number_format($attachment->file_size / 1024, 2) }} KB</td>
                    <td>
                    <a href="{{ url('download-attachment/'.$attachment->id) }}" class="btn btn-sm btn-primary">Download</a>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeAttachment({{ $attachment->id }})">Remove</button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

            
           
            <div class="col-md-12">
             <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    flatpickr("#income_date", {
        dateFormat: "Y-m-d", // MySQL format
    });


    function removeAttachment(attachmentId) {
    // Confirm with the user before deleting
    if (confirm('Are you sure you want to remove this attachment?')) {
        // Send the AJAX request to remove the attachment
        $.ajax({
            url: '/tasks/remove-attachment/' + attachmentId,  // URL to delete attachment
            type: 'DELETE',  // DELETE method to remove the resource
            data: {
                _token: '{{ csrf_token() }}'  // CSRF token to ensure request is valid
            },
            success: function(response) {
                // Check if the response indicates success
                if (response.success) {
                    // If successful, remove the row from the DOM
                    $('#attachment-row-' + attachmentId).remove(); 
                    alert('Attachment removed successfully!');
                } else {
                    alert('Error removing attachment: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }
}
</script>

@endsection