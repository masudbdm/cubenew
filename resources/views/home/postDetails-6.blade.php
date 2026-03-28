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
  height: 480px;
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
</style>
@endpush

@section('content')

<section class="py-5">
<div class="container">

<div class="row">

{{-- ================= LEFT CONTENT ================= --}}
<div class="col-md-8">

{{-- Hero --}}
<div class="project-hero mb-4">
<img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="animate-zoom">
</div>

<h2 class="mb-3">Oasis Luxury Residence</h2>

<p class="text-muted post-content">
Premium residential project designed for modern urban lifestyle.
Located in prime area with world-class amenities.
</p>

{{-- ===== Project Highlights ===== --}}
<h4 class="section-title mt-4">Project Highlights</h4>

<div class="row">
<div class="col-md-6 mb-3">
<div class="highlight-box">
<strong>Location</strong><br>
Gulshan, Dhaka
</div>
</div>
<div class="col-md-6 mb-3">
<div class="highlight-box">
<strong>Apartment Size</strong><br>
2200 – 3500 sqft
</div>
</div>
<div class="col-md-6 mb-3">
<div class="highlight-box">
<strong>Total Floors</strong><br>
G + 12
</div>
</div>
<div class="col-md-6 mb-3">
<div class="highlight-box">
<strong>Parking</strong><br>
2 Parking per unit
</div>
</div>
</div>

{{-- ===== Description ===== --}}
<h4 class="section-title mt-5">Project Description</h4>

<p class="post-content">

This luxury residential project offers spacious apartments, green
environment and premium facilities. Designed with modern architecture
and sustainable planning.

Residents will enjoy rooftop garden, gymnasium, community hall and
24/7 security.

</p>

{{-- ===== YouTube Video ===== --}}
<h4 class="section-title mt-5">Project Video</h4>

<div class="ratio ratio-16x9 mb-4 post-content">
<iframe
src="https://www.youtube.com/embed/sOnEQDvc3Gc"
allowfullscreen>
</iframe>
</div>

{{-- ===== Gallery ===== --}}
<h4 class="section-title mt-5">Project Gallery</h4>

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
</div>

{{-- ===== Google Map ===== --}}
<h4 class="section-title mt-5">Project Location</h4>

<div class="map mb-5 post-content">
<iframe
src="https://www.google.com/maps?q=Gulshan+Dhaka&output=embed">
</iframe>
</div>

</div>

{{-- ================= RIGHT SIDEBAR ================= --}}
<div class="col-md-4">

<div class="card shadow-lg post-content">
<div class="card-body">
<h5 class="mb-3">Project Enquiry</h5>

<form>
<div class="input-group input-group-outline mb-3">
<label class="form-label">Name</label>
<input type="text" class="form-control">
</div>
<div class="input-group input-group-outline mb-3">
<label class="form-label">Phone</label>
<input type="text" class="form-control">
</div>
<div class="input-group input-group-outline mb-3">
<label class="form-label">Email</label>
<input type="email" class="form-control">
</div>
<div class="input-group input-group-outline mb-3">
<label class="form-label">Message</label>
<textarea class="form-control"></textarea>
</div>

<button class="btn bg-gradient-primary w-100">
Send Enquiry
</button>

</form>
</div>
</div>

{{-- ===== Download Brochure ===== --}}
<div class="card mt-4 post-content">
<div class="card-body text-center">
<h5>Project Brochure</h5>
<a href="#" class="btn btn-warning mt-2">
<i class="fa fa-download"></i>
Download PDF
</a>
</div>
</div>

</div>



</div>

{{-- ===== Related Projects (Glassy Big Image Cards) ===== --}}
<h4 class="section-title mt-5">Related Projects</h4>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card related-card">
            <div class="card-img-wrapper">
                <img src="https://images.unsplash.com/photo-1599423300746-b62533397364" alt="Riverfront Apartments">
                <div class="glossy-overlay"></div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Riverfront Apartments</h5>
                <p class="card-text text-muted">Modern apartments with river view in Dhaka.</p>
                <a href="#" class="btn btn-sm bg-gradient-primary">View Project</a>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card related-card">
            <div class="card-img-wrapper">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" alt="Skyline Residency">
                <div class="glossy-overlay"></div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Skyline Residency</h5>
                <p class="card-text text-muted">Luxury living with rooftop amenities.</p>
                <a href="#" class="btn btn-sm bg-gradient-primary">View Project</a>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card related-card">
            <div class="card-img-wrapper">
                <img src="https://images.unsplash.com/photo-1560185127-6ed189bf02f4" alt="Green Park Residences">
                <div class="glossy-overlay"></div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Green Park Residences</h5>
                <p class="card-text text-muted">Spacious apartments with green environment.</p>
                <a href="#" class="btn btn-sm bg-gradient-primary">View Project</a>
            </div>
        </div>
    </div>
</div>


</div>


</section>

@endsection