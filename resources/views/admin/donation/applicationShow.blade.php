@extends('admin.layouts.adminMaster')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Donation Application Details</h3>


            <button class="btn btn-sm btn-info" onclick="printApplication()">Print</button>

            @if($application->status == 'approved')
<a title="Payments" data-toggle="tooltip" href="{{ route('admin.donation.paymentsforapplication',$application->id) }}"
class="btn btn-success btn-sm">
<i class="fas fa-money-bill"></i> Payments
</a>

@endif
        </div>
        <div class="card-body" id="printable-area">

            {{-- Basic Info --}}
            <table class="table table-bordered">
                <tr>
                    <th>Purpose</th>
                    <td>{{ $application->purpose }}</td>
                </tr>
                <tr>
                    <th>Post</th>
                    <td>{{ $application->post ? $application->post->title : null }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $application->name }}</td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td>{{ $application->father_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $application->email }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $application->mobile }}</td>
                </tr>
                <tr>
                    <th>Present Address</th>
                    <td>{{ $application->present_address }}</td>
                </tr>
                <tr>
                    <th>Permanent Address</th>
                    <td>{{ $application->permanent_address }}</td>
                </tr>
                <tr>
                    <th>NID</th>
                    <td>{{ $application->nid }}</td>
                </tr>
                <tr>
                    <th>Details</th>
                    <td>{{ $application->details }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($application->status) }}</td>
                </tr>
                <tr>
                    <th>Tracking Number</th>
                    <td>{{ $application->tracking_number }}</td>
                </tr>
                <tr>
                    <th>Submitted At</th>
                    <td>{{ $application->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>

            {{-- NID Picture --}}
            @if($application->nid_pic)
                <h5>NID Picture:</h5>
                <div class="mb-3">
                    @if(str_ends_with($application->nid_pic, '.pdf'))
                        <a href="{{ asset('storage/'.$application->nid_pic) }}" target="_blank" class="btn btn-sm btn-primary">View PDF</a>
                    @else
                        <img src="{{ asset('storage/'.$application->nid_pic) }}" class="img-thumbnail" style="max-width:200px;">
                    @endif
                </div>
            @endif

            {{-- Documents --}}
            @if($documents->count() > 0)
                <h5>Documents:</h5>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($documents as $doc)
                        <div class="card" style="width: 120px;">
                            @if(str_ends_with($doc->file_name, '.pdf'))
                                <div class="card-body text-center">
                                    <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                    <p class="small text-truncate">{{ $doc->document_type }}</p>
                                    <a href="{{ asset('storage/'.$doc->file_name) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                </div>
                            @else
                                <img src="{{ asset('storage/'.$doc->file_name) }}" class="card-img-top" alt="{{ $doc->document_type }}">
                                <div class="card-body text-center">
                                    <p class="small text-truncate">{{ $doc->document_type }}</p>
                                    <a href="{{ asset('storage/'.$doc->file_name) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <a href="{{ route('admin.donation.application.all') }}" class="btn btn-secondary mt-3">Back to All Applications</a>

        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function printApplication() {
    let printContents = document.getElementById('printable-area').innerHTML;

    // নতুন উইন্ডো খুলে কন্টেন্ট যোগ করা
    let printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print Donation Application</title>');
    // মূল CSS ফাইলগুলো লিঙ্ক করা
    let styles = document.querySelectorAll('link[rel="stylesheet"], style');
    styles.forEach(style => {
        printWindow.document.write(style.outerHTML);
    });
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();

    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };
}

</script>
@endpush
