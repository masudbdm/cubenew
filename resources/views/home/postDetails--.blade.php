@extends('home.layouts.pageMaster')

@push('css')
<style>

/* ===== Hero ===== */
.project-hero img{
width:100%;
height:480px;
object-fit:cover;
border-radius:12px;
}

/* ===== Section title ===== */
.section-title{
font-weight:700;
margin-bottom:20px;
}

/* ===== Highlight box ===== */
.highlight-box{
background:#f8f9fa;
border-radius:10px;
padding:20px;
border:1px solid #eee;
}

/* ===== Gallery ===== */
.gallery img{
width:100%;
height:180px;
object-fit:cover;
border-radius:10px;
margin-bottom:15px;
cursor:pointer;
transition:.3s;
}

.gallery img:hover{
transform:scale(1.04);
}

/* ===== Map ===== */
.map iframe{
width:100%;
height:350px;
border-radius:12px;
border:0;
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

<img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c">

</div>

<h2 class="mb-3">Oasis Luxury Residence</h2>

<p class="text-muted">
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

<p>

This luxury residential project offers spacious apartments, green
environment and premium facilities. Designed with modern architecture
and sustainable planning.

Residents will enjoy rooftop garden, gymnasium, community hall and
24/7 security.

</p>


{{-- ===== YouTube Video ===== --}}
<h4 class="section-title mt-5">Project Video</h4>

<div class="ratio ratio-16x9 mb-4">

<iframe
src="https://www.youtube.com/embed/ysz5S6PUM-U"
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

<div class="map mb-5">

<iframe
src="https://www.google.com/maps?q=Gulshan+Dhaka&output=embed">
</iframe>

</div>


</div>



{{-- ================= RIGHT SIDEBAR ================= --}}
<div class="col-md-4">


<div class="card shadow-lg">

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
<div class="card mt-4">

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
</div>
</section>

@endsection