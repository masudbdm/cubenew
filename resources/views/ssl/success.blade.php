@extends('home.layouts.pageMaster')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <div class="card shadow-lg border-0 text-center">
        <div class="card-body p-4">

          <div class="mb-3">
            <i class="material-icons text-success" style="font-size:64px;">
              check_circle
            </i>
          </div>

          <h3 class="fw-bold text-success mb-2">
            আপনার ডোনেশন সফল হয়েছে 🎉
          </h3>

          <p class="text-muted mb-3">
            আপনার সহায়তা কারো জীবনে নতুন আশার আলো জ্বালাবে।
          </p>

          <div class="bg-light rounded p-3 mb-3">
            <p class="mb-1 small text-muted">ট্রানজেকশন আইডি</p>
            <h6 class="fw-bold mb-0">
              {{ $transaction_id }}
            </h6>
          </div>

          <p class="small text-muted">
            পেমেন্টটি নিরাপদভাবে সম্পন্ন হয়েছে<br>
            <strong>SSLCommerz</strong> দ্বারা সুরক্ষিত
          </p>

          <a href="{{ url('/') }}" class="btn btn-primary btn-lg w-100 mt-3">
            হোমে ফিরে যান
          </a>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection
