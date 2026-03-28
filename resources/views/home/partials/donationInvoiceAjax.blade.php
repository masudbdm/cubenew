{{-- PRINT BUTTON (SCREEN ONLY) --}}
<div class="text-center mt-4 no-print">
  <button onclick="printInvoice()"
          class="btn btn-outline-primary px-4">
    🖨️ Print Invoice
  </button>
</div>


@php
$statusMap = [
    'pending'   => ['label' => 'Pending',   'class' => 'bg-warning text-dark'],
    'approved' => ['label' => 'Approved', 'class' => 'bg-info text-white'],
    'delivered' => ['label' => 'Delivered', 'class' => 'bg-success text-white'],
    'rejected'  => ['label' => 'Rejected',  'class' => 'bg-danger text-white'],
];

$status = $statusMap[$donation->status] ?? [
    'label' => ucfirst($donation->status ?? 'Unknown'),
    'class' => 'bg-secondary text-white'
];
@endphp


{{-- ================= PRINT AREA ================= --}}
<div class="card mt-4 print-area"
     style="border:2px dashed {{ $websiteParameter->primary_color }};">

  <div class="card-body">

    {{-- HEADER --}}
    <div class="row align-items-center mb-4 border-bottom pb-3">
      <div class="col-3 text-start">
        <img src="{{ asset($websiteParameter->logo()) }}"
             alt="Logo"
             style="max-height:60px;">
      </div>

      <div class="col-6 text-center">
        <h4 class="mb-0 text-primary">
          {{ $websiteParameter->h1 }}
        </h4>
        <small class="text-muted">
          Donation Request Invoice
        </small>
      </div>

      <div class="col-3 text-end">
        <span class="badge {{ $status['class'] }} px-3 py-2">
          {{ $status['label'] }}
        </span>
      </div>
    </div>

    {{-- CONTACT INFO --}}
    <div class="row text-center mb-4">
      <div class="col-md-4">
        📞 <strong class="text-primary">
          {{ $websiteParameter->contact_mobile }}
        </strong>
      </div>
      <div class="col-md-4">
        ✉️ {{ $websiteParameter->contact_email }}
      </div>
      <div class="col-md-4">
        🌐 {{ request()->getHost() }}
      </div>
    </div>

    {{-- TRACKING --}}
    <div class="text-center mb-4">
      <span class="badge bg-light text-dark border px-4 py-2">
        Tracking No:
        <strong>{{ $donation->tracking_number }}</strong>
      </span>
    </div>

    {{-- DONATION INFO --}}
    <table class="table table-bordered align-middle mb-4">
      <tr>
        <th width="35%">Name</th>
        <td>{{ $donation->name }}</td>
      </tr>
      <tr>
        <th>Mobile</th>
        <td>{{ $donation->mobile }}</td>
      </tr>
      <tr>
        <th>NID</th>
        <td>{{ $donation->nid }}</td>
      </tr>
      <tr>
        <th>Purpose</th>
        <td>{{ ucfirst($donation->purpose) }}</td>
      </tr>
      <tr>
        <th>Submitted Date</th>
        <td>
          {{ \Carbon\Carbon::parse($donation->date)->format('d M Y') }}
        </td>
      </tr>
    </table>

    {{-- DOCUMENTS --}}
    @if($documents->count())
      <h6 class="mb-2">Submitted Documents</h6>
      <ul class="mb-4">
        @foreach($documents as $doc)
          <li>{{ ucfirst($doc->document_type) }}</li>
        @endforeach
      </ul>
    @endif

    {{-- FOOTER --}}
    <div class="text-center pt-3 border-top">
      <small class="text-muted">
        This is a system generated invoice. No signature required.
      </small>
    </div>

  </div>
</div>
{{-- ================= /PRINT AREA ================= --}}


{{-- PRINT BUTTON (SCREEN ONLY) --}}
<div class="text-center mt-4 no-print">
  <button onclick="printInvoice()"
          class="btn btn-outline-primary px-4">
    🖨️ Print Invoice
  </button>
</div>
