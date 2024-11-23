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
        <h4>Show Expenses</h4>
        <div class="float-right"> 
            <a href="{{ url('expenses') }}" class="btn btn-primary">Back</a> 
        </div>
    </div>
    <div class="card-body">
  
      
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $expense->title }}" readonly>  
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Amount</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $expense->amount }}" readonly>  
            </div>
            <div class="col-md-12 mb-3">
                <label for="due_date" class="form-label">Username</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $expense->user->name }}" readonly>  
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Categories</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $expense->category->name }}" readonly>  
            </div>
            <div class="col-md-12 mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $expense->expense_date }}" readonly>  
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Recurrence Type</label>
                <input type="" class="form-control" name="recurrence_type" id="recurrence_type" value="{{ $expense->recurrence_type }}" readonly>  
            </div>
            <div class="col-md-12 mb-3">
                <label for="due_date" class="form-label">Next Occurrence</label>
                <input type="" class="form-control" name="title" id="title" value="{{ $expense->next_occurrence }}" readonly>  
            </div>
            
          
        </div>
   
</div>
</div>

@endsection