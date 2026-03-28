@extends('admin.layouts.adminMaster')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
            <h4 class="mb-0 font-weight-bold text-dark">
                <i class="fas fa-money-check-alt text-primary mr-2"></i>
                Payment List
                <small class="text-muted">
                    (Tracking: {{ $application->tracking_number ?? '' }})
                </small>
            </h4>

            <div>
                <span class="badge badge-success p-2 mr-2">
                    Total Paid: {{ number_format($application->payments->sum('amount'),2) }} TK
                </span>

                <a href="#" data-toggle="modal" data-target="#paymentCreateModal"
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Add Payment
                </a>
            </div>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="bg-light">
                        <tr class="text-muted text-uppercase small">
                            <th style="width:60px;">#</th>
                            <th>Amount (TK)</th>
                            <th>Note</th>
                            <th style="width:150px;">Date</th>
                            <th style="width:120px;">Document</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($payments as $payment)

                        <tr>

                            <td class="text-muted">
                                {{ $loop->iteration + ($payments->firstItem() - 1) }}
                            </td>

                            <td>
                                <span class="font-weight-bold text-success">
                                    {{ number_format($payment->amount,2) }} TK
                                </span>
                            </td>

                            <td>
                                @if($payment->purpose)
                                    {{ $payment->purpose }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            <td class="text-muted">
                                {{ optional($payment->created_at)->format('d M Y') }}
                            </td>

                            <td>
                                @if($payment->document)
                                    <a title="Document" data-toggle="tooltip" href="{{ asset('storage/'.$payment->document) }}"
                                       target="_blank"
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                No payments found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>
            </div>

        </div>

        @if($payments->hasPages())
        <div class="card-footer bg-white">
            {{ $payments->links() }}
        </div>
        @endif

    </div>
</div>

<!-- Payment Create Modal -->
<div class="modal fade" id="paymentCreateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form enctype="multipart/form-data" action="{{ route('admin.donation.payment.store') }}" method="POST">
                @csrf

                <input type="hidden" name="donation_application_id"
                       value="{{ $application->id }}">

                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Amount (TK)</label>
                        <input type="number" step="0.01"
                               name="amount"
                               class="form-control" required>
                    </div>

                     
                    <div class="form-group">
                        <label>Note (if any)</label>
                        <input type="text"
                               name="purpose"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Payment Document / Slip (Optional)</label>
                        <input type="file"
                               name="document"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.pdf">
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input type="date"
                               name="date"
                               class="form-control"
                               value="{{ date('Y-m-d') }}">
                    </div>

                </div>

                <div class="modal-footer">
                    <small class="text-danger">Payment Transaction cannot be modified</small>
                    <button class="btn btn-success">Save Payment</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: `
                <ul style="text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#d33'
        });

        // Modal reopen after validation error
        $('#paymentCreateModal').modal('show');
    @endif


    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            timer: 2500,
            showConfirmButton: false
        });
    @endif


    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33'
        });
    @endif

});
</script>

<script>
$('.delete-form').on('submit', function(e){
    e.preventDefault();
    let form = this;

    Swal.fire({
        title: 'Are you sure?',
        text: "This cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>
@endpush