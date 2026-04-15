@extends('home.layouts.pageMaster')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
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

/* ===== Gallery (carousel like screenshot) ===== */
.project-gallery-carousel{
  position: relative;
  border-radius: 18px;
  padding: 14px 12px 24px;
  overflow: hidden; /* keep peeks inside frame */
  border: 1px solid rgba(0,0,0,0.04);
}
.project-gallery-carousel::before{
  content:"";
  position:absolute;
  inset:0;
  border-radius: 18px;
  background: #f6f1e8;
  z-index: 0;
}
.project-gallery-carousel > *{
  position: relative;
  z-index: 1;
}
.project-gallery-carousel__title{
  position: absolute;
  top: -6px;
  left: 50%;
  transform: translateX(-50%);
  font-weight: 800;
  letter-spacing: 8px;
  font-size: clamp(34px, 6vw, 64px);
  color: rgba(20,20,20,0.12);
  text-transform: uppercase;
  user-select: none;
  pointer-events: none;
  z-index: 3;
  white-space: nowrap;
}
.project-gallery-carousel .splide{
  width: 100%;
  padding: 40px 0 10px; /* undo last change */
  padding-left: 24px;
  padding-right: 24px;
  overflow: visible; /* allow internal overflow; outer frame clips */
}
.project-gallery-carousel .splide__slide{
  display: flex;
  justify-content: center;
  /* Prevent oversized inner frame from pushing off-center */
  box-sizing: border-box;
}
.project-gallery-carousel .gallery-slide{
  width: 100%;
  max-width: 980px; /* bigger center image */
  aspect-ratio: 16/9;
  border-radius: 14px;
  overflow: hidden;
  background: #0b0b0d;
  box-shadow: 0 18px 55px rgba(0,0,0,0.18);
  position: relative;
}
.project-gallery-carousel .splide__slide{
  opacity: .78;
  transform: scale(.88); /* side slides look smaller */
  transition: opacity .25s ease, transform .25s ease;
}
.project-gallery-carousel .is-active{
  opacity: 1;
  transform: scale(1); /* center slide full */
}
.project-gallery-carousel .gallery-slide img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}
.project-gallery-carousel .gallery-caption{
  margin-top: 10px;
  text-align: center;
  color: rgba(0,0,0,0.65);
  font-size: 14px;
}
.project-gallery-carousel__nav{
  display: flex;
  justify-content: center;
  gap: 18px;
  margin-top: 14px;
  position: relative;
  z-index: 6; /* keep above any overlays */
}
.project-gallery-carousel__nav button{
  width: 46px;
  height: 46px;
  border-radius: 999px;
  border: 1px solid rgba(0,0,0,0.25);
  background: rgba(255,255,255,0.65);
  backdrop-filter: blur(10px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.10);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
  pointer-events: auto;
  touch-action: manipulation;
}
.project-gallery-carousel__nav button:hover{
  transform: translateY(-2px);
  box-shadow: 0 14px 30px rgba(0,0,0,0.14);
  background: rgba(255,255,255,0.85);
}
.project-gallery-carousel__nav button:active{ transform: translateY(0); }
.project-gallery-carousel__nav svg{ width: 18px; height: 18px; }

@media (max-width: 575.98px){
  .project-gallery-carousel{ padding-bottom: 18px; }
  .project-gallery-carousel .gallery-slide{ aspect-ratio: 4/3; }
  .project-gallery-carousel__title{ top: -10px; letter-spacing: 6px; }
  .project-gallery-carousel .splide{ padding-left: 12px; padding-right: 12px; }
}

/* Gallery lightbox */
.gallery-modal .modal-content{
  background: rgba(10,10,12,0.92);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 16px;
}
.gallery-modal-close{
  width: 42px;
  height: 42px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.22);
  background: rgba(0,0,0,0.35);
  backdrop-filter: blur(10px);
  color: #fff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  line-height: 1;
  opacity: .95;
  box-shadow: 0 12px 30px rgba(0,0,0,0.35);
  transition: transform .15s ease, background .15s ease, opacity .15s ease;
}
.gallery-modal-close:hover{
  background: rgba(0,0,0,0.5);
  opacity: 1;
  transform: translateY(-1px);
}
.gallery-modal-close:active{ transform: translateY(0); }
.gallery-modal .modal-header{ padding-bottom: 6px; padding-top: 12px; }
.gallery-modal .modal-body{ position: relative; padding-top: 0; }
.gallery-modal-nav{
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 48px;
  height: 48px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.25);
  background: rgba(0,0,0,0.35);
  backdrop-filter: blur(10px);
  color: #fff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  z-index: 5;
  cursor: pointer;
  transition: transform .15s ease, background .15s ease, box-shadow .15s ease;
  box-shadow: 0 12px 30px rgba(0,0,0,0.35);
}
.gallery-modal-nav:hover{
  background: rgba(0,0,0,0.5);
  box-shadow: 0 14px 38px rgba(0,0,0,0.42);
}
.gallery-modal-nav:active{ transform: translateY(-50%) scale(0.98); }
.gallery-modal-nav svg{ width: 20px; height: 20px; }
.gallery-modal-nav--prev{ left: 14px; }
.gallery-modal-nav--next{ right: 14px; }
@media (max-width: 575.98px){
  .gallery-modal-nav--prev{ left: 10px; }
  .gallery-modal-nav--next{ right: 10px; }
  .gallery-modal-nav{ width: 44px; height: 44px; }
}
.gallery-modal-img{
  width: 100%;
  height: auto;
  max-height: 80vh;
  object-fit: contain;
  border-radius: 12px;
}
.gallery-modal-media{
  position: relative;
  overflow: hidden;
  border-radius: 12px;
}
.gallery-modal-img{
  transition: opacity .22s ease, transform .28s ease;
  will-change: opacity, transform;
}
.gallery-modal.is-switching .gallery-modal-img{
  opacity: 0;
  transform: translateX(18px);
}
.gallery-modal.is-switching.is-prev .gallery-modal-img{
  transform: translateX(-18px);
}
.gallery-modal-desc{
  margin-top: 12px;
  color: rgba(255,255,255,0.82);
  text-align: center;
  font-size: 14px;
}
.gallery-modal.is-switching .gallery-modal-desc{
  opacity: 0;
  transform: translateY(6px);
}
.gallery-modal-desc{
  transition: opacity .18s ease, transform .22s ease;
  will-change: opacity, transform;
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
    background: rgba(255,255,255,0.06);
}

