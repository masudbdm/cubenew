@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush
@push('css')
<style>
  .w3-border-green {
    border-color: {{ $websiteParameter->primary_color }} !important;
}
.border-success- {
    border-color: {{ $websiteParameter->primary_color }} !important;
}

.text-success- {
    color: {{ $websiteParameter->primary_color }} !important;
}
.text-second{
    color: {{ $websiteParameter->secondary_color }} !important;

}

/* ================================
   NEON QUANTUM CARD
=================================*/

.neon-card{
    position: relative;
    height: 120px;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;

    background: rgba(255,255,255,0.65);
    backdrop-filter: blur(14px);

    transition: all .35s ease;
}

/* Depth lift */
.neon-card:hover{
    transform: translateY(-8px) scale(1.03);
}

/* Quantum Neon Border */
.neon-card::before{
    content:"";
    position:absolute;
    inset:-2px;
    border-radius:20px;

    background: linear-gradient(
        45deg,
        #00f0ff,
        #00ff9d,
        #7a00ff,
        #00f0ff
    );

    background-size:300% 300%;
    animation: quantumFlow 6s linear infinite;

    z-index:0;
}

/* Inner mask */
.neon-card::after{
    content:"";
    position:absolute;
    inset:2px;
    border-radius:18px;
    background: rgba(255,255,255,0.75);
    z-index:1;
}

.neon-card .card-body{
    position:relative;
    z-index:2;
}

@keyframes quantumFlow{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

.neon-card{
    --x:50%;
    --y:50%;
}

.neon-card:hover{
    background:
      radial-gradient(
        circle at var(--x) var(--y),
        rgba(0,255,255,0.35),
        transparent 60%
      ),
      rgba(255,255,255,0.7);
}

.spark{
    position:absolute;
    width:4px;
    height:4px;
    border-radius:50%;
    background:#00f0ff;
    pointer-events:none;
    animation: sparkFloat 2s linear forwards;
}

@keyframes sparkFloat{
    0%{
        opacity:1;
        transform: translateY(0) scale(1);
    }
    100%{
        opacity:0;
        transform: translateY(-40px) scale(0.5);
    }
}
</style>
@endpush

@section('content')

<div class="container my-5">

  <div class="row justify-content-center">
    <div class="col-lg-10 col-md-12 col-sm-12">
<h3 class="text-center mb-5 fw-bold">
  Which Section Do You Want to Visit? 
  <div class="mx-auto mt-2" style="width:60px;height:4px;background:{{ $websiteParameter->primary_color }}"></div>
</h3>

            <div class="row">
                @foreach ($categoriesPost as $category)
                <div class="col-md-4 col-12">
                    <a href="{{ route('user.categoryDetails', $category) }}" class="text-primary icon-move-right">
                        <div class="neon-card elevation-2 mb-3 mx-2 " style="height: 120px">
                            <div class="card-body p-1">
                                <h4 class="card-title w3-large text-center font-weight-bold text-success- ">
                                    {{ Str::limit($category->name, 20, '...') }}</h4>
                                    <p class="card-text text-justify- px-2 w3-text-black text-center">
                                        {{ Str::limit($category->description_en, 85, '...') }}
                                        <br>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
       

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


document.querySelectorAll('.neon-card').forEach(card => {

    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        card.style.setProperty('--x', x + 'px');
        card.style.setProperty('--y', y + 'px');
    });

});

document.querySelectorAll('.neon-card').forEach(card => {

    setInterval(() => {

        const spark = document.createElement('span');
        spark.classList.add('spark');

        spark.style.left = Math.random() * 100 + '%';
        spark.style.bottom = '10px';

        card.appendChild(spark);

        setTimeout(() => {
            spark.remove();
        }, 2000);

    }, 600);

});
</script>
@endpush