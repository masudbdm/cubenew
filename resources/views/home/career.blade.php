@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush
@push('css')
<style>

/* HERO */

.career-hero{
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
color:#fff;
padding:110px 0;
text-align:center;
}

.career-hero h1{
font-size:46px;
font-weight:700;
letter-spacing:1px;
}

.career-hero p{
max-width:700px;
margin:auto;
font-size:18px;
opacity:.9;
}


/* SECTION */

.section-title{
text-align:center;
margin-bottom:60px;
}

.section-title h2{
font-weight:700;
}


/* CARD */

.info-card{
background:#fff;
border-radius:14px;
padding:35px;
height:100%;
box-shadow:0 15px 35px rgba(0,0,0,0.08);
transition:.4s;
position:relative;
overflow:hidden;
}

.info-card:hover{
transform:translateY(-10px);
box-shadow:0 25px 60px rgba(0,0,0,0.12);
}

/* glow effect */

.info-card:before{
content:'';
position:absolute;
width:120%;
height:120%;
background:linear-gradient(120deg,transparent,rgba(255,255,255,.4),transparent);
top:-20%;
left:-20%;
transform:rotate(25deg);
opacity:0;
transition:.5s;
}

.info-card:hover:before{
opacity:1;
left:120%;
}


/* EMAIL CARD */
/* EMAIL CARD (GLASS BLACK STYLE) */

.email-card{

background:rgba(25,25,25,0.85);
backdrop-filter:blur(12px);
-webkit-backdrop-filter:blur(12px);

color:#fff;

border-radius:16px;
padding:50px 45px;
text-align:center;

border:1px solid rgba(255,255,255,0.08);

box-shadow:
0 25px 60px rgba(0,0,0,0.35),
inset 0 1px 0 rgba(255,255,255,0.06);

transition:.4s;
position:relative;
overflow:hidden;

}

/* glow animation */

.email-card:before{

content:"";
position:absolute;

width:140%;
height:140%;

background:linear-gradient(
120deg,
transparent,
rgba(255,255,255,.15),
transparent
);

top:-30%;
left:-30%;

transform:rotate(25deg);

opacity:0;
transition:.6s;

}

.email-card:hover:before{

opacity:1;
left:120%;

}

.email-card:hover{

transform:translateY(-6px) scale(1.02);

box-shadow:
0 35px 70px rgba(0,0,0,0.45);

}

/* EMAIL BUTTON */

.email-btn{

display:inline-block;

margin-top:25px;

padding:13px 34px;

background:linear-gradient(135deg,#ffffff,#e9e9e9);

color:#111;

font-weight:600;

border-radius:40px;

text-decoration:none;

transition:.3s;

}

.email-btn:hover{

transform:translateY(-3px);

box-shadow:0 10px 25px rgba(0,0,0,0.35);

}
 
/* MOBILE OPTIMIZATION */

@media (max-width:768px){

.career-hero{
padding:70px 15px;
}

.career-hero h1{
font-size:30px;
}

.career-hero p{
font-size:16px;
}

/* main card */

.card.card-body{
padding:20px !important;
margin-top:-40px !important;
}

/* section container */

.section-title{
margin-bottom:30px;
}

/* cards */

.info-card{
padding:20px;
}

/* email card */

.email-card{
padding:30px 20px;
}

.container{
padding-left:12px;
padding-right:12px;
}

}
/* ANIMATED TITLE */

.animated-title{

font-weight:700;

background:linear-gradient(
90deg,
#ffffff,
#ffffff,
#bbbbbb,
#ffffff,
#ffffff
);

background-size:300%;

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

animation:shineText 4s linear infinite;

}

@keyframes shineText{

0%{
background-position:0%;
}

100%{
background-position:300%;
}

}

</style>
@endpush


@section('content')
 

<section class="page-header min-vh-65 career-hero">

<div class="container">

<h1>Careers at Cube Holdings Limited</h1>

<p>
Join a forward-thinking organization where innovation, integrity,
and excellence drive everything we do.
</p>

</div>

</section>

<div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6 py-5">

    <section class="pb-2 position-relative bg-light mx-n3 mb-2 mt-2">
        <div class="container">

            <div class="row">
                <div class="col-md-12  text-start">



{{-- ABOUT COMPANY --}}
<div class="container mt-5">

<div class="section-title">
<h2>Why Work With Us</h2>
<p>
Cube Holdings Limited is committed to building a professional,
innovative and collaborative workplace.
</p>
</div>


<div class="row g-4">

<div class="col-md-4">

<div class="info-card">

<h5>Innovative Environment</h5>

<p>
At Cube Holdings Limited we continuously encourage creativity,
innovation and new ideas that help drive business success.
</p>

</div>

</div>



<div class="col-md-4">

<div class="info-card">

<h5>Professional Growth</h5>

<p>
We believe in developing our team members by providing
opportunities for learning, growth and leadership.
</p>

</div>

</div>



<div class="col-md-4">

<div class="info-card">

<h5>Team Collaboration</h5>

<p>
Our culture promotes collaboration and teamwork,
ensuring every member contributes to collective success.
</p>

</div>

</div>



<div class="col-md-4">

<div class="info-card">

<h5>Integrity & Excellence</h5>

<p>
We operate with strong values and maintain the highest
standards in every project we undertake.
</p>

</div>

</div>



<div class="col-md-4">

<div class="info-card">

<h5>Work-Life Balance</h5>

<p>
We respect the balance between professional responsibilities
and personal well-being.
</p>

</div>

</div>



<div class="col-md-4">

<div class="info-card">

<h5>Future Opportunities</h5>

<p>
Cube Holdings Limited continues to grow,
creating exciting career opportunities for talented individuals.
</p>

</div>

</div>

</div>

</div>



{{-- APPLY EMAIL CARD --}}
<div class="container mt-5 mb-5">

<div class="email-card">

<h3 class="w3-xxlarge animated-title">Send Your CV</h3>


<p>
If you are passionate about building your career with
Cube Holdings Limited, send your resume to our HR team.
</p>

<a href="mailto:{{ $websiteParameter->contact_email }}"
class="email-btn">

Apply via Email  
{{ $websiteParameter->contact_email }}

</a>

</div>

</div>


                     

                </div>
            </div>
        </div>
    </section>
</div>
 
@endsection
