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
        <h4>Add Budgets</h4>
        <div class="float-right">
            <a href="{{ url('budgets') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-budgets') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
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
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off">
                </div>

                <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="frequency" class="form-label">Frequency</label>
                <select class="form-control" name="frequency" id="frequency">
                    <option value="">Select Frequency</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
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
    flatpickr("#start_date", {
        dateFormat: "Y-m-d", // MySQL format
    });

    flatpickr("#end_date", {
        dateFormat: "Y-m-d", // MySQL format
    });
</script>

@endsection
