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
        <h4>Add Expenses</h4>
        <div class="float-right">
            <a href="{{ url('expenses') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-expenses') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="expense_date" class="form-label">Expense Date</label>
                    <input type="text" class="form-control" id="expense_date" name="expense_date" autocomplete="off">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="expense_date" class="form-label">Recurrence type</label>
                    <select name="recurrence_type" id="recurrence_type" class="form-control">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                     </select>
                </div>
                <div class="col-md-12 mb-3">
                <label for="next_occurrence">Next Occurrence Date</label>
                <input type="date" name="next_occurrence" id="next_occurrence" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="is_recurring">Recurring?</label>
                    <input type="checkbox" name="is_recurring" id="is_recurring" value="1">
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
