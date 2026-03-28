@extends('home.layouts.pageMaster')

@push('meta')
    {{-- Post specific overrides only --}}
    <meta property="og:type" content="article">

    {{-- Optional: Facebook App ID --}}
    {{-- <meta property="fb:app_id" content="{{ $websiteParameter->fb_page_code }}"> --}}
@endpush

@push('css')


<style>
    .social-icon {
        font-size: 18px !important;
    }

.document-box {
  position: relative;
  border: 1px solid #e0e0e0;
  border-radius: 0.5rem;
  padding: 1.5rem 1.25rem 1.25rem;
  background: #fff;
}

.document-box-title {
  position: absolute;
  top: -12px;
  left: 16px;
  background: #fff;
  padding: 0 8px;
  font-size: 0.85rem;
  font-weight: 600;
  color: #344767; /* Material Kit dark */
}


/* Modal overall background */
#needDonationModal .modal-content {
  background: linear-gradient(135deg, #f5f7fa, #eef2f7);
  border-radius: 16px;
}

/* Remove harsh borders */
#needDonationModal .modal-content {
  border: none;
}


#needDonationModal .card {
  background: #ffffff;
  border-radius: 14px;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
}

{{-- #needDonationModal .input-group-outline .form-control,
#needDonationModal textarea,
#needDonationModal select {
  background-color: #f9fafb;
  border-radius: 8px;
}

#needDonationModal .form-control:focus,
#needDonationModal textarea:focus,
#needDonationModal select:focus {
  background-color: #ffffff;
  box-shadow: 0 0 0 2px rgba(63, 81, 181, 0.15);
}
 --}}

.document-box {
  background: #f1f4ff;
  border-radius: 12px;
  padding: 16px;
  border: 1px dashed #c5cae9;
}

.document-box-title {
  font-weight: 600;
  color: #3f51b5;
  margin-bottom: 8px;
}

{{-- 
#needDonationModal .card-header {
  background: transparent;
}

#needDonationModal h4 {
  letter-spacing: 0.3px;
} --}}

/* Force white background for document inputs */
.document-box .input-group-outline {
  background: #ffffff;
  border-radius: 8px;
  padding: 4px;
}




</style>
 
<style>
/* ===== Document Box ===== */
.document-box {
  position: relative;
  background: #f1f4ff;
  border: 1px dashed #c5cae9;
  border-radius: 12px;
  padding: 20px 16px 16px;
}

.document-box-title {
  position: absolute;
  top: -12px;
  left: 16px;
  background: #f1f4ff;
  padding: 0 10px;
  font-size: 0.85rem;
  font-weight: 600;
  color: #3f51b5;
}

/* Force white inputs */
.document-box .input-group-outline {
  background: #fff;
  border-radius: 8px;
  padding: 4px;
}

/* BROCHURE RIBBON */


/* ======================================
   ULTRA PREMIUM BLACK GLASS RIBBON
   Minimal Luxury Marketplace Style
====================================== */

.brochure-ribbon{

position:relative;

background:
linear-gradient(
135deg,
rgba(10,10,12,0.96),
rgba(18,18,22,0.96)
);

backdrop-filter: blur(28px);

border-radius:28px;

padding:42px;

overflow:hidden;

color:#fff;

/* Premium Depth Shadow */
box-shadow:
0 40px 90px rgba(0,0,0,.75),
inset 0 0 2px rgba(255,255,255,.05);

border:1px solid rgba(255,255,255,.05);

transition: all .45s cubic-bezier(.25,.8,.25,1);
}

/* Hover lift (subtle luxury feel) */
.brochure-ribbon:hover{
transform: translateY(-6px);
}

/* Soft Light Edge Glow */
.brochure-ribbon::before{
content:"";
position:absolute;

inset:0;

border-radius:28px;

background: radial-gradient(
circle at top,
rgba(0,200,255,.12),
transparent 60%
);

opacity:.6;

pointer-events:none;
}

/* Floating Light Sweep */
.ribbon-glow{

position:absolute;

top:0;
left:-160%;

width:320%;
height:100%;

background: linear-gradient(
120deg,
transparent,
rgba(255,255,255,.12),
transparent
);

animation:ribbonLuxurySweep 8s ease-in-out infinite;
}

@keyframes ribbonLuxurySweep{

0%{transform:translateX(-100%)}
50%{transform:translateX(100%)}
100%{transform:translateX(-100%)}

}

/* Title Luxury Style */
.ribbon-title{

font-weight:700;
font-size:26px;

letter-spacing:.5px;

background: linear-gradient(90deg,#ffffff,#cfd8dc,#ffffff);

-webkit-background-clip:text;
-webkit-text-fill-color: transparent;
}

/* Subtitle */
.ribbon-sub{
opacity:.85;
font-size:15px;
line-height:1.6;
}

/* Buttons */
.ribbon-btn{

border-radius:40px;

padding:12px 28px;

font-weight:600;

transition:.35s ease;
}

/* Preview Button */
.ribbon-btn.btn-light{

background: rgba(0,0,0,.55);

border:1px solid rgba(255,255,255,.12);

color:#fff;
}

.ribbon-btn.btn-light:hover{

background: rgba(0,0,0,.85);

transform: translateY(-3px);
}

/* Download Button (Luxury Orange Accent) */
.download-btn{

background: linear-gradient(135deg,#ff9a00,#ff6a00);

border:none;

color:#fff;

box-shadow:
0 0 25px rgba(255,120,0,.8);
}

.download-btn:hover{

transform: scale(1.06);

box-shadow:
0 15px 35px rgba(0,0,0,.6),
0 0 30px rgba(255,140,0,1);
}

/* Mobile */
@media(max-width:768px){

.brochure-ribbon{
padding:26px;
text-align:center;
border-radius:22px;
}

.ribbon-title{
font-size:20px;
}

.ribbon-btn{
margin-top:14px;
}

}
 
</style>

@endpush
@section('content')

 

    <!-- -------- START PRE-FOOTER 1 w/ SUBSCRIBE BUTTON AND IMAGE ------- -->
    <section class="my-5 pt-5">
        <div class="container-fluid px-3">
            <div class="row">
                <div class="col-md-9 p-1">
    <div class="card">
        <div class="card-body p-3">

            {{-- Category (Top – keep as is) --}}
            <h5 class="w3-md font-weight-bold mb-2">
                <i class="fa fa-caret-right text-primary-wp"></i>
                <span class="text-primary-wp">Category:</span>
                @foreach ($post->categories as $category)
                    <a href="{{ route('user.categoryDetails', $category) }}"
                       class="badge bg-secondary-wp my-1">
                        {{ $category->name }}
                    </a>
                @endforeach
            </h5>

            {{-- Title --}}
            <h2 class="mb-3">{!! $post->title !!}</h2>

            {{-- Featured Image --}}
            <div class="mb-3">
                <img
                    src="{{ asset('storage/media/image/' . $post->fi()) }}"
                    alt="image"
                    class="img-fluid w-100 rounded w3-animate-zoom">
            </div>

            {{-- Post created date --}}
            {{-- <div class="mb-3 text-muted">
                <i class="fa fa-calendar"></i>
                {{ $post->created_at->format('d M Y') }}
            </div> --}}

            {{-- Description --}}
            <div class="post-content w3-animate-opacity mb-4">
                {!! $post->description !!}
            </div>


            @if($post->brochure_file)

@php
$brochure = asset('storage/media/brochure/'.$post->brochure_file);
$ext = strtolower(pathinfo($post->brochure_file, PATHINFO_EXTENSION));
@endphp

<div class="brochure-ribbon my-5">

<div class="ribbon-glow"></div>

<div class="container-fluid">

<div class="row align-items-center">

<div class="col-md-8">

<h4 class="ribbon-title">
<i class="fa-solid fa-file-lines me-2"></i>
Project Brochure Available
</h4>

<p class="ribbon-sub">
Download complete project details, floor plan, price and location guide.
</p>

</div>

<div class="col-md-4 text-md-end">

@if($ext == 'pdf')

<button
class="btn btn-light ribbon-btn me-2"
onclick="openBrochurePreview('{{ $brochure }}')">

<i class="fa-solid fa-eye"></i>
Preview

</button>

@endif

<a href="{{ $brochure }}"
target="_blank"
class="btn btn-warning ribbon-btn download-btn">

<i class="fa-solid fa-download"></i>
Download Brochure

</a>

</div>

</div>

</div>

</div>

@endif
 

            {{-- Donation CTA Button --}}
{{-- <div class="text-center mt-5">
  <button
    type="button"
    class="btn bg-gradient-primary btn-lg"
    data-bs-toggle="modal"
    data-bs-target="#needDonationModal">
    আপনি কি ডোনেশন নিতে ইচ্ছুক? তাহলে এখনই ক্লিক করুন
  </button>
</div> --}}




@php
    $tags = $post->tags ?? [];
 
@endphp

@if(!empty($tags))
    <div class="mb-4">
        <strong>Tags:</strong>
        @foreach($tags as $tag)
            <span class="badge bg-secondary me-1">{{ $tag }}</span>
        @endforeach
    </div>
@endif


            {{-- Share Buttons (AddThis replacement) --}}
            <div class="mt-4">
                <strong>Share:</strong>
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                   class="btn btn-sm btn-primary me-1">
                    <i class="fa-brands fa-facebook-f social-icon"></i>

                </a>

                <a target="_blank"
                   href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                   class="btn btn-sm btn-info me-1">
                    <i class="fa-brands fa-x-twitter social-icon"></i>

                </a>

                <a target="_blank"
                   href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                   class="btn btn-sm btn-success me-1">
                    <i class="fa-brands fa fa-whatsapp social-icon"></i>
                </a>

                <a target="_blank"
                   href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                   class="btn btn-sm btn-secondary">
                    <i class="fa-brands fa-linkedin-in social-icon"></i>

                </a>

                <i style="font-size: 28px !important;" class="fa-solid fa-print social-icon me-3 text-danger"
   role="button"
   title="Print"
   onclick="window.print()">
</i>

            </div>




        </div>
    </div>
</div>



                <div class="col-md-3 ms-auto">
                    {{-- <label class="m-0" for="">Posts</label> --}}
                    <ul class="list-group list-group-flush">
                        @foreach ($posts as $posta)
                            <li class="list-group-item mx-0 px-0">
                                <a href="{{ route('user.postDetails', [$posta,Str::slug($posta->title)]) }}">
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <div class="row d-flex justify-content-center align-items-center">
                                                <div class="col-4 pl-0">
                                                    <img src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $posta->fi()]) }}" alt=""
                                                        class="img-fluid rounded" style="">
                                                </div>
                                                <div class="col-8 p-1">
                                                    <div class="" >
                                                        <span class="text-bold"
                                                            style="font-size: 1.0 em;">{!! Str::limit($posta->title, 45, '...') !!}</span>
                                                        <br>
                                                        <span style="font-size: 15px;">{!! Str::limit($posta->excerpt, 25, '...') !!}</span>
                                                        <br>
                                                        <span class="">Read more</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
            </div>
        </div>
    </section>
    <!-- -------- END PRE-FOOTER 1 w/ SUBSCRIBE BUTTON AND IMAGE ------- -->


<!-- Need Donation Modal -->
<div class="modal fade" id="needDonationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-body p-0">
        <div class="card card-plain">

          <!-- Header -->
          <div class="card-header pb-0 text-center">
            <h4 class="font-weight-bolder text-primary text-gradient">
              Need Donation Request
            </h4>
            <p class="mb-0 text-sm">
              সঠিক তথ্য দিয়ে ফর্মটি পূরণ করুন
            </p>
          </div>

          <!-- Form -->
          <!-- Form -->
<div class="card-body">

  {{-- Global Messages --}}
  <div id="ajaxErrorBox" class="alert alert-danger d-none"></div>
  <div id="ajaxSuccessBox" class="alert alert-success d-none"></div>

  <form id="donationForm"
        method="POST"
        action="{{ route('donation.store') }}"
        enctype="multipart/form-data">

    @csrf

    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <div style="display:none">
      <input type="text" name="website" tabindex="-1" autocomplete="off">
    </div>

    {{-- Name --}}
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Full Name *</label>
          <input type="text" name="name" class="form-control">
        </div>
        <small class="text-danger error-text" data-error="name"></small>
      </div>

      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Father Name *</label>
          <input type="text" name="father_name" class="form-control">
        </div>
        <small class="text-danger error-text" data-error="father_name"></small>
      </div>
    </div>

    {{-- Email & Mobile --}}
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Email *</label>
          <input type="email" name="email" class="form-control">
        </div>
        <small class="text-danger error-text" data-error="email"></small>
      </div>

      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Mobile *</label>
          <input type="text" name="mobile" id="mobile" class="form-control">
        </div>
        <small class="text-danger error-text" data-error="mobile"></small>
      </div>
    </div>

    {{-- Address --}}
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Present Address *</label>
          <textarea name="present_address" class="form-control" rows="2"></textarea>
        </div>
        <small class="text-danger error-text" data-error="present_address"></small>
      </div>

      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Permanent Address *</label>
          <textarea name="permanent_address" class="form-control" rows="2"></textarea>
        </div>
        <small class="text-danger error-text" data-error="permanent_address"></small>
      </div>
    </div>

    {{-- NID --}}
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline mb-3 mt-4">
          <label class="form-label">NID Number *</label>
          <input type="text" name="nid" class="form-control">
        </div>
        <small class="text-danger error-text" data-error="nid"></small>
      </div>

      <div class="col-md-6">
        <label class="form-label d-block mb-1">NID Picture *</label>
        <div class="input-group input-group-outline">
          <input type="file" name="nid_pic" class="form-control">
        </div>
        <small class="text-danger error-text" data-error="nid_pic"></small>
      </div>
    </div>



    {{-- Purpose (From Post, Locked) --}}
