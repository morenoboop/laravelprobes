@extends('layouts.app')

@section('content')
<h2>Edit course</h2>
<form action="{{ route('courses.update', $course) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $course->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <input type="description" name="description" value="{{ $course->description }}" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection