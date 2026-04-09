@extends('home.layouts.master')
@push('css')


<link
href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Raleway:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap"
rel="stylesheet">
 

<style>
    .owl-dot {
        display: none !important;
    }

    element.style {
        margin-bottom: 3px;
    }

        /* .attachment-block {
                border: 1px solid #f4f4f4;
                padding: 5px;
                margin-bottom: 10px;
                background: #f7f7f7;
            } */

        /* .attachment-block .attachment-pushed {
                margin-left: 110px;
            } */
        }

        /* .attachment-block .attachment-img {
                max-width: 100px;
                max-height: 100px;
                height: auto;
                float: left;
            } */


            .page-header {
                position: relative;
                min-height: 75vh;
                width: 100%;
            }

/* Video fix */
.bg-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Overlay */
.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.20); /* চাইলে কম-বেশি করুন */
    z-index: 1;
}

/* Content above video */
.z-2 {
    z-index: 2;
}

.page-header {
    position: relative;
    z-index: 1;
}

.page-header video,
.page-header .video-overlay {
    z-index: 1;
}

.card.card-body.blur {
    position: relative;
    z-index: 10;
    background-color: #ffffff;
}

@media (max-width: 767px) {
    .video-overlay {
        background: rgba(0, 0, 0, 0.05); /* অথবা completely off */
        /* display: none;  <-- চাইলে পুরো disable */
    }
}

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

</style>

<style>
    .glass-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(255,255,255,0.25);
        backdrop-filter: blur(10px);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #344767;
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    .glass-icon:hover {
        background: #344767;
        color: #fff;
        transform: translateY(-2px);
    }


</style>

<style>
/* Mobile view fix for rotating card */
@media (max-width: 767.98px) {

  .rotating-card-container {
    margin-top: 0 !important;
  }

  .card-rotate .card-body {
    padding-top: 2rem !important;
    padding-bottom: 2rem !important;
  }

  .card-rotate .front .card-body,
  .card-rotate .back .card-body {
    padding: 2rem 1.5rem !important;
  }

  .card-rotate {
    margin-top: 1rem !important;
  }

}


/* Animated dark glowing welcome box */

.welcome-box-animated{
    width: 100%;
    max-height: 100px;
    position: relative;
    overflow: hidden;

    background: rgba(30,30,30,0.35);
    backdrop-filter: blur(8px);

    display: flex;
    align-items: center;
    justify-content: center;

    animation: welcomeFloat 5s ease-in-out infinite;
}

/* Moving inner glow */
.welcome-box-animated::before{
    content: "";
    position: absolute;

    width: 160px;
    height: 250%;

    top: -100%;
    left: -200px;

    background: linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,0.4),
        rgba(255,255,255,0.1),
        transparent
    );

    animation: welcomeGlowMove 10s linear infinite;
}

/* Text layer */
.welcome-box-animated a{
    position: relative;
    z-index: 2;
    color: black !important;
    line-height: 1.2;
}

/* Floating animation */
@keyframes welcomeFloat{
    0%,100%{
        transform: translateY(0px);
    }
    50%{
        transform: translateY(-2px);
    }
}

/* Glow movement */
@keyframes welcomeGlowMove{
    from{
        left: -200px;
    }
    to{
        left: 100%;
    }
}

/* ===============================
   Glass Spark Animated Card
================================*/
.glass-card{
    position: relative;
    height: 120px;
    border-radius: 18px;
    overflow: hidden;

    backdrop-filter: blur(14px);

    /* 🔥 Animated Glass Background */
    background: linear-gradient(
        120deg,
        rgba(255,255,255,0.75),
        rgba(240,248,255,0.65),
        rgba(255,255,255,0.75)
    );
    background-size: 200% 200%;
    animation: glassFlow 8s ease-in-out infinite;

    transition: all 0.35s ease;

    box-shadow:
        0 10px 30px rgba(0,0,0,0.06);
}

/* Hover Lift */
.glass-card:hover{
    transform: translateY(-6px) scale(1.02);
    box-shadow:
        0 20px 50px rgba(0,0,0,0.15);
}