<div class="row">
  <div class="col-md-6">

    {{-- Hidden input (important!) --}}
    <input type="hidden" name="purpose" value="{{ $post->purpose }}">

    <div class="input-group input-group-outline my-3 is-filled">
      <label class="form-label">Purpose *</label>

      {{-- শুধু দেখানোর জন্য --}}
    <select class="form-control" disabled>
        <option>
            {{ str_replace('|', ' > ', $post->purpose) }}
        </option>
    </select>
    </div>
 

  </div>

  <div class="col-md-6">
    <div class="input-group input-group-outline my-3 is-filled">
      <input type="date" class="form-control"
             value="{{ date('Y-m-d') }}" readonly>
    </div>
  </div>
</div>


    {{-- Details --}}
    <div class="input-group input-group-outline my-3">
      <label class="form-label">Explain / Details</label>
      <textarea name="details" class="form-control" rows="3"></textarea>
    </div>
    <small class="text-danger error-text" data-error="details"></small>

    {{-- Documents --}}
    <div class="document-box mt-4">
      <div class="document-box-title rounded">
        প্রয়োজনীয় ডকুমেন্টস / কাগজপত্র জমা দিনঃ
      </div>

      <div id="documentRows" class="mt-3">
        <div class="row align-items-end document-row mb-3">
          <div class="col-md-5">
            <div class="input-group input-group-outline">
              <label class="form-label">Document Name</label>
              <input type="text" name="document_type[]" class="form-control">
            </div>
          </div>

          <div class="col-md-5">
            <label class="form-label d-block mb-1">Upload Document *</label>
            <div class="input-group input-group-outline">
              <input type="file" name="document_file[]" class="form-control">
            </div>
          </div>

          <div class="col-md-2 text-end">
            <button type="button"
                    class="btn btn-outline-danger btn-sm remove-row d-none">
              <i class="material-icons text-sm">delete</i>
            </button>
          </div>
        </div>
      </div>

      <small class="text-danger error-text" data-error="document_file"></small>

      <div class="text-end">
        <button type="button"
                class="btn btn-outline-primary btn-sm"
                id="addDocumentRow">
          <i class="material-icons text-sm">add</i>
          Add More
        </button>
      </div>
    </div>

    {{-- Actions --}}
    <div class="text-center mt-4">
      <button type="submit"
              id="submitBtn"
              class="btn bg-gradient-primary btn-lg w-100">
        SUBMIT REQUEST
      </button>

      <button type="button"
              class="btn btn-link text-secondary mt-2"
              data-bs-dismiss="modal">
        Cancel
      </button>
    </div>

  </form>
</div>


        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="brochurePreviewModal">

<div class="modal-dialog modal-xl modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">Brochure Preview</h5>

<button class="btn-close" data-bs-dismiss="modal"></button>

</div>

<div class="modal-body p-0">

<iframe
id="brochureFrame"
style="width:100%;height:80vh;border:0;"></iframe>

</div>

</div>

