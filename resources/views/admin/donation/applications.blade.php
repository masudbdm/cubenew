@extends('admin.layouts.adminMaster')

@section('content')
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>
                {{ $post->title }} - 
                {{ $status ? ucfirst($status) : 'All' }} Applications
            </h3>
            <button class="btn btn-sm btn-primary" onclick="window.print()">Print List</button>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="applications-table" style="white-space: nowrap;">
                <thead class="thead-light">
                    <tr>
                        <th>#ID</th>
                        <th class="no-print">Action</th>
                        <th>Tracking</th>
                        <th>Paid</th>
                        <th>Mobile</th>
                        <th>Name</th>
                        <th class="no-print">Father Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td>{{ $app->id }}</td>
                        <td class="no-print">
                            <a href="{{ route('admin.donation.application.show', $app->id) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('admin.donation.application.edit', $app->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            @if($app->status == 'approved')
<a title="Payments" data-toggle="tooltip" href="{{ route('admin.donation.paymentsforapplication',$app->id) }}"
class="btn btn-success btn-sm">
<i class="fas fa-money-bill"></i>
</a>

@endif

                        </td>
                        <td>{{ $app->tracking_number }}</td>
                        <td>
<span class="badge badge-success p-2">
{{ number_format($app->payments->sum('amount'),2) }}
</span>
</td>
                        <td>{{ $app->mobile }}</td>
                        <td>{{ $app->name }}</td>
                        <td class="no-print">{{ $app->father_name }}</td>
                        <td>{{ $app->email }}</td>
                        <td>{{ ucfirst($app->status) }}</td>
                        <td>{{ $app->created_at->format('d M Y, h:i A') }}</td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No applications found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('admin.allPost') }}" class="btn btn-secondary mt-3">Back to Posts</a>
</div>
@endsection

@push('css')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #applications-table, #applications-table * {
            visibility: visible;
        }
        #applications-table {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>
@endpush
