@extends('admin.layouts.adminMaster')

@section('content')

<div class="container-fluid">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
    <h5 class="mb-0">
        Donation Applications
    </h5>
</div>

<div class="card-body">

@include('alerts.alerts')

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<thead class="thead-dark">
<tr>
    <th>#</th>
    <th>Tracking</th>
    <th width="180">Action</th>
    <th>Paid (TK)</th>
    <th>Status</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Purpose</th>
    <th>Date</th>
</tr>
</thead>

<tbody>

@forelse($applications as $app)

<tr>

<td>
{{ $loop->iteration + ($applications->firstItem() - 1) }}
</td>

<td>
<span class="badge badge-info">
{{ $app->tracking_number }}
</span>
</td>

<td class="text-nowrap">

<a  title="View" data-toggle="tooltip"  href="{{ route('admin.donation.application.show',$app->id) }}"
class="btn btn-info btn-sm">
<i class="fas fa-eye"></i>
</a>

@if($app->status == 'approved')
<a title="Payments" data-toggle="tooltip" href="{{ route('admin.donation.paymentsforapplication',$app->id) }}"
class="btn btn-success btn-sm">
<i class="fas fa-money-bill"></i>
</a>

@endif

<a  title="Edit" data-toggle="tooltip"  href="{{ route('admin.donation.application.edit',$app->id) }}"
class="btn btn-primary btn-sm">
<i class="fas fa-edit"></i>
</a>

<form action="{{ route('admin.donation.application.delete',$app->id) }}"
method="POST"
style="display:inline"
onsubmit="return confirm('Delete application?')">

@csrf
@method('DELETE')

<button  title="Delete" data-toggle="tooltip"  class="btn btn-danger btn-sm">
<i class="fas fa-trash"></i>
</button>

</form>

</td>

<td>
<span class="badge badge-success p-2">
{{ number_format($app->payments->sum('amount'),2) }}
</span>
</td>

<td>
@if($app->status == 'pending')
<span class="badge badge-warning">Pending</span>

@elseif($app->status == 'approved')
<span class="badge badge-success">Approved</span>

@elseif($app->status == 'rejected')
<span class="badge badge-danger">Rejected</span>

@else
<span class="badge badge-secondary">
{{ ucfirst($app->status) }}
</span>
@endif
</td>

<td>
<strong>{{ $app->name }}</strong><br>
<small class="text-muted">{{ $app->father_name }}</small>
</td>

<td>{{ $app->mobile }}</td>

<td>
{{ str_replace('|',' > ',$app->purpose) }}
</td>

<td>
{{ \Carbon\Carbon::parse($app->date)->format('d M Y') }}
</td>







</tr>

@empty

<tr>
<td colspan="9" class="text-center text-muted">
No applications found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-3">
{{ $applications->links() }}
</div>

</div>
</div>
</div>

@endsection