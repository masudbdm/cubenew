@extends('home.layouts.pageMaster')
@push('meta')
<meta property="og:type" content="website">
@endpush

@push('css')
<style>
    /* GLASS HEADER */

.glass-header{

background:rgba(255,255,255,0.15);

backdrop-filter:blur(10px);

border-bottom:1px solid rgba(255,255,255,0.3);

}

.brochure-table th{

font-weight:700;

color:#344767;

}



/* IMAGE PREVIEW */

.img-preview{

position:relative;

width:60px;

}

.preview-thumb{

width:60px;

border-radius:6px;

cursor:pointer;

}

.hover-preview{

display:none;

position:absolute;

top:-20px;

left:70px;

z-index:10;

box-shadow:0 15px 40px rgba(0,0,0,.2);

}

.hover-preview img{

width:200px;

border-radius:10px;

}

.img-preview:hover .hover-preview{

display:block;

}



/* DOWNLOAD BUTTON */

.download-btn{

position:relative;

display:inline-flex;

align-items:center;

gap:8px;

padding:8px 18px;

border-radius:30px;

background:linear-gradient(135deg,#4facfe,#00f2fe);

color:#fff;

font-weight:600;

overflow:hidden;

transition:.3s;

}

.download-btn:hover{

transform:translateY(-2px);

box-shadow:0 8px 25px rgba(0,0,0,.2);

}



/* WAVE EFFECT */

.download-wave{

position:absolute;

width:100%;

height:100%;

background:rgba(255,255,255,.25);

top:0;

left:-100%;

transition:.4s;

}

.download-btn:hover .download-wave{

left:100%;

}



/* DOWNLOAD COUNT */

.download-count{

font-size:12px;

color:#888;

margin-top:6px;

}
</style>
@endpush
@section('content')

    <header class="bg-gradient-dark">
        <div class="page-header min-vh-75" style="background-image: url(' {{ asset('img/cover2.png') }} ');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mx-auto my-auto">
                        <h1 class="text-white">All E-Brochures</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">

<div class="table-responsive">

<table class="table brochure-table align-items-center">

<thead class="glass-header">
<tr>
<th>Project</th>
<th>Location</th>
<th>Preview</th>
<th class="text-center">Download</th>
</tr>
</thead>

<tbody>

@foreach ($brochures as $brochure)

@php
$filePath = asset('storage/media/brochure/'.$brochure->brochure_file);
$ext = strtolower(pathinfo($brochure->brochure_file, PATHINFO_EXTENSION));

$icons = [
'pdf' => 'fa-file-pdf text-danger',
'doc' => 'fa-file-word text-primary',
'docx' => 'fa-file-word text-primary',
'jpg' => 'fa-file-image text-success',
'jpeg' => 'fa-file-image text-success',
'png' => 'fa-file-image text-success',
'webp' => 'fa-file-image text-success',
];

$icon = $icons[$ext] ?? 'fa-file text-secondary';
@endphp

<tr>

<td>
<strong>{{ $brochure->title }}</strong>
</td>

<td>
{{ optional($brochure->location)->title }}
</td>

<td>

@if(in_array($ext,['jpg','jpeg','png','webp']))

<div class="img-preview">

<img src="{{ $filePath }}" class="preview-thumb">

<div class="hover-preview">
<img src="{{ $filePath }}">
</div>

</div>

@elseif($ext == 'pdf')

<button class="btn btn-sm btn-outline-primary preview-btn"
onclick="openPdfPreview('{{ $filePath }}')">

<i class="fas fa-eye"></i> Preview

</button>

@else

<i class="fas {{ $icon }}"></i> {{ strtoupper($ext) }}

@endif

</td>

<td class="text-center">

<a href="{{ $filePath }}"
target="_blank"
class="download-btn">

<i class="fas fa-download"></i>

<span>Download</span>

<div class="download-wave"></div>

</a>
 

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-4">
{{ $brochures->links() }}
</div>

</div>

<div class="modal fade" id="pdfPreviewModal">

<div class="modal-dialog modal-xl modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">
<h5>Brochure Preview</h5>
<button class="btn-close text-danger" data-bs-dismiss="modal">x</button>
</div>

<div class="modal-body p-0">

<iframe id="pdfFrame"
style="width:100%;height:80vh;border:0;"></iframe>

</div>

</div>

</div>

</div>



 

    {{-- @isset($brochures)
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            @foreach ($brochures as $brochure)
                 
                <section class="pb-5 position-relative mx-n3">
                    <div class="container">
                        <div class="row mb-0">
                            <div class="col-md-8 text-start mb-5 mt-2">
                                <h3 class="text-black z-index-1 position-relative">{!! $brochure->title !!}</h3>

                            </div>
                        </div>

                        {!! $brochure->content !!}
                    </div>
                </section>
            @endforeach
        </div>
    @endisset --}}

@endsection
@push('js')
<script>
    function openPdfPreview(url){

document.getElementById('pdfFrame').src = url;

var modal = new bootstrap.Modal(document.getElementById('pdfPreviewModal'));

modal.show();

}
</script>
@endpush