/* Spark Shine Sweep */
.glass-card::before{
    content:"";
    position:absolute;
    top:0;
    left:-150%;
    width:60%;
    height:100%;

    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.85),
        transparent
    );

    animation: sparkMove 5s linear infinite;
}

/* 🔥 DARKER PREMIUM BORDER */
.glass-card::after{
    content:"";
    position:absolute;
    inset:0;
    border-radius:18px;
    padding:2px;

    background: linear-gradient(
        45deg,
        rgba(0,120,255,0.8),
        rgba(0,255,200,0.8),
        rgba(90,0,255,0.8)
    );

    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);

    -webkit-mask-composite: xor;
            mask-composite: exclude;

    animation: borderGlow 5s ease-in-out infinite;
}

/* Content Layer */
.glass-card .card-body{
    position: relative;
    z-index: 2;
}

/* Animations */
@keyframes sparkMove{
    0%{ left:-150%; }
    100%{ left:150%; }
}

@keyframes borderGlow{
    0%,100%{ opacity:0.7; }
    50%{ opacity:1; }
}

/* 🔥 Background Flow Animation */
@keyframes glassFlow{
    0%{ background-position: 0% 50%; }
    50%{ background-position: 100% 50%; }
    100%{ background-position: 0% 50%; }
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

/* ==============================
   PREMIUM REVIEW CARDS
============================== */

.review-card{
    display:flex;
    align-items:center;
    gap:25px;

    padding:30px;
    border-radius:20px;

    background: linear-gradient(
        135deg,
        rgba(255,255,255,0.9),
        rgba(240,248,255,0.8)
    );

    backdrop-filter: blur(12px);

    box-shadow:
        0 15px 40px rgba(0,0,0,0.08);

    transition: all .35s ease;
}

.review-card:hover{
    transform: translateY(-6px);
    box-shadow:
        0 25px 60px rgba(0,0,0,0.15);
}

/* Icon Circle */
.review-icon{
    min-width:70px;
    height:70px;
    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:32px;
    color:#fff;

    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

/* Different gradient themes */
.customer-card .review-icon{
    background: linear-gradient(135deg,#007bff,#00d4ff);
}

.land-card .review-icon{
    background: linear-gradient(135deg,#00c896,#007bff);
}

.review-content h4{
    font-weight:700;
    margin-bottom:10px;
}

.review-content p{
    margin-bottom:18px;
    opacity:.8;
}

/* Button Style */
.review-btn{
    display:inline-block;
    padding:10px 22px;
    border-radius:8px;
    font-weight:600;
    text-decoration:none;
    transition: all .3s ease;
}

.review-btn.primary{
    background: linear-gradient(135deg,#007bff,#00d4ff);
    color:#fff;
}

.review-btn.secondary{
    background: linear-gradient(135deg,#00c896,#007bff);
    color:#fff;
}

.review-btn:hover{
    transform: translateY(-3px);
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

/* Mobile Fix */
@media (max-width:768px){

    .review-card{
        flex-direction:column;
        text-align:center;
        padding:25px 20px;
    }

    .review-icon{
        margin-bottom:15px;
    }

}

/* ==============================
   PREMIUM SHADOW BANNER
============================== */

.premium-banner{
    position: relative;
    overflow: hidden;
    border-radius: 24px;

    background-size: cover;
    background-position: center;

    box-shadow:
        0 25px 60px rgba(0,0,0,0.25),
        0 8px 20px rgba(0,0,0,0.15);

    transition: all .4s ease;
}

/* Dark Glass Overlay */
.premium-banner::before{
    content:"";
    position:absolute;
    inset:0;

    background: linear-gradient(
        135deg,
        rgba(0,0,0,0.65),
        rgba(0,0,0,0.45)
    );

    backdrop-filter: blur(2px);
}

/* Inner content above overlay */
.premium-banner .container{
    position:relative;
    z-index:2;
}

/* Floating subtle glow */
.premium-banner::after{
    content:"";
    position:absolute;
    top:-30%;
    left:-30%;

    width:160%;
    height:160%;

    background: radial-gradient(
        circle at 30% 40%,
        rgba(255,255,255,0.15),
        transparent 60%
    );

    animation: bannerGlow 120s linear infinite;
}

@keyframes bannerGlow{
    0%{ transform: rotate(0deg); }
    100%{ transform: rotate(360deg); }
}

/* Text hierarchy improve */
.premium-banner h1{
    font-size: 42px;
    font-weight: 800;
    letter-spacing: 1px;
}

.premium-banner h4{
    opacity:.85;
    font-weight:500;
}

/* Button upgrade */
.premium-banner .review-btn{
    background: linear-gradient(135deg,#00c6ff,#0072ff);
    border:none;
    border-radius:8px;

    box-shadow:
        0 10px 30px rgba(0,114,255,0.4);

    transition: all .3s ease;
}

.premium-banner .review-btn:hover{
    transform: translateY(-4px);
    box-shadow:
        0 18px 40px rgba(0,114,255,0.5);
}

/* ==============================
   MOBILE OPTIMIZATION
============================== */

@media (max-width:768px){

    .premium-banner{
        padding: 40px 20px !important;
        border-radius:18px;
    }

    .premium-banner h1{
        font-size: 26px;
    }

    .premium-banner h4{
        font-size:16px;
    }

    .premium-banner .lead{
        font-size:15px;
    }

    .premium-banner{
        box-shadow:
            0 15px 35px rgba(0,0,0,0.25);
    }

}
</style>

@endpush
@section('content')
<header class="header-2 mb-4">

    @if($websiteParameter->hero_type === 'image' && $websiteParameter->featured_image)
    {{-- <img src="{{ asset($websiteParameter->featuredImage()) }}"
         width="1200" height="340"
         alt="Featured Image"> --}}

         <div class="page-header min-vh-75 relative"
         style="background-image: url({{ asset($websiteParameter->featuredImage()) }});">
         <span class="mask- bg-gradient-primary opacity-4"></span>


         <div class="container">

            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <div class="row align-items-center">

                    </div>

                </div>
            </div>


        </div>
    </div>
    @elseif($websiteParameter->hero_type === 'video' && $websiteParameter->featured_video)


    <div class="page-header min-vh-90 position-relative overflow-hidden">

        <!-- Background Video -->
        {{-- <video
        autoplay
        muted
        loop
        playsinline
        class="bg-video">
        <source src="{{ asset($websiteParameter->featuredVideo()) }}" type="video/mp4">
        </video> --}}



<video
    id="heroVideo"
    autoplay
    muted
    loop
    playsinline
    class="bg-video">
    <source src="{{ asset($websiteParameter->featuredVideo()) }}" type="video/mp4">
</video>

<button id="unmuteBtn" 
    style="position:absolute;bottom:20px;right:20px;z-index:5;"
    class="btn btn-light btn-sm">
    🔊 Sound On
</button>

        <!-- Overlay -->
        <div class="video-overlay"></div>

        <!-- Content -->
        <div class="container position-relative z-2">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">

                </div>
            </div>
        </div>

    </div>


    @endif


</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n5">

    <div class="text-center">

        <h1 class="welcome-box-animated p-2 w3-small mt-2 w3-round" style="background-color: rgba(65, 65, 65, 0.2);">

    <a href="" class="typewrite w3-large text-bolder"
       data-period="1000"
       data-type='[ {{ $websiteParameter->welcome_page_msg }} ]'>

        <span class="wrap"></span>

    </a>

</h1>

</div>

<section class="pt-3 pb-4" id="count-stats">
    <div class="container">
        <div class="row">
                     
                </div>
            </div>
        </section>

 

        <section class="mb-3">
            <div class="row">
                @foreach ($categoriesPost as $category)
                <div class="col-md-4 col-12">
                    <a href="{{ route('user.categoryDetails', $category) }}" class="text-primary icon-move-right">
                        <div class="glass-card elevation-2 mb-3 mx-2 border-success-" style="height: 120px">
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
            </section>
            {{-- End Categories --}}

         

 <section class="my-1 py-1 px-2">


            <div class="premium-banner py-6 py-md-5 my-sm-3 mb-3 border-radius-xl"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/desktop.jpg');"
                loading="lazy">
                <span class="mask bg-gradient-dark"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <h4 class="text-white">Built by expert developers</h4>
                            <h1 class="text-white">Cube Holdings Ltd</h1>
                            
                        </div>

                        <div class="col-sm-12 col-md-6 pt-4">
                            <p class="lead text-white opacity-8">Download E-Brochures of all projects</p>
                            <a href=""
                                class="review-btn text-white icon-move-right w3-border w3-round px-3 py-2">
                                E-Brochures
                                <i class="fas fa-arrow-right text-sm ms-1"></i>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
 
 </section>

            <section class="my-4 py-1">
       
                    <div class="row align-items-center">
                        <div class="col-12 col-md-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-3">
                            <div class="rotating-card-container">
                                <div
                                class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">
                                <div class="front front-background"
                                style="background-image: url(https://images.unsplash.com/photo-1569683795645-b62e50fbf103?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80); background-size: cover;">
                                <div class="card-body py-7 text-center">
                                    <i class="material-icons text-white text-4xl my-3">touch_app</i>
                                    <h3 class="text-white">Touch Here</h3>
                                    <p class="text-white opacity-8 w-100">You are welcomed to Cube holdings Ltd. We are hearing you. </p>
                                </div>
                            </div>
                            <div class="back back-background"
                            style="background-image: url(https://images.unsplash.com/photo-1498889444388-e67ea62c464b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1365&q=80); background-size: cover;">
                            <div class="card-body pt-7 text-center">
                                <h3 class="text-white">Cube Holdings Ltd</h3>
                                <p class="text-white opacity-8"> A lifestyle behind the walls—  
                    where privacy, comfort, and refined living come together.
                                </p>
                                <a href="{{ route('wantToKnowAboutProjects') }}"
                                class="btn btn-white btn-sm w-50 mx-auto mt-3">Want to know More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 mt-4 mt-md-0">
    <div class="row g-4">

    <!-- Customer Reviews -->
    <div class="col-12">
        <div class="review-card customer-card">
            <div class="review-icon">
                <i class="material-icons">groups</i>
            </div>

            <div class="review-content">
                <h4>Customer Reviews</h4>
                <p>
                    Hear directly from our valued clients about their experience
                    with our developments, service quality, and commitment to
                    delivering excellence.
                </p>

                <a href="{{ route('customerReviews') }}" class="review-btn primary">
                    View Customer Reviews
                </a>
            </div>
        </div>
    </div>

    <!-- Landowner Reviews -->
    <div class="col-12">
        <div class="review-card land-card">
            <div class="review-icon">
                <i class="material-icons">handshake</i>
            </div>

            <div class="review-content">
                <h4>Landowner Reviews</h4>
                <p>
                    Discover what our land partners say about working with us —
                    from transparent agreements to successful project delivery.
                </p>

                <a href="{{ route('landownerReviews') }}" class="review-btn secondary">
                    View Landowner Reviews
                </a>
            </div>
        </div>
    </div>

</div>
</div>
        </div>
 
</section>

 
 <section class="my-5">
     

 
        {{-- post --}}
        <div class="row mb-5">
            @foreach ($categoriesPost as $category)
            <div class="col-sm-6">
                <div class="card card-widget mb-2">
                    <div class=" w3-panel w3-leftbar w3-border-green">
                        <h3 class="card-title">
                            <a href="{{ route('user.categoryDetails',$category)}}">{{ $category->name }}</a>
                        </h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                @foreach ($category->posts as $post)
                                @if ($loop->index == 0)
                                <a class="text-muted mb-1"
                                href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}">
                                <img class="img-responsive" width="100%"
                                src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}"
                                alt="">
                                <div class="w3-container w3-light-gray">
                                    <p style="font-weight: bold;font-size: 16px;">
                                        {{ Str::limit($post->title, 40) }}</p>
                                        <p class="text-justify" style="line-height:1.2">
                                            {{ Str::limit(strip_tags($post->description), 120, '...') }}

                                        </p>
                                    </div>
                                </a>
                                @endif
                                @endforeach
                            </div>

                            <div class="col-sm-6">
                                @foreach ($category->posts->take(6) as $post)
                                @if ($loop->index > 1)

                                <div class="row py-1 my-1 w3-hover-opacity border-bottom ">

                                    <div class="col-sm-4 col-4">
                                        <a
                                        href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}">
                                        <img class="" style=""
                                        src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $post->fi()]) }}"
                                        alt="">
                                    </a>

                                </div>
                                <div class="col-sm-8 col-8">
                                    <h4 class=""
                                    style="font-size: 14px;line-height: 1.3;">
                                    <a
                                    href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}"> {{ Str::limit($post->title, 50, '...') }}</a>

                                </h4>
                            </div>
                        </div>



                        @endif
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>

 </section>


 
        @if($websiteParameter->front_team_show)
        @isset($featured_teams)

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-10 mx-auto">
                    <div class="text-center mb-4">
                        <h3 class="text-dark position-relative mb-1 w3-xxlarge">
                            Featured Projects
                        </h3>
                        <p class="text-dark mb-3">
                            <b>Our ongoing featured projects</b>
                        </p>

                        {{-- CTA Button --}}
                        <a href="{{ url('featured/projects') }}"
                        class="btn btn-outline-dark btn-sm px-4 rounded-pill">
                        See the Complete Featured Projects List.
                    </a>
                </div>
            </div>
        </div>
    </div>


    <section class="py-sm-3"  >
        <div class="bg-gradient-dark position-relative  border-radius-xl overflow-hidden">

            {{-- SVG Background --}}
            <img
            src="{{ asset('img/waves-white.svg') }}"
            alt="pattern-lines"
            class="position-absolute top-0 start-0 w-100 h-100 opacity-2"
            style="object-fit: cover;"
            >

            <div class="container py-6 position-relative z-index-2">
                <div class="row">
                    <div class="col-md-12 mx-auto">


                        <div class="row">
                            @foreach($featured_teams as $team)
                            <div class="col-lg-6 col-12 mb-4  mt-3 d-flex">

                                <div class="card card-profile team-card h-100 w-100">
                                    <div class="row h-100">

                                        {{-- Image --}}
                                        <div class="col-lg-4 col-md-5 col-12 mt-n5">
                                            <div class="p-3 pe-md-0">
                                                <img
                                                class="w-100 border-radius-md shadow-lg"
                                                src="{{ $team->image ? asset('storage/'.$team->image) : asset('img/user-placeholder.png') }}"
                                                alt="{{ $team->name }}">
                                            </div>
                                        </div>

                                        {{-- Info --}}
                                        <div class="col-lg-8 col-md-7 col-12">
                                            <div class="card-body ps-lg-0 d-flex flex-column h-100">

                                                <div>
                                                    <h5 class="mb-0 text-dark">{{ $team->name }}</h5>
                                                    <h6 class="text-info mb-2">{!! $team->designation !!}</h6>

                                                    @if($team->qualification)
                                                    <p class="mb-2 text-sm">
                                                        {{ Str::limit($team->qualification, 120) }}
                                                    </p>
                                                    @endif
                                                </div>

                                                {{-- Footer --}}
                                                <div class="mt-auto">
                                                    <div class="row align-items-center">

                                                        {{-- Left: Social Icons --}}
                                                        <div class="col-12 col-md-6 mb-2 mb-md-0">
                                                            @if(is_array($team->social_links))
                                                            <div class="team-social d-flex
                                                            justify-content-center justify-content-md-start">

                                                            @foreach (['facebook'=>'facebook-f','twitter'=>'twitter','linkedin'=>'linkedin-in'] as $key=>$icon)
                                                            @if(!empty($team->social_links[$key]))
                                                            <a href="{{ $team->social_links[$key] }}"
                                                             target="_blank"
                                                             class="glass-icon">
                                                             <i class="fab fa-{{ $icon }}"></i>
                                                         </a>
                                                         @endif
                                                         @endforeach

                                                     </div>
                                                     @endif
                                                 </div>

                                                 {{-- Right: Profile Button --}}
                                                 <div class="col-12 col-md-6 text-center text-md-end">
                                                    <a href="{{ route('team.show', $team->username) }}"
                                                     class="btn btn-sm btn-outline-info rounded-pill px-3">
                                                     View Profile
                                                 </a>
                                             </div>

                                         </div>
                                     </div>

                                 </div>
                             </div>

                         </div>
                     </div>

                 </div>
                 @endforeach
             </div>

         </div>
     </div>
 </div>
