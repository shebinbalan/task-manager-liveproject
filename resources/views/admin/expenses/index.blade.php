@extends('layouts.admin')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div class="card">

<div class="row">
                <div class="col-md-6 ">
                <form action="{{ route('expense_report.monthly') }}" method="GET">
    <label for="month">Select Month:</label>
    <input type="month" name="month" id="month" class="form-control" required>
    <button type="submit" class="btn btn-primary mt-2">PDF</button>
</form>
                </div>
               
                <div class="col-md-6">
                <form action="{{ route('expense_report.yearly') }}" method="GET">
                    <label for="year">Select Year:</label>
                    <input type="number" name="year" id="year" class="form-control" min="2000" max="{{ now()->format('Y') }}" required>
                    <button type="submit" class="btn btn-success mt-2">Excel</button>
                </form>
                </div>
               
            </div>



<div class="card-header">
        <h4>Filter Expenses by Date</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('expenses') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="text" id="from_date" name="from_date" class="form-control" value="{{ $fromDate ?? '' }}" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="text" id="to_date" name="to_date" class="form-control" value="{{ $toDate ?? '' }}" autocomplete="off">
                </div>
                <div class="col-md-4 align-self-end float-right">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card-header">
    <h4><b>Expenses</b></h4>
    <div class="float-right"> 
        <a href="{{ url('add-expenses') }}" class="btn btn-primary">Add Expenses</a>       
    </div>
  <div>
  <br> 
<div class="card-body">
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Category</th>
            <th>Amount</th>
            <th>User</th>  
            <th>Date</th> 
            <th>Recurrence Type </th>
            <th>Recurring </th>
            <th>Next Occurrence</th>
            <th>Actions</th>           
        </tr>
    </thead>
    <tbody>
    @foreach($expenses as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->title}}</td>
        <td>{{$item->category->name}}</td>
        <td>{{$item->amount}}</td>
        <td>{{$item->user->name}}</td>
        <td>{{$item->expense_date}}</td>
        <td>{{$item->recurrence_type}}</td>
        <td>{{ $item->is_recurring ? 'Yes' : 'No' }}</td>
        <td>{{ $item->next_occurrence ?? 'N/A' }}</td>
        
       
       <td>
            <a href="{{url('edit-expenses/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ url('show-expenses/'.$item->id) }}" class="btn btn-success btn-sm">Show</a>
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
                Are you sure you want to delete this Expenses ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ url('delete-expenses/'.$item->id) }}" class="btn btn-danger">Delete</a>
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
</div>
@endsection
<script>
    flatpickr("#from_date, #to_date", {
        dateFormat: "Y-m-d", // MySQL format
    });
</script>
