@extends('layouts.admin')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<div class="card">
    <div class="card-header">
        <h4>Edit Tasks</h4>
        <div class="float-right">
            <a href="{{ url('posts') }}" class="btn btn-primary">Back</a> 
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
    <form action="{{url('update-post/'.$post->id)}}" method="POST" >
        @method('PUT')
        @csrf
        <div class="row">
       
            <div class="col-md-12 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}">
            </div>
            <div class="col-md-12 mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="content" id="content" rows="3">{{ $post->content }}</textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control" name="post_date" id="post_date" value="{{ $post->post_date }}">
            </div>
            
           
            <div class="col-md-12">
             <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection