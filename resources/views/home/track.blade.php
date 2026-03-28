@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush
@push('css')

@endpush

@section('content')

<div class="container my-5">

  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">

      <div class="card shadow-lg border-0">
        <div class="card-body p-4">

          <h4 class="text-center font-weight-bold text-primary mb-2">
            Donation Request Tracking
          </h4>
          <p class="text-center text-muted mb-4">
            ট্র্যাকিং নম্বর ও মোবাইল নাম্বার দিন
          </p>

          <form id="trackForm"
                method="POST"
                action="{{ route('donation.track.result') }}">

            @csrf

            {{-- Tracking Number --}}
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Tracking Number *</label>
              <input type="text"
                     name="tracking_number"
                     class="form-control"
                     value="{{ $tracking ?? '' }}"
                     required>
            </div>
            <small class="text-danger error-text" data-error="tracking_number"></small>

            {{-- Mobile --}}
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Mobile Number *</label>
              <input type="text"
                     name="mobile"
                     class="form-control"
                    value="{{ $mobile ?? '' }}"
                     required>
            </div>
            <small class="text-danger error-text" data-error="mobile"></small>

            {{-- Action --}}
            <div class="text-center mt-4">
              <button type="submit"
                      class="btn bg-gradient-primary w-100 btn-lg">
                Track Donation
              </button>
            </div>

          </form>

        </div>
      </div>

      {{-- Invoice Result --}}
      <div id="invoiceResult" class="mt-5"></div>

    </div>
  </div>

</div>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

  const form = document.getElementById('trackForm');
  if (!form) return;

  const trackingInput = form.querySelector('[name="tracking_number"]');
  const mobileInput   = form.querySelector('[name="mobile"]');
  const resultBox     = document.getElementById('invoiceResult');

  /* ===============================
     Mobile only numeric
  =============================== */
  mobileInput.addEventListener('input', () => {
    mobileInput.value = mobileInput.value.replace(/[^0-9]/g, '');
  });

  /* ===============================
     Form submit (AJAX)
  =============================== */
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const mobile = mobileInput.value.trim();

    if (mobile.startsWith('88') || mobile.startsWith('+88')) {
      Swal.fire('ভুল ফরম্যাট', 'শুধু 01XXXXXXXXX লিখুন', 'warning');
      return;
    }

    if (!/^01\d{9}$/.test(mobile)) {
      Swal.fire('ভুল নাম্বার', '১১ ডিজিটের সঠিক মোবাইল দিন', 'error');
      return;
    }

    const formData = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document
          .querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {

      if (data.status === 'error') {
        Swal.fire('দুঃখিত', data.message, 'error');
        return;
      }

      resultBox.innerHTML = data.html;

      Swal.fire({
        icon: 'success',
        title: 'রিকুয়েস্ট পাওয়া গেছে',
        text: 'নিচে আপনার ডোনেশন ইনভয়েস দেখুন'
      });

      resultBox.scrollIntoView({ behavior: 'smooth' });
    })
    .catch(() => {
      Swal.fire('এরর', 'সার্ভার সমস্যা হয়েছে', 'error');
    });
  });

  /* ===============================
     Auto submit (redirect থেকে এলে)
  =============================== */
  if (trackingInput.value && mobileInput.value) {
    setTimeout(() => {
      form.dispatchEvent(new Event('submit'));
    }, 500);
  }

});

/* ===============================
   Print only invoice
=============================== */
function printInvoice() {

  const printArea = document.querySelector('.print-area');
  if (!printArea) {
    alert('Print area not found');
    return;
  }

  const printWindow = window.open('', '', 'width=900,height=650');

  printWindow.document.write(`
    <html>
      <head>
        <title>Print Invoice</title>
        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <style>
          body {
            margin: 0;
            padding: 20px;
            background: #fff;
          }
          .print-area {
            border: 2px dashed #000;
          }
          @media print {
            body { padding: 0; }
          }
        </style>
      </head>
      <body>
        ${printArea.outerHTML}
      </body>
    </html>
  `);

  printWindow.document.close();
  printWindow.focus();
  printWindow.print();

  printWindow.onafterprint = () => {
    printWindow.close();
  };
}
</script>
@endpush