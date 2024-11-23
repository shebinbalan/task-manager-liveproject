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
    <form action="{{url('update-budgets/'.$budget->id)}}" method="POST" >
        @method('PUT')
        @csrf
        <div class="row">
       
        <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name"  value="{{ $budget->name }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $budget->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                          
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount"  value="{{ $budget->amount }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off"  value="{{ $budget->start_date }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off"  value="{{ $budget->end_date }}">
                </div>
                <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{$budget->description }}</textarea>
                </div>

               
                <div class="col-md-12 mb-3">
                    <label for="frequency" class="form-label">Frequency</label>
                    <select name="frequency" id="frequency" class="form-control">
                        <option value="daily" {{ $budget->frequency == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ $budget->frequency == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ $budget->frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ $budget->frequency == 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="is_recurring" class="form-label">Recurring?</label>
                    <input type="checkbox" name="is_recurring" id="is_recurring" value="1" {{ $budget->is_recurring ? 'checked' : '' }}>
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