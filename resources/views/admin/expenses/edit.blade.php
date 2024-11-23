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
        <h4>Edit Expenses</h4>
        <div class="float-right">
            <a href="{{ url('expenses') }}" class="btn btn-primary">Back</a> 
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
    <form action="{{url('update-expenses/'.$expense->id)}}" method="POST" >
        @method('PUT')
        @csrf
        <div class="row">
       
        <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title"  value="{{ $expense->title }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                          
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount"  value="{{ $expense->amount }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="expense_date" class="form-label">Expense Date</label>
                    <input type="text" class="form-control" id="expense_date" name="expense_date" autocomplete="off"  value="{{ $expense->expense_date }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="expense_date" class="form-label">Expense Date</label>
                    <select name="recurrence_type" id="recurrence_type" class="form-control">
                        <option value="daily" {{ $expense->recurrence_type == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ $expense->recurrence_type == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ $expense->recurrence_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="next_occurrence" class="form-label">Next Occurrence Date</label>
                    <input type="date" name="next_occurrence" id="next_occurrence" class="form-control" value="{{ $expense->next_occurrence }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="is_recurring" class="form-label">Recurring?</label>
                    <input type="checkbox" name="is_recurring" id="is_recurring" value="1" {{ $expense->is_recurring ? 'checked' : '' }}>
                </div>
                        
            <div class="col-md-12">
             <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>

<script>
    flatpickr("#expense_date", {
        dateFormat: "Y-m-d", // MySQL format
    });
</script>
@endsection