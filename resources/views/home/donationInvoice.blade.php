@extends('home.layouts.pageMaster')
@push('meta')
<meta property="og:type" content="website">
@endpush
@section('content')

    <div class="container my-5" id="printArea">

  <div class="text-center mb-4">
    <h3 class="text-primary">Donation Request Invoice</h3>
    <p class="text-muted">Application ID: #{{ $donation->id }}</p>
  </div>

  <table class="table table-bordered">
    <tr><th>Name</th><td>{{ $donation->name }}</td></tr>
    <tr><th>Father Name</th><td>{{ $donation->father_name }}</td></tr>
    <tr><th>Email</th><td>{{ $donation->email }}</td></tr>
    <tr><th>Mobile</th><td>{{ $donation->mobile }}</td></tr>
    <tr><th>Purpose</th><td>{{ ucfirst($donation->purpose) }}</td></tr>
    <tr><th>NID</th><td>{{ $donation->nid }}</td></tr>
    <tr><th>Date</th><td>{{ $donation->date }}</td></tr>
  </table>

  <h5 class="mt-4">Submitted Documents</h5>
  <ul>
    @foreach($documents as $doc)
      <li>{{ $doc->document_type }}</li>
    @endforeach
  </ul>

</div>

<div class="text-center mt-4">
  <button onclick="printInvoice()" class="btn btn-primary">
    Print Invoice
  </button>
</div>
@endsection

@push('js')
<script>
function printInvoice() {
  window.print();
}
</script>
@endpush
