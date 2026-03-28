@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush
@push('css')
<style>
.donate-card {
  border-radius: 18px;
  background: linear-gradient(
    180deg,
    #ffffff 0%,
    #f8f9ff 100%
  );
}

.donate-card .btn-primary {
  padding: 14px;
  font-size: 18px;
  border-radius: 10px;
}

.donate-card input {
  font-size: 22px;
}

@media (max-width: 767px) {
  .donate-card .card-body {
    padding: 2.5rem 1.5rem;
  }
}

.amount-field .form-control,
.amount-field .input-group-text {
  border: 2px solid #dee2e6;
}

.amount-field .form-control:focus {
  border-color: {{ $websiteParameter->primary_color }};
  box-shadow: 0 0 0 0.15rem rgba(13,110,253,.15);
}

.amount-label {
  font-size: 1.1rem;
  font-weight: 600;
}

.amount-input {
  font-size: 1.5rem;
  padding: 14px 16px;
}


</style>
@endpush


@section('content')

<div class="container my-4">

  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">

      <div class="card donate-card shadow-lg border">
  <div class="card-body px-3 py-2 text-center">

    <div class="mb-3">
      <i class="material-icons text-primary" style="font-size:48px;">
        volunteer_activism
      </i>
    </div>

    <h3 class="fw-bold mb-2">
      মানবতার পাশে দাঁড়ান
    </h3>

    <p class="text-muted mb-4">
      আপনার একটি ডোনেশন কারো জীবনে
      <br>
      নতুন আশার আলো জ্বালাতে পারে
    </p>

    <form method="POST" action="{{ route('sslcommerz.pay') }}">
      @csrf

 
<div class="input-group input-group-outline amount-field mb-4 mt-4">
  <label class="form-label amount-label">
    টাকার পরিমাণ লিখুন * (যেমনঃ 1000)
  </label>
  <input type="number"
         name="amount"
         class="form-control amount-input"
         min="100"
         required>
</div>



      <button class="btn btn-primary btn-lg w-100">
        এখনই ডোনেট করুন
      </button>
    </form>

    <p class="text-muted small mt-1 mb-0">
      নিরাপদ পেমেন্ট • SSLCommerz দ্বারা সুরক্ষিত
    </p>

  </div>
</div>

 

    </div>
  </div>

</div>

@endsection
@push('js')
 
@endpush