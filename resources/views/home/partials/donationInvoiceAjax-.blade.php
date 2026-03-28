@push('css')
<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }
    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .no-print {
        display: none !important;
    }
}
</style>
@endpush

@php
    $statusMap = [
        'pending'   => ['label' => 'Pending',   'class' => 'badge bg-warning'],
        'confirmed' => ['label' => 'Confirmed', 'class' => 'badge bg-info'],
        'delivered' => ['label' => 'Delivered', 'class' => 'badge bg-success'],
        'rejected'  => ['label' => 'Rejected',  'class' => 'badge bg-danger'],
    ];
@endphp

<div id="printArea" class="card shadow border-0 p-4">

    {{-- INVOICE HEADER --}}
    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
        <div class="d-flex align-items-center">
            <img src="{{ asset($websiteParameter->logo()) }}"
                 alt="Logo"
                 style="height:60px" class="me-3">

            <div>
                <h5 class="mb-0">{{ $websiteParameter->h1 }}</h5>
                <small class="text-muted">
                    📧 {{ $websiteParameter->contact_email }}
                </small><br>
                <strong class="text-primary fs-6">
                    📞 {{ $websiteParameter->contact_mobile }}
                </strong>
            </div>
        </div>

        <div class="text-end">
            <small class="text-muted">Tracking No</small>
            <h6 class="mb-0">{{ $donation->tracking_number }}</h6>
        </div>
    </div>

    {{-- INVOICE BODY --}}
    <table class="table table-bordered">
        <tr>
            <th width="30%">Donor Name</th>
            <td>{{ $donation->name }}</td>
        </tr>
        <tr>
            <th>Mobile</th>
            <td>{{ $donation->mobile }}</td>
        </tr>
      
        <tr>
            <th>Status</th>
            <td>
                <span class="{{ $statusMap[$donation->status]['class'] }}">
                    {{ ucfirst($donation->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Requested At</th>
            <td>{{ \Carbon\Carbon::parse($donation->created_at)->format('d M Y, h:i A') }}</td>
        </tr>
    </table>

    {{-- ACTION --}}
    <div class="text-center mt-4 no-print">
        <button onclick="printInvoice()" class="btn btn-primary">
            🖨 Print Invoice
        </button>
    </div>
</div>

 