.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* no crop */
    object-position: center;
    transition: transform 1.2s ease, filter 1.2s ease;
}

.card-img-wrapper:hover img {
    transform: scale(1.08);
    filter: brightness(1.1);
}

@media (max-width: 575.98px){
    .card-img-wrapper{ height: 280px; }
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

@push('css')
<style>
    .hp-field{
        position:absolute !important;
        left:-10000px !important;
        top:auto !important;
        width:1px !important;
        height:1px !important;
        overflow:hidden !important;
        opacity:0 !important;
        pointer-events:none !important;
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

@if($post->number_of_bedrooms)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Number of Bedrooms</strong><br>
              {{ $post->number_of_bedrooms }}
            </div>
          </div>
@endif

@if($post->rajuk_approval_number)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Rajuk Approval Number</strong><br>
              {{ $post->rajuk_approval_number }}
            </div>
          </div>
@endif

@if($post->engineer_name)
          <div class="col-md-6 mb-3">
            <div class="highlight-box">
              <strong>Architect Name</strong><br>
              {{ $post->engineer_name }}
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

{{-- ===== Gallery (uploaded per-post) ===== --}}
@php
  $postImages = $post->images ?? collect();
@endphp

@if($postImages->count())
  <h4 class="section-title mt-5">Gallery</h4>

  <div class="project-gallery-carousel w3-card-4 mb-5">
    <div class="project-gallery-carousel__title">Gallery</div>

    <div class="splide " id="postGallerySplide" aria-label="Project gallery">
      <div class="splide__track">
        <ul class="splide__list">
        @foreach($postImages as $img)
          @php $src = asset('storage/'.$img->image_path); @endphp
          <li class="splide__slide">
            <div class="w-100">
              <div class="gallery-slide" role="button" tabindex="0" data-gallery-open="{{ $src }}">
                <img src="{{ $src }}" alt="Gallery image" loading="lazy" decoding="async">
              </div>
              @if(!empty($img->description))
                <div class="gallery-caption">{{ $img->description }}</div>
              @endif
            </div>
          </li>
        @endforeach
        </ul>
      </div>
    </div>

    <div class="project-gallery-carousel__nav" aria-label="Gallery navigation">
      <button type="button" class="gallery-nav-prev" aria-label="Previous image">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M15 18l-6-6 6-6"></path>
        </svg>
      </button>
      <button type="button" class="gallery-nav-next" aria-label="Next image">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M9 18l6-6-6-6"></path>
        </svg>
      </button>
    </div>
  </div>
@endif

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

<div class="hp-field" aria-hidden="true">
    <input type="text" name="website" tabindex="-1" autocomplete="off" value="">
    <input type="text" name="company_name" tabindex="-1" autocomplete="off" value="">
    <input type="hidden" name="hp_time" value="{{ now()->timestamp }}">
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
    <div class="col-12 col-md-6 mb-4">
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
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
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

<div class="modal fade gallery-modal" id="galleryLightbox" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title text-white mb-0">Preview</h5>
        <button type="button" class="gallery-modal-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body pt-0">
        <div class="gallery-modal-media">
          <button type="button" class="gallery-modal-nav gallery-modal-nav--prev" aria-label="Previous image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M15 18l-6-6 6-6"></path>
            </svg>
          </button>
          <button type="button" class="gallery-modal-nav gallery-modal-nav--next" aria-label="Next image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M9 18l6-6-6-6"></path>
            </svg>
          </button>
          <img id="galleryLightboxImg" class="gallery-modal-img" src="" alt="Preview">
        </div>
        <div id="galleryLightboxDesc" class="gallery-modal-desc"></div>
      </div>
    </div>
  </div>
</div>

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

@push('js')
<script>
  (function(){
    var modalEl = document.getElementById('galleryLightbox');
    var imgEl = document.getElementById('galleryLightboxImg');
    var descEl = document.getElementById('galleryLightboxDesc');
    var splideRoot = document.getElementById('postGallerySplide');
    if (!splideRoot) return;

    var galleryRoot = splideRoot.closest('.project-gallery-carousel');
    var nextBtn = galleryRoot ? galleryRoot.querySelector('.gallery-nav-next') : null;
    var prevBtn = galleryRoot ? galleryRoot.querySelector('.gallery-nav-prev') : null;
    var modalPrevBtn = modalEl ? modalEl.querySelector('.gallery-modal-nav--prev') : null;
    var modalNextBtn = modalEl ? modalEl.querySelector('.gallery-modal-nav--next') : null;

    var gallerySources = [];
    var galleryDescs = [];
    var currentIndex = -1;

    function openLightbox(src){
      if (!modalEl || !imgEl || !src || typeof bootstrap === 'undefined') return;
      imgEl.src = src;
      if (descEl) descEl.textContent = '';
      bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }

    function setLightboxByIndex(idx){
      if (!gallerySources.length || !imgEl) return;
      var n = gallerySources.length;
      currentIndex = ((idx % n) + n) % n;
      imgEl.src = gallerySources[currentIndex];
      if (descEl) descEl.textContent = (galleryDescs[currentIndex] || '');
    }
    function withTransition(dir, fn){
      if (!modalEl) { fn(); return; }
      modalEl.classList.add('is-switching');
      modalEl.classList.toggle('is-prev', dir === 'prev');
      modalEl.classList.toggle('is-next', dir === 'next');
      window.setTimeout(function(){
        fn();
        window.setTimeout(function(){
          modalEl.classList.remove('is-switching','is-prev','is-next');
        }, 40);
      }, 160);
    }
    function lightboxPrev(){ withTransition('prev', function(){ setLightboxByIndex(currentIndex - 1); }); }
    function lightboxNext(){ withTransition('next', function(){ setLightboxByIndex(currentIndex + 1); }); }

    // Lightbox open
    splideRoot.querySelectorAll('[data-gallery-open]').forEach(function (el) {
      var src = el.getAttribute('data-gallery-open');
      if (src) gallerySources.push(src);
      var descNode = el.closest('.w-100') ? el.closest('.w-100').querySelector('.gallery-caption') : null;
      galleryDescs.push(descNode ? (descNode.textContent || '').trim() : '');

      el.addEventListener('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        var s = el.getAttribute('data-gallery-open');
        currentIndex = gallerySources.indexOf(s);
        if (currentIndex < 0) currentIndex = 0;
        openLightbox(s);
        if (descEl) descEl.textContent = (galleryDescs[currentIndex] || '');
      }, { capture: true });
      el.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); el.click(); }
      });
    });

    // Lightbox navigation buttons
    if (modalPrevBtn) modalPrevBtn.addEventListener('click', function(e){ e.preventDefault(); lightboxPrev(); });
    if (modalNextBtn) modalNextBtn.addEventListener('click', function(e){ e.preventDefault(); lightboxNext(); });

    // Keyboard navigation inside lightbox
    if (modalEl) {
      modalEl.addEventListener('keydown', function(e){
        if (e.key === 'ArrowLeft') { e.preventDefault(); lightboxPrev(); }
        if (e.key === 'ArrowRight') { e.preventDefault(); lightboxNext(); }
        if (e.key === 'Escape') { /* bootstrap handles */ }
      });
      modalEl.addEventListener('shown.bs.modal', function(){
        // Ensure key events work even if focus isn't on buttons
        modalEl.setAttribute('tabindex', '-1');
        modalEl.focus();
        if (currentIndex < 0 && imgEl && imgEl.src) {
          currentIndex = gallerySources.indexOf(imgEl.src);
        }
        if (currentIndex >= 0 && descEl) descEl.textContent = (galleryDescs[currentIndex] || '');
      });
    }

    if (typeof Splide === 'undefined') return;

    var slideCount = splideRoot.querySelectorAll('.splide__slide').length;
    var canLoop = slideCount > 1;

    var splide = new Splide(splideRoot, {
      type: canLoop ? 'loop' : 'slide',
      focus: 'center',
      perPage: 1,                // always 1 big center
      gap: 18,
      padding: { left: '22%', right: '22%' }, // show half of left/right slides
      arrows: false,
      pagination: false,
      speed: 450,
      drag: true,
      breakpoints: {
        992: { gap: 18, padding: { left: '20%', right: '20%' } },
        576: { gap: 12, padding: { left: '14%', right: '14%' } },
      },
    });
    splide.mount();

    if (prevBtn) {
      prevBtn.onclick = function (e) { e.preventDefault(); splide.go('<'); };
    }
    if (nextBtn) {
      nextBtn.onclick = function (e) { e.preventDefault(); splide.go('>'); };
    }
  })();
</script>
@endpush