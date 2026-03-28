@extends('home.layouts.pageMaster')

@push('css')
<style>
/* ===== Hero ===== */
.project-hero {
  position: relative;
  overflow: hidden;
  border-radius: 20px;
  box-shadow: 0 30px 60px rgba(0,0,0,0.25);
}

.project-hero img {
  width: 100%;
  height: 480px;
  object-fit: cover;
  border-radius: 20px;
  display: block;
  transition: transform 1.2s ease, filter 1.2s ease;
}

.project-hero img.animate-zoom {
  animation: zoomIn 12s ease-in-out infinite alternate;
}

@keyframes zoomIn {
  0% { transform: scale(1); filter: brightness(1); }
  50% { transform: scale(1.08); filter: brightness(1.05); }
  100% { transform: scale(1); filter: brightness(1); }
}

.project-hero::before {
  content:"";
  position:absolute;
  inset:0;
  background: linear-gradient(135deg, rgba(255,255,255,0.05), rgba(0,0,0,0.05));
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
  font-size:1.6rem;
}

.section-title::after {
  content:"";
  width:60px;
  height:4px;
  background:#3f51b5;
  display:block;
  margin-top:8px;
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
  border-radius:15px;
  padding:22px;
  border:1px solid #ddd;
  transition: all .3s ease;
  text-align:center;
  font-weight:500;
  cursor:default;
}

.highlight-box:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow:0 12px 30px rgba(0,0,0,0.18);
}

/* ===== Gallery ===== */
.gallery img {
  width:100%;
  height:180px;
  object-fit:cover;
  border-radius:15px;
  margin-bottom:15px;
  cursor:pointer;
  transition: all .4s ease;
  border:3px solid transparent;
}

.gallery img:hover {
  transform: scale(1.1);
  border-color:#3f51b5;
  box-shadow:0 15px 30px rgba(0,0,0,0.25);
}

/* ===== Map ===== */
.map iframe {
  width:100%;
  height:350px;
  border-radius:18px;
  border:0;
  transition: transform .5s ease, box-shadow .5s ease;
}

.map iframe:hover {
  transform: scale(1.03);
  box-shadow:0 18px 40px rgba(0,0,0,0.3);
}

/* ===== Body animations ===== */
.post-content p, .highlight-box, .gallery img, .map, .related-project-card {
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
.related-project-card:nth-child(1) { animation-delay:1s;}
.related-project-card:nth-child(2) { animation-delay:1.2s;}

@keyframes fadeInUp {
  to {opacity:1; transform:translateY(0);}
}

/* ===== Buttons ===== */
.btn.bg-gradient-primary {
  transition: all .35s ease;
}

.btn.bg-gradient-primary:hover {
  transform: translateY(-3px);
  box-shadow:0 12px 25px rgba(63,81,181,0.35);
}

.btn.btn-warning {
  transition: all .35s ease;
}

.btn.btn-warning:hover {
  transform: scale(1.05);
  box-shadow:0 15px 30px rgba(255,165,0,0.4);
}

/* ===== Related Projects ===== */
.related-projects {
  margin-top:50px;
}

.related-project-card {
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 15px 40px rgba(0,0,0,0.15);
  transition: transform .4s ease, box-shadow .4s ease;
  cursor:pointer;
  margin-bottom:30px;
}

.related-project-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow:0 20px 50px rgba(0,0,0,0.25);
}

.related-project-card img {
  width:100%;
  height:220px;
  object-fit:cover;
}

.related-project-card-body {
  padding:20px;
  background:#fff;
}

.related-project-card-body h5 {
  font-weight:700;
  margin-bottom:10px;
}

.related-project-card-body p {
  font-size:0.95rem;
  color:#666;
  line-height:1.5;
}

</style>
@endpush

@section('content')

<section class="py-5">
<div class="container">

<div class="row">

{{-- LEFT CONTENT --}}
<div class="col-md-8">
<div class="project-hero mb-4">
<img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="animate-zoom">
</div>

<h2 class="mb-3">Oasis Luxury Residence</h2>

<p class="text-muted post-content">
Premium residential project designed for modern urban lifestyle.
Located in prime area with world-class amenities.
</p>

<h4 class="section-title mt-4">Project Highlights</h4>
<div class="row">
<div class="col-md-6 mb-3"><div class="highlight-box">Location<br><strong>Gulshan, Dhaka</strong></div></div>
<div class="col-md-6 mb-3"><div class="highlight-box">Apartment Size<br><strong>2200 – 3500 sqft</strong></div></div>
<div class="col-md-6 mb-3"><div class="highlight-box">Total Floors<br><strong>G + 12</strong></div></div>
<div class="col-md-6 mb-3"><div class="highlight-box">Parking<br><strong>2 Parking per unit</strong></div></div>
</div>

<h4 class="section-title mt-5">Project Description</h4>
<p class="post-content">
This luxury residential project offers spacious apartments, green
environment and premium facilities. Designed with modern architecture
and sustainable planning.
Residents will enjoy rooftop garden, gymnasium, community hall and
24/7 security.
</p>

<h4 class="section-title mt-5">Project Video</h4>
<div class="ratio ratio-16x9 mb-4 post-content">
<iframe src="https://www.youtube.com/embed/sOnEQDvc3Gc" allowfullscreen></iframe>
</div>

<h4 class="section-title mt-5">Project Gallery</h4>
<div class="row gallery">
<div class="col-md-4"><img src="https://images.unsplash.com/photo-1560185127-6ed189bf02f4"></div>
<div class="col-md-4"><img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d"></div>
<div class="col-md-4"><img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c"></div>
<div class="col-md-4"><img src="https://images.unsplash.com/photo-1600573472550-8090b5e0745e"></div>
<div class="col-md-4"><img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"></div>
<div class="col-md-4"><img src="https://images.unsplash.com/photo-1600607687644-c7f34b5063c0"></div>
</div>

<h4 class="section-title mt-5">Project Location</h4>
<div class="map mb-5 post-content">
<iframe src="https://www.google.com/maps?q=Gulshan+Dhaka&output=embed"></iframe>
</div>

{{-- Related Projects --}}
<h4 class="section-title mt-5">Related Projects</h4>
<div class="row related-projects">
<div class="col-md-6">
  <div class="related-project-card post-content">
    <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914">
    <div class="related-project-card-body">
      <h5>Skyline Residency</h5>
      <p>Modern apartments in Banani, Dhaka with rooftop amenities and landscaped gardens.</p>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="related-project-card post-content">
    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be">
    <div class="related-project-card-body">
      <h5>Green Heights</h5>
      <p>Luxury apartments near Gulshan Lake featuring premium facilities and 24/7 security.</p>
    </div>
  </div>
</div>
</div>

</div>

{{-- RIGHT SIDEBAR --}}
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
<button class="btn bg-gradient-primary w-100">Send Enquiry</button>
</form>
</div>
</div>

<div class="card mt-4 post-content">
<div class="card-body text-center">
<h5>Project Brochure</h5>
<a href="#" class="btn btn-warning mt-2"><i class="fa fa-download"></i> Download PDF</a>
</div>
</div>

</div>

</div>
</div>
</section>

@endsection