@extends('admin.layouts.adminMaster')

@section('content')

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h5>Create Location</h5>
</div>

<div class="card-body">

<form method="POST"
action="{{ route('admin.location.store') }}">

@csrf

<div class="form-group">
<label>Title</label>
<input type="text"
name="title"
value="{{ old('title') }}"
class="form-control @error('title') is-invalid @enderror">
</div>

<div class="form-group mt-3">
<label>Description</label>
<textarea name="description"
class="form-control">{{ old('description') }}</textarea>
</div>

<button class="btn btn-success mt-3">
Save Location
</button>

</form>

</div>
</div>

</div>

@endsection