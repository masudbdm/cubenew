@extends('admin.layouts.adminMaster')

@section('content')

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h5>Edit Location</h5>
</div>

<div class="card-body">

<form method="POST"
action="{{ route('admin.location.update',$location->id) }}">

@csrf

<div class="form-group">
<label>Title</label>

<input type="text"
name="title"
value="{{ $location->title }}"
class="form-control" required>

</div>

<div class="form-group">
<label>Description</label>

<textarea name="description"
class="form-control">
{{ $location->description }}
</textarea>
</div>

<button class="btn btn-primary">
Update Location
</button>

</form>

</div>
</div>

</div>

@endsection