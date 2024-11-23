@extends('layouts.admin')
@section('content')
<div class="card">
<div class="card-header">
        <h4><b>Budgets</b></h4>
        <div class="float-right"> 
            <a href="{{ url('add-budgets') }}" class="btn btn-primary">Add Budgets</a> 
        </div>
       
    </div>
    <hr>
   
<div class="card-body">
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>User Name</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Description</th>
            <th>is_recurring</th>
            <th>Frequency</th>
            <th>Actions</th>           
        </tr>
    </thead>
    <tbody>
    @foreach($budgets as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->user->name}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->start_date}}</td>
        <td>{{$item->end_date}}</td>
        <td>{{$item->description}}</td>
        <td>{{ $item->is_recurring ? 'Yes' : 'No' }}</td>
        <td>{{$item->frequency}}</td>  
       <td>
            <a href="{{url('edit-budgets/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ url('show-budgets/'.$item->id) }}" class="btn btn-success btn-sm">Show</a>
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
                Are you sure you want to delete this Budgets ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ url('delete-budgets/'.$item->id) }}" class="btn btn-danger">Delete</a>
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