@extends('home.layouts.pageMaster')

@push('css')
<style>
/* ===== Hero ===== */
.project-hero {
  position: relative;
  overflow: hidden;
  border-radius: 16px;
  box-shadow: 0 25px 60px rgba(0,0,0,0.2);
}

.project-hero img {
  width: 100%;
  {{-- height: 480px; --}}
  object-fit: cover;
  transition: transform 1.2s ease, filter 1.2s ease;
  border-radius: 16px;
  display: block;
}

/* Animated zoom on load */
.project-hero img.animate-zoom {
  animation: zoomIn 12s ease-in-out infinite alternate;
}

@keyframes zoomIn {
  0% {
    transform: scale(1);
    filter: brightness(1);
  }
  50% {
    transform: scale(1.08);
    filter: brightness(1.05);
  }
  100% {
    transform: scale(1);
    filter: brightness(1);
  }
}

/* Hero overlay glow */
.project-hero::before {
  content:"";
  position:absolute;
  inset:0;
  background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(0,0,0,0.1));
  pointer-events:none;
  animation: overlayMove 15s linear infinite;
}

@keyframes overlayMove {
  0%{background-position:0% 0%;}
  50%{background-position:100% 100%;}
  100%{background-position:0% 0%;}
}

/* ===== Section title ===== */
.section-title {
  font-weight: 700;
  margin-bottom: 20px;
  position: relative;
}

.section-title::after {
  content:"";
  width:50px;
  height:3px;
  background:#3f51b5;
  display:block;
  margin-top:6px;
  border-radius:2px;
  animation: fadeInSlide 1s ease forwards;
}

@keyframes fadeInSlide {
  from {opacity:0; transform:translateX(-20px);}
  to {opacity:1; transform:translateX(0);}
}

/* ===== Highlight box ===== */
.highlight-box {
  background:#f8f9fa;
  border-radius:12px;
  padding:20px;
  border:1px solid #ddd;
  transition: all .3s ease;
  text-align:center;
  font-weight:500;
  cursor:default;
}

.highlight-box:hover {
  transform: translateY(-6px);
  box-shadow:0 10px 30px rgba(0,0,0,0.12);
}

/* ===== Gallery ===== */
.gallery img {
  width:100%;
  height:180px;
  object-fit:cover;
  border-radius:12px;
  margin-bottom:15px;
  cursor:pointer;
  transition: all .4s ease;
  border:3px solid transparent;
}

.gallery img:hover {
  transform: scale(1.08);
  border-color:#3f51b5;
  box-shadow:0 12px 25px rgba(0,0,0,0.2);
}

/* ===== Map ===== */
.map iframe {
  width:100%;
  height:350px;
  border-radius:16px;
  border:0;
  transition: transform .5s ease, box-shadow .5s ease;
}

.map iframe:hover {
  transform: scale(1.02);
  box-shadow:0 15px 40px rgba(0,0,0,0.25);
}

/* ===== Body animations ===== */
.post-content p, .highlight-box, .gallery img, .map {
  opacity:0;
  transform: translateY(20px);
  animation: fadeInUp 1s forwards;
}

.post-content p:nth-child(1) { animation-delay: 0.2s; }
.highlight-box:nth-child(1) { animation-delay: 0.3s; }
.highlight-box:nth-child(2) { animation-delay: 0.5s; }
.gallery img:nth-child(1) { animation-delay:0.4s;}
.gallery img:nth-child(2) { animation-delay:0.5s;}
.gallery img:nth-child(3) { animation-delay:0.6s;}
.gallery img:nth-child(4) { animation-delay:0.7s;}
.gallery img:nth-child(5) { animation-delay:0.8s;}
.gallery img:nth-child(6) { animation-delay:0.9s;}

@keyframes fadeInUp {
  to {opacity:1; transform:translateY(0);}
}

/* ===== Enquiry / Brochure Buttons ===== */
.btn.bg-gradient-primary {
  transition: all .35s ease;
}

.btn.bg-gradient-primary:hover {
  transform: translateY(-3px);
  box-shadow:0 10px 20px rgba(63,81,181,0.35);
}

