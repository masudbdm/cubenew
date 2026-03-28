<style>
  @media print {
  body * {
    visibility: hidden;
  }
  .print-area, .print-area * {
    visibility: visible;
  }
  .print-area {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
  }
}

</style>

@php
    $statusMap = [
        'pending'   => ['label' => 'Pending',   'class' => 'badge bg-warning'],
        'confirmed' => ['label' => 'Confirmed', 'class' => 'badge bg-info'],
        'delivered' => ['label' => 'Delivered', 'class' => 'badge bg-success'],
        'rejected'  => ['label' => 'Rejected',  'class' => 'badge bg-danger'],
    ];
@endphp

<div class="card shadow-lg mt-4 print-area"
     style="border:2px dashed #3f51b5">

  <div class="card-body">

    <div class="text-center mb-4">
      <h4 class="text-primary">Donation Request Invoice</h4>
      <small class="text-muted">
        Tracking No: <strong>{{ $donation->tracking_number }}</strong>
      </small>
    </div>

    <table class="table table-bordered">
      <tr>
        <th>Name</th>
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
        <th>Date</th>
        <td>{{ \Carbon\Carbon::parse($donation->date)->format('d M Y') }}</td>
      </tr>
    </table>

    <h6 class="mt-4">Submitted Documents</h6>
    <ul>
      @foreach($documents as $doc)
        <li>{{ $doc->document_type }}</li>
      @endforeach
    </ul>

    <div class="text-center mt-4">
      <button onclick="window.print()"
              class="btn btn-outline-primary">
        🖨️ Print Invoice
      </button>
    </div>

  </div>
</div>