</div>
</section>

@endisset
@endif


<!-- -------- END Content Presentation Docs ------- -->

{{-- <section class="py-sm-4" id="download-soft-ui"> --}}
    {{-- <div class="position-relative m-0 border-radius-xl overflow-hidden"> --}}
        {{-- <img src="{{ asset('template/assets/img/shapes/waves-white.svg') }}" alt="pattern-lines"
        class="position-absolute start-0 top-md-0 w-100 opacity-2"> --}}
        {{-- <iframe class="img-fluid start-0 top-md-0 w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.520745380416!2d90.40099331416613!3d23.764463894157647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a6912ef2e3%3A0xae5c376c60becf51!2sPlug%20Limited!5e0!3m2!1sen!2sbd!4v1644473824527!5m2!1sen!2sbd"
                    width="1140" height="500" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe> --}}
                <div class="container- py-0 postion-relative z-index-2 position-relative">
                    <div class="row">
                        <div class="col-md-12 mx-auto- text-center">{!! $websiteParameter->google_map_code !!}</div>
                    </div>
                </div> 


                <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
        {{-- <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 ms-auto">
                        <h4 class="mb-1">Thank you for your support!</h4>
                        <p class="lead mb-0">We deliver the best web products</p>
                    </div>
                    <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-end mt-5">
                        <a href="https://twitter.com/intent/tweet?text=pluglimited.org" class="btn btn-twitter mb-0 me-2"
                            target="_blank">
                            <i class="fab fa-twitter me-1"></i> Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.pluglimited.org"
                            class="btn btn-facebook mb-0 me-2" target="_blank">
                            <i class="fab fa-facebook-square me-1"></i> Share
                        </a>
                        <a href="https://www.pinterest.com/pin/create/button/?url=https://pluglimited.org"
                            class="btn btn-pinterest mb-0 me-2" target="_blank">
                            <i class="fab fa-pinterest me-1"></i> Pin it
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
    </div>
    @endsection

    @push('js')
    <script src="https://dotlines.com.sg/vendor/cms-template/dotlines/js/jquery-3.6.0.min.js"></script>
    <script src="https://dotlines.com.sg/vendor/cms-template/dotlines/js/slider.js"></script>
    <script>
        var d_jQuery = Cog.jQuery();



        // add active class in map
        var countries = ['singapore', 'malaysia', 'indonesia', 'india', 'bangladesh', 'myanmar', 'usa', 'uae', 'panama',
            'bolivia', 'nepal', 'srilanka', 'south-africa', 'egypt', 'qatar', 'thailand'
        ];
        var counter = 0;
        setInterval(function() {
            var county_length = d_jQuery('.presence-map-point').length;
            if (county_length == counter) {
                counter = 0;
            }

            d_jQuery('.presence-map-point').removeClass('active');
            d_jQuery('.' + countries[counter]).addClass('active');
            ++counter
        }, 4000);
    </script>
{{--     <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }
            })
        });
    </script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: true,
                    autoplay: true,


                },
                600: {
                    items: 4,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                    autoplay: true,
                }
            }
        })
    </script>
    --}}


    <script>
        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
                this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (this.isDeleting) {
                delta /= 2;
            }

            if (!this.isDeleting && this.txt === fullTxt) {
                delta = this.period;
                this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
                this.isDeleting = false;
                this.loopNum++;
                delta = 500;
            }

            setTimeout(function() {
                that.tick();
            }, delta);
        };

        window.onload = function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i = 0; i < elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                    new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
            document.body.appendChild(css);
        };
    </script>

    <script>
document.getElementById('unmuteBtn').addEventListener('click', function() {
    var video = document.getElementById('heroVideo');
    video.muted = false;
    video.play();
    this.style.display = 'none';
});


document.querySelectorAll('.glass-card').forEach(card => {

    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        card.style.setProperty('--x', x + 'px');
        card.style.setProperty('--y', y + 'px');
    });

});

document.querySelectorAll('.glass-card').forEach(card => {

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
