@extends('layouts.admin')
@section('content')
<div class="card">
<div class="card-header">
        <h4><b>Tasks</b></h4>
        <div class="float-right"> 
            <a href="{{ url('add-tasks') }}" class="btn btn-primary">Add Tasks</a> 
        </div>
        <a href="{{ route('admin.tasks.exportReport') }}" class="btn btn-success">Export Task Report</a>
    </div>
    <hr>
   
<div class="card-body">
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Project</th>
            <th>Description</th>  
            <th>Status</th>          
            <th>Actions</th>           
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $item)
    <tr>
    <td>{{$item->id}}</td>
        <td>{{$item->title}}</td>
        <td>{{$item->project->name}}</td> 
        <td>{{$item->description}}</td> 
        <td>{{$item->status}}</td> 
        <td>
            <a href="{{url('edit-tasks/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ url('show-tasks/'.$item->id) }}" class="btn btn-success btn-sm">Show</a>
            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal{{ $item->id }}">Delete</a>
            <div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this tasks ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ url('delete-tasks/'.$item->id) }}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
        </td>
    </tr>
@endforeach
    </tbody>
  </table>
</div>
@endsection