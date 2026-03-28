@extends('admin.layouts.adminMaster')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Edit Donation Application  
                @if($application->status == 'approved')
<a title="Payments" data-toggle="tooltip" href="{{ route('admin.donation.paymentsforapplication',$application->id) }}"
class="btn btn-success btn-sm">
<i class="fas fa-money-bill"></i> Payments
</a>

@endif </h3>

     
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.donation.application.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $application->name) }}" required>
                </div>

                {{-- Father Name --}}
                <div class="mb-3">
                    <label class="form-label">Father Name</label>
                    <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $application->father_name) }}">
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $application->email) }}">
                </div>

                {{-- Mobile --}}
                <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile', ltrim($application->mobile, '+88')) }}">
                </div>

                {{-- Addresses --}}
                <div class="mb-3">
                    <label class="form-label">Present Address</label>
                    <input type="text" name="present_address" class="form-control" value="{{ old('present_address', $application->present_address) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Permanent Address</label>
                    <input type="text" name="permanent_address" class="form-control" value="{{ old('permanent_address', $application->permanent_address) }}">
                </div>

                {{-- NID --}}
                <div class="mb-3">
                    <label class="form-label">NID</label>
                    <input type="text" name="nid" class="form-control" value="{{ old('nid', $application->nid) }}">
                </div>

                {{-- NID Picture --}}
                <div class="mb-3">
                    <label class="form-label">NID Picture</label>
                    @if($application->nid_pic)
                        <div class="card mb-2" style="width: 150px;">
                            @if(str_ends_with($application->nid_pic, '.pdf'))
                                <div class="card-body text-center">
                                    <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                    <p class="small text-truncate">NID PDF</p>
                                    <a href="{{ asset('storage/'.$application->nid_pic) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                </div>
                            @else
                                <img src="{{ asset('storage/'.$application->nid_pic) }}" class="card-img-top" alt="NID Picture">
                                <div class="card-body text-center">
                                    <a href="{{ asset('storage/'.$application->nid_pic) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                </div>
                            @endif
                        </div>
                    @endif
                    <input type="file" name="nid_pic" class="form-control" accept="image/*,application/pdf">
                    <small class="text-muted">Leave blank to keep existing file</small>
                </div>

                {{-- Purpose --}}
                <div class="mb-3">
                    <label class="form-label">Purpose</label>
                    <input type="text" name="purpose" class="form-control" value="{{ old('purpose', $application->purpose) }}">
                </div>

                {{-- Details --}}
                <div class="mb-3">
                    <label class="form-label">Details</label>
                    <textarea name="details" class="form-control" rows="4">{{ old('details', $application->details) }}</textarea>
                </div>

                {{-- Status --}}
               
<div class="mb-3">
    <label class="form-label d-block">Status</label>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status_pending" value="pending" {{ old('status', $application->status) == 'pending' ? 'checked' : '' }}>
        <label class="form-check-label" for="status_pending">Pending</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status_approved" value="approved" {{ old('status', $application->status) == 'approved' ? 'checked' : '' }}>
        <label class="form-check-label" for="status_approved">Approved</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status_delivered" value="delivered" {{ old('status', $application->status) == 'delivered' ? 'checked' : '' }}>
        <label class="form-check-label" for="status_delivered">Delivered</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status_rejected" value="rejected" {{ old('status', $application->status) == 'rejected' ? 'checked' : '' }}>
        <label class="form-check-label" for="status_rejected">Rejected</label>
    </div>
</div>


                {{-- Existing Documents --}}
                <div class="mb-3">
                    <label class="form-label">Documents</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($documents as $doc)
<div class="card ml-2" style="width: 120px;" id="doc-{{ $doc->id }}">
    @if(str_ends_with($doc->file_name, '.pdf'))
        <div class="card-body text-center">
            <i class="fas fa-file-pdf fa-2x text-danger"></i>
            <p class="small text-truncate">{{ $doc->document_type }}</p>
            <a href="{{ asset('storage/'.$doc->file_name) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
            <button type="button" class="btn btn-sm btn-danger mt-1 delete-document" data-id="{{ $doc->id }}">Delete</button>
        </div>
    @else
        <img src="{{ asset('storage/'.$doc->file_name) }}" class="card-img-top" alt="{{ $doc->document_type }}">
        <div class="card-body text-center">
            <p class="small text-truncate">{{ $doc->document_type }}</p>
            <a href="{{ asset('storage/'.$doc->file_name) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
            <a href="{{ route('admin.donation.document.delete',$doc->id) }}" class="btn btn-sm btn-danger mt-1 ">Delete</a>
        </div>
    @endif
</div>
@endforeach
                    </div>

                    {{-- Upload new documents --}}
                    <div id="document-container" class="mt-2">
                        <div class="mb-2">
                            <input type="text" name="document_type[]" class="form-control mb-1" placeholder="Document Type">
                            <input type="file" name="document_file[]" class="form-control" accept="image/*,application/pdf">
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary mt-1" id="add-document">Add Another Document</button>
                </div>

                <button type="submit" class="btn btn-primary">Update Application</button>
                <a href="{{ route('admin.donation.application.all') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.getElementById('add-document').addEventListener('click', function() {
        let container = document.getElementById('document-container');
        let div = document.createElement('div');
        div.classList.add('mb-2');
        div.innerHTML = `
            <input type="text" name="document_type[]" class="form-control mb-1" placeholder="Document Type">
            <input type="file" name="document_file[]" class="form-control" accept="image/*,application/pdf">
        `;
        container.appendChild(div);
    });
</script>
 

@endpush
