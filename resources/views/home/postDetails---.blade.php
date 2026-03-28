@extends('home.layouts.pageMaster')

@push('css')
<style>
/* ===== Full Width Hero ===== */
.project-hero{
position:relative;
overflow:hidden;
border-radius:12px;
}

.project-hero img{
width:100%;
height:600px;
object-fit:cover;
transition:transform 1.2s ease;
}

.project-hero:hover img{
transform: scale(1.05);
}

/* ===== Animated Frame Overlay ===== */
.project-hero::after{
content:'';
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
border:10px solid rgba(255,255,255,0.2);
border-radius:12px;
pointer-events:none;
animation: pulseFrame 3s infinite alternate;
}

@keyframes pulseFrame{
0%{transform:scale(1);}
100%{transform:scale(1.02);}
}

/* ===== At-a-glance ===== */
.at-a-glance{
display:flex;
flex-wrap:wrap;
gap:15px;
margin-bottom:40px;
}

.at-a-glance .item{
flex:1 1 30%;
background:#f8f9fa;
padding:20px;
border-radius:12px;
text-align:center;
transition: transform 0.3s;
cursor:pointer;
}

.at-a-glance .item:hover{
transform:translateY(-5px);
}

/* ===== Project Details ===== */
.project-details{
margin-bottom:50px;
}

.project-details p{
line-height:1.7;
}

/* ===== Gallery ===== */
.gallery-modern{
position:relative;
display:flex;
overflow:hidden;
gap:10px;
}

.gallery-modern img{
width:150px;
height:150px;
object-fit:cover;
border-radius:12px;
cursor:pointer;
transition:0.3s;
}

.gallery-modern img:hover{
transform:scale(1.1);
}

/* Lightbox arrows */
#galleryLightbox .modal-content{
background:none;
border:none;
}
#galleryLightbox .modal-body{
position:relative;
padding:0;
text-align:center;
}
#galleryLightbox .arrow{
position:absolute;
top:50%;
transform:translateY(-50%);
font-size:2rem;
color:white;
cursor:pointer;
user-select:none;
z-index:10;
padding:0 15px;
}

#galleryLightbox .arrow.left{
left:0;
}
#galleryLightbox .arrow.right{
right:0;
}

/* Floor Plan */
.floor-plan{
display:flex;
flex-wrap:wrap;
gap:15px;
margin-bottom:40px;
}

.floor-plan img{
width:100%;
max-height:300px;
object-fit:cover;
border-radius:12px;
}

/* Google Map */
.map iframe{
width:100%;
height:400px;
border-radius:12px;
border:0;
}

/* Sidebar Form */
.sticky-sidebar{
position:sticky;
top:100px;
}

/* Buttons */
.btn-primary-custom{
background:#0069d9;
color:white;
border:none;
border-radius:8px;
padding:10px 25px;
transition:0.3s;
}

.btn-primary-custom:hover{
background:#0053b3;
}

</style>
@endpush

@section('content')

<section class="py-5">
<div class="container-fluid" style="max-width:1400px;">

<div class="row">

{{-- ================= LEFT ================= --}}
<div class="col-lg-8">

{{-- Hero --}}
<div class="project-hero mb-5">
<img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" alt="Project Hero">
</div>

{{-- At-a-glance --}}
<div class="at-a-glance mb-5">
<div class="item"><strong>Location</strong><br>Gulshan, Dhaka</div>
<div class="item"><strong>Apartment Size</strong><br>2200 – 3500 sqft</div>
<div class="item"><strong>Total Floors</strong><br>G + 12</div>
<div class="item"><strong>Parking</strong><br>2 per unit</div>
<div class="item"><strong>Possession</strong><br>2027</div>
</div>

{{-- Project Details --}}
<div class="project-details mb-5">
<h3>Project Details</h3>
<p>This luxury residential project offers spacious apartments, green environment, and premium facilities. Designed with modern architecture and sustainable planning. Residents will enjoy rooftop garden, gymnasium, community hall, and 24/7 security.</p>
</div>

{{-- Floor Plan --}}
<h4>Floor Plans</h4>
<div class="floor-plan mb-5">
<img src="https://images.unsplash.com/photo-1560185127-6ed189bf02f4" alt="Floor Plan 1">
<img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d" alt="Floor Plan 2">
</div>

{{-- Gallery Modern --}}
<h4>Project Gallery</h4>
<div class="gallery-modern mb-5">
@php
$images=[
"https://images.unsplash.com/photo-1560185127-6ed189bf02f4",
"https://images.unsplash.com/photo-1600585154526-990dced4db0d",
"https://images.unsplash.com/photo-1600607687939-ce8a6c25118c",
"https://images.unsplash.com/photo-1600573472550-8090b5e0745e",
"https://images.unsplash.com/photo-1600585154340-be6161a56a0c",
"https://images.unsplash.com/photo-1600607687644-c7f34b5063c0"
];
@endphp
@foreach($images as $img)
<img src="{{$img}}" onclick="openGallery({{ $loop->index }})" data-index="{{ $loop->index }}">
@endforeach
</div>

{{-- Lightbox Modal --}}
<div class="modal fade" id="galleryLightbox">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content">
<div class="modal-body p-0">
<span class="arrow left" onclick="prevImage()">&#10094;</span>
<img id="lightboxImg" src="" style="width:100%;border-radius:12px;">
<span class="arrow right" onclick="nextImage()">&#10095;</span>
</div>
</div>
</div>
</div>

{{-- YouTube Video --}}
<h4>Project Video</h4>
<div class="ratio ratio-16x9 mb-5">
<iframe src="https://www.youtube.com/embed/Rn4oK4q0c3o?autoplay=1&rel=0" allowfullscreen></iframe>
</div>

{{-- Brochure --}}
<div class="mb-5">
<a href="#" class="btn btn-primary-custom"><i class="fa fa-download"></i> Download Brochure</a>
</div>

{{-- Google Map --}}
<h4>Project Location</h4>
<div class="map mb-5">
<iframe src="https://www.google.com/maps?q=Gulshan+Dhaka&output=embed"></iframe>
</div>

</div>

{{-- ================= RIGHT SIDEBAR ================= --}}
<div class="col-lg-4">
<div class="sticky-sidebar">

<div class="card shadow mb-4">
<div class="card-body">
<h5>Request a Quote / Enquiry</h5>
<form>
<div class="mb-3">
<label>Name</label>
<input type="text" class="form-control">
</div>
<div class="mb-3">
<label>Phone</label>
<input type="text" class="form-control">
</div>
<div class="mb-3">
<label>Email</label>
<input type="email" class="form-control">
</div>
<div class="mb-3">
<label>Message</label>
<textarea class="form-control"></textarea>
</div>
<button class="btn btn-primary-custom w-100">Send Request</button>
</form>
</div>
</div>

</div>
</div>

</div>
</div>
</section>

@endsection

@push('js')
<script>
let galleryImages=@json($images);
let currentIndex=0;

function openGallery(index){
currentIndex=index;
document.getElementById('lightboxImg').src=galleryImages[currentIndex];
let modal=new bootstrap.Modal(document.getElementById('galleryLightbox'));
modal.show();
}

function prevImage(){
currentIndex=(currentIndex-1+galleryImages.length)%galleryImages.length;
document.getElementById('lightboxImg').src=galleryImages[currentIndex];
}

function nextImage(){
currentIndex=(currentIndex+1)%galleryImages.length;
document.getElementById('lightboxImg').src=galleryImages[currentIndex];
}
</script>
@endpush