.btn.btn-warning {
  transition: all .35s ease;
}

.btn.btn-warning:hover {
  transform: scale(1.05);
  box-shadow:0 15px 30px rgba(255,165,0,0.4);
}

</style>

<style>
/* ===== Related Card ===== */
.related-card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.related-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.25);
}

.card-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 400px;
}

.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 1.2s ease, filter 1.2s ease;
}

.card-img-wrapper:hover img {
    transform: scale(1.08);
    filter: brightness(1.1);
}

/* Glassy overlay animation */
.glossy-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.05) 50%, rgba(255,255,255,0.2) 100%);
    pointer-events: none;
    transform: translateX(-100%);
    animation: glossyMove 30s linear infinite;
}

@keyframes glossyMove {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Card body styling */
.related-card .card-body {
    padding: 20px;
}

.related-card .card-title {
    font-weight: 700;
    margin-bottom: 10px;
}

.related-card .card-text {
    margin-bottom: 15px;
}


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
0 10px 20px rgba(0,0,0,.75),
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

 /* =====================================
   PREMIUM PROJECT ENQUIRY CARD - DARK SINGLE COLOR ANIMATION
===================================== */

.enquiry-card {
  background: linear-gradient(135deg, rgba(18,18,22,0.95), rgba(10,10,12,0.95));
  backdrop-filter: blur(18px);
  border-radius: 20px;
  border: 1px solid rgba(255,255,255,0.08);
  box-shadow:
    0 20px 60px rgba(0,0,0,.45),
    inset 0 1px 0 rgba(255,255,255,.05);
  overflow: hidden;
  position: relative;
  transition: transform 0.6s cubic-bezier(.25,.8,.25,1),
              box-shadow 0.6s cubic-bezier(.25,.8,.25,1);
}

/* subtle single-color animated border */
.enquiry-card::before {
  content:"";
  position: absolute;
  inset: -2px;
  border-radius: 20px;
  background: linear-gradient(
    120deg,
    rgba(0, 200, 255, 0.35),
    rgba(0, 200, 255, 0.15),
    rgba(0, 200, 255, 0.35)
  );
  background-size: 200%;
  z-index: -1;
  animation: borderMove 40s linear infinite; /* slow subtle */
}

@keyframes borderMove {
  0% { background-position: 0% }
  100% { background-position: 200% }
}

/* hover lift */
.enquiry-card:hover {
  transform: translateY(-6px);
  box-shadow:
    0 30px 80px rgba(0,0,0,.65);
}

/* title */
.enquiry-card h5 {
  font-weight:700;
  background: linear-gradient(90deg, #00c6ff, #00c6ff); /* single color text shine */
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* inputs */
.enquiry-card .form-control {
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
  color: #fff;
  border-radius: 12px;
  padding: 12px 14px;
  transition: all .35s ease;
}

.enquiry-card .form-control:focus {
  background: rgba(255,255,255,.08);
  border-color: #00c6ff;
  box-shadow: 0 0 0 2px rgba(0,198,255,.25);
}

/* textarea */
.enquiry-card textarea {
  min-height: 100px;
}

/* button */
.enquiry-card .btn {
  border-radius: 40px;
  font-weight: 600;
  background: linear-gradient(135deg, #0072ff, #00c6ff);
  border: none;
  transition: all .35s ease;
}

.enquiry-card .btn:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow:
    0 12px 25px rgba(0,0,0,.4),
    0 0 25px rgba(0,198,255,.6);
}

.youtube-lite{
    position:relative;
    width:100%;
    padding-top:56.25%;
    background-size:cover;
    background-position:center;
    cursor:pointer;
    border-radius:12px;
    overflow:hidden;
}

.youtube-lite iframe{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}

.yt-play{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    width:70px;
    height:70px;
    border-radius:50%;
    border:none;
    background:red;
    color:#fff;
    font-size:24px;
    cursor:pointer;
}
</style>
@endpush

@section('content')

<section class="py-5">
<div class="container">

<div class="row">

{{-- ================= LEFT CONTENT ================= --}}
<div class="col-md-5">

{{-- Hero --}}
<div class="project-hero mb-4">
<img src="{{ asset('storage/media/image/' . $post->fi()) }}"
                    alt="image"
                    class="img-fluid w-100 rounded animate-zoom w3-animate-zoom" id="project-image">
</div>

</div>
<div class="col-md-7">
    {{-- Card --}}
    <div class="card  related-card" id="project-card">
      <div class="card-body">
        <h2 class="mb-3 text-center text-capitalize">{!! $post->title !!}</h2>
        <p class="text-muted post-content text-center">{{ $post->excerpt }}
        </p>

        <h4 class="section-title mt-4">Project Highlights</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Location</strong><br>
              {{ $post->location->title }}, {{ $post->location->description }}
            </div>
          </div>
          <div class="col-md-6 mb-3">
<div class="highlight-box">
<strong>Status</strong><br>
@foreach ($post->categories as $category)
    <a href="{{ route('user.categoryDetails', $category) }}"
       class="btn btn-outline-primary px-2 py-0 rounded-sm my-1">
        {{ $category->name }}
    </a>
@endforeach
</div>
</div>
@if($post->address)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Address</strong><br>
              {{ $post->address }}
            </div>
          </div>
@endif

@if($post->land)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Land</strong><br>
              {{ $post->land }}
            </div>
          </div>
@endif

@if($post->specialty)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Specialty</strong><br>
              {{ $post->specialty }}
            </div>
          </div>
@endif
@if($post->front_road)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Front Road</strong><br>
              {{ $post->front_road }}
            </div>
          </div>
@endif
@if($post->floors)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Floors</strong><br>
              {{ $post->floors }}
            </div>
          </div>
@endif
@if($post->apartments)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Apartments</strong><br>
              {{ $post->apartments }}
            </div>
          </div>
@endif
@if($post->size)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Size</strong><br>
              {{ $post->size }}
            </div>
          </div>
@endif
@if($post->basements)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Basements</strong><br>
              {{ $post->basements }}
            </div>
          </div>
@endif
@if($post->no_of_car_parking)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Number of Car Parking</strong><br>
              {{ $post->no_of_car_parking }}
            </div>
          </div>
@endif

@if($post->basements)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Basements</strong><br>
              {{ $post->basements }}
            </div>
          </div>
@endif


           
        </div>
      </div>
    </div>
  </div>
<div class="col-md-12">

@if($post->description)
{{-- ===== Description ===== --}}
<h4 class="section-title mt-5">Project Description</h4>

<p class="post-content" style="white-space: nowrap;">{!! $post->description !!}
</p>
@endif

@if($post->yt_video_code)
{{-- ===== YouTube Video ===== --}}
<h4 class="section-title mt-5">Project Video</h4>

 


<div class="youtube-lite" data-id="{{ $post->yt_video_code }}">
    <button class="yt-play">▶</button>
</div>
@endif

{{-- ===== Gallery ===== --}}
{{-- <h4 class="section-title mt-5">Project Gallery</h4>

<div class="row gallery">
<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1560185127-6ed189bf02f4">
</div>
<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d">
</div>
<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c">
</div>
<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1600573472550-8090b5e0745e">
</div>
<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c">
</div>
<div class="col-md-4">
<img src="https://images.unsplash.com/photo-1600607687644-c7f34b5063c0">
</div>
</div> --}}

@if($post->google_map)
{{-- ===== Google Map ===== --}}
<h4 class="section-title mt-5">Project Location</h4>

<div class="map mb-5 post-content">
{!! $post->google_map !!}
</div>

@endif
</div>


<div class="col-md-12">
  
  <div class="row">

    {{-- ================= RIGHT SIDEBAR ================= --}}
<div class="col-md-4">

<div class="card enquiry-card post-content">

<div class="card-body">
<h5 class="mb-3">Project Enquiry</h5>

<form method="POST" action="{{ route('user.information') }}" autocomplete="off">

    @csrf

<div style="display:none">
    <input type="text" name="website" tabindex="-1" autocomplete="off">
</div>

<input type="hidden" name="post_id" value="{{ $post->id }}">

<div class="input-group input-group-outline mb-3">
<label class="form-label">Name *</label>
<input type="text" name="customer_name" class="form-control" required>
</div>
<div class="input-group input-group-outline mb-3">
<label class="form-label">Mobile *</label>
<input type="text" name="customer_mobile" class="form-control" required>
</div>
<div class="input-group input-group-outline mb-3">
<label class="form-label">Email *</label>
<input type="email" name="customer_email" class="form-control" required>
</div>
<div class="input-group input-group-outline mb-3">
<label class="form-label">Message</label>
<textarea name="customer_message" class="form-control" required></textarea>
</div>

<button class="btn bg-gradient-primary w-100">
Send Enquiry
</button>
<p class="text-muted text-sm mt-3 mb-0">
    We respect your privacy. Your information will not be shared.
</p>
</form>
</div>
</div>
</div>

<div class="col-md-8">

{{-- ===== Download Brochure ===== --}}
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

</div>
    
  </div>
  


</div>


</div>

@if($posts->count())
{{-- ===== Related Projects (Glassy Big Image Cards) ===== --}}
<h4 class="section-title mt-5">Related Projects</h4>

<div class="row">
      @foreach($posts as $posta)
    <div class="col-md-12 mb-4">
      <a href="{{ route('user.postDetails', [$posta,Str::slug($posta->title)]) }}">
        <div class="card related-card">
            <div class="card-img-wrapper">
                <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $posta->fi()]) }}" alt="{!! Str::limit($posta->title, 45, '...') !!}">
                <div class="glossy-overlay"></div>
            </div>
            <div class="card-body">
                <h5 class="card-title">{!! Str::limit($posta->title, 45, '...') !!}</h5>
                <p class="card-text text-muted">{!! Str::limit($posta->excerpt, 245, '...') !!}</p>
                <a href="{{ route('user.postDetails', [$posta,Str::slug($posta->title)]) }}" class="btn btn-sm bg-gradient-primary">View Project</a>
            </div>
        </div>
      </a>
    </div>
      @endforeach

     

     
