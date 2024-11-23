@extends('layouts.admin')
@section('content')
<div class="card">
<div class="card-header">
        <h4><b>Comments</b></h4>
        <div class="float-right"> 
            <a href="{{ url('add-comment') }}" class="btn btn-primary">Add Comments</a> 
        </div>
       
    </div>
    <hr>
   
<div class="card-body">
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>User Name</th>
            <th>Posts</th>
            <th>Content</th>
            <th>Actions</th>           
        </tr>
    </thead>
    <tbody>
    @foreach($comments as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->user->name}}</td>
        <td>{{$item->post->title}}</td>
        <td>{{$item->content}}</td>
       
       
       
       <td>
            <a href="{{url('edit-comment/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ url('show-comment/'.$item->id) }}" class="btn btn-success btn-sm">Show</a>
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
                Are you sure you want to delete this Task ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ url('delete-comment/'.$item->id) }}" class="btn btn-danger">Delete</a>
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