</div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ===============================
     Dynamic Document Rows
  =============================== */
  const container = document.getElementById('documentRows');

  document.getElementById('addDocumentRow').addEventListener('click', function () {

    const row = document.createElement('div');
    row.className = 'row align-items-end document-row mb-3';

    row.innerHTML = `
      <div class="col-md-5">
        <div class="input-group input-group-outline">
          <label class="form-label">Document Name</label>
          <input type="text" name="document_type[]" class="form-control">
        </div>
      </div>

      <div class="col-md-5">
        <label class="form-label d-block mb-1">
          <i class="material-icons text-primary text-sm">attach_file</i>
          Upload Document *
        </label>
        <div class="input-group input-group-outline">
          <input type="file" name="document_file[]" class="form-control">
        </div>
      </div>

      <div class="col-md-2 text-end">
        <button type="button" class="btn btn-outline-danger btn-sm remove-row">
          <i class="material-icons text-sm">delete</i>
        </button>
      </div>
    `;

    container.appendChild(row);
    toggleRemoveButtons();
  });

  document.addEventListener('click', function (e) {
    if (e.target.closest('.remove-row')) {
      e.target.closest('.document-row').remove();
      toggleRemoveButtons();
    }
  });

  function toggleRemoveButtons() {
    const rows = document.querySelectorAll('.document-row');
    rows.forEach(row => {
      const btn = row.querySelector('.remove-row');
      rows.length > 1 ? btn.classList.remove('d-none') : btn.classList.add('d-none');
    });
  }

  toggleRemoveButtons();

  /* ===============================
     Material Input Focus Fix
  =============================== */
  document.querySelectorAll('textarea, input').forEach(el => {

    if (el.value.trim() !== '') {
      el.closest('.input-group-outline')?.classList.add('is-filled');
    }

    el.addEventListener('focus', () => {
      el.closest('.input-group-outline')?.classList.add('is-focused');
    });

    el.addEventListener('blur', () => {
      el.closest('.input-group-outline')?.classList.remove('is-focused');
      el.value.trim() !== ''
        ? el.closest('.input-group-outline')?.classList.add('is-filled')
        : el.closest('.input-group-outline')?.classList.remove('is-filled');
    });
  });

  /* ===============================
     Mobile Validation
  =============================== */
  const mobileInput = document.getElementById('mobile');
  const form = document.getElementById('donationForm');

  mobileInput.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
  });

  /* ===============================
     AJAX Submit
  =============================== */
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    clearErrors();

    let mobile = mobileInput.value.trim();

    if (!/^01\d{9}$/.test(mobile)) {
      Swal.fire({
        icon: 'error',
        title: 'ভুল মোবাইল নাম্বার',
        text: '১১ ডিজিটের সঠিক মোবাইল নাম্বার দিন (01XXXXXXXXX)'
      });
      mobileInput.focus();
      return;
    }

     

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Submitting...';

    const formData = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: formData
    })
    .then(async response => {
      const data = await response.json();

      if (!response.ok) {
        throw data;
      }

      Swal.fire({
        icon: 'success',
        title: 'সফল হয়েছে',
        text: data.message || 'আপনার আবেদন সফলভাবে জমা হয়েছে',
        timer: 2500,
        showConfirmButton: false
      });

      form.reset();
      toggleRemoveButtons();

      // mobile input যেটা donation form এ ছিল
  const mobile = document.querySelector('[name="mobile"]').value;
 

    setTimeout(() => {
      window.location.href = data.redirect;
    }, 2600);  

    })
    .catch(error => {

      if (error.errors) {
        showFieldErrors(error.errors);
      }

      Swal.fire({
        icon: 'error',
        title: 'সমস্যা হয়েছে',
        text: error.message || 'ফর্ম সাবমিট করা যায়নি'
      });
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.innerHTML = 'SUBMIT REQUEST';
    });

  });

  /* ===============================
     Error Helpers
  =============================== */
  function clearErrors() {
    document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
  }

  function showFieldErrors(errors) {
    Object.keys(errors).forEach(field => {
      const errorEl = document.querySelector(`[data-error="${field}"]`);
      if (errorEl) {
        errorEl.textContent = errors[field][0];
      }
    });
  }

});

function openBrochurePreview(url){

document.getElementById('brochureFrame').src = url;

let modal = new bootstrap.Modal(
document.getElementById('brochurePreviewModal')
);

modal.show();

}
</script>
@endpush