</div>
@endif

</div>


</section>
<div class="modal fade" id="brochurePreviewModal">

<div class="modal-dialog modal-xl modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">Brochure Preview</h5>

<button class="btn-close text-dark" data-bs-dismiss="modal">X</button>

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
<script>
  
function openBrochurePreview(url){

document.getElementById('brochureFrame').src = url;

let modal = new bootstrap.Modal(
document.getElementById('brochurePreviewModal')
);

modal.show();

}
</script>

<script>
function adjustCardHeight() {
  const image = document.getElementById('project-image');
  const card = document.getElementById('project-card');

  if (!image || !card) return;

  if (window.innerWidth >= 992) { // desktop view
    // Card-এর minimum height image-এর height অনুযায়ী
    card.style.minHeight = image.offsetHeight + 'px';
    card.style.height = 'auto'; // content অনুযায়ী বড় হতে পারে
  } else {
    card.style.minHeight = '0';
    card.style.height = 'auto'; // mobile/tablet
  }
}

window.addEventListener('load', adjustCardHeight);
window.addEventListener('resize', adjustCardHeight);
</script>
<script>
document.querySelectorAll(".youtube-lite").forEach(function(el){

    const id = el.dataset.id;

    el.style.backgroundImage =
    "url('https://img.youtube.com/vi/"+id+"/hqdefault.jpg')";

    el.addEventListener("click", function(){

        const iframe = document.createElement("iframe");

        iframe.setAttribute(
        "src",
        "https://www.youtube.com/embed/"+id+"?autoplay=1");

        iframe.setAttribute("frameborder","0");
        iframe.setAttribute("allowfullscreen","1");

        el.innerHTML="";
        el.appendChild(iframe);

    });

});


</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
});
</script>
@endif

@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    html: `{!! implode('<br>', $errors->all()) !!}`,
});
</script>
@endif
@endpush