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
  /* Home masonry (below count section) */
  .home-masonry {
    column-gap: 18px;
  }
  .home-masonry__item {
    break-inside: avoid;
    margin: 0 0 18px;
  }
  .home-masonry__card {
    display: block;
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    background: #eef1f6;
    border: 1px solid rgba(0,0,0,.06);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    transform: translateZ(0);
    transition: transform .35s ease, box-shadow .35s ease, filter .35s ease;
  }
  .home-masonry__card:hover{
    transform: translateY(-4px);
    box-shadow: 0 18px 44px rgba(15, 23, 42, 0.14);
  }
  .home-masonry__img {
    width: 100%;
    display: block;
    object-fit: cover;
    filter: saturate(1.02) contrast(1.02);
    transition: transform .6s ease;
    transform: scale(1.02);
    will-change: transform;
    animation: homeMasonryZoom 12s ease-in-out infinite alternate;
  }

  /* Slightly different timing per tile (subtle variety) */
  .home-masonry__item:nth-child(3n) .home-masonry__img { animation-duration: 14s; }
  .home-masonry__item:nth-child(4n) .home-masonry__img { animation-duration: 16s; }
  .home-masonry__item:nth-child(5n) .home-masonry__img { animation-duration: 18s; }
  .home-masonry__item:nth-child(2n) .home-masonry__img { animation-delay: -4s; }
  .home-masonry__item:nth-child(3n) .home-masonry__img { animation-delay: -7s; }

  /* Hover: pause animation + slightly stronger zoom */
  .home-masonry__card:hover .home-masonry__img{
    animation-play-state: paused;
    transform: scale(1.06);
  }

  @keyframes homeMasonryZoom{
    from { transform: scale(1.02); }
    to { transform: scale(1.10); }
  }

  /* Varying heights (cycles) */
  .home-masonry__img.h-1 { height: 180px; }
  .home-masonry__img.h-2 { height: 260px; }
  .home-masonry__img.h-3 { height: 340px; }
  .home-masonry__img.h-4 { height: 220px; }
  .home-masonry__img.h-5 { height: 300px; }

  .home-masonry__overlay{
    position:absolute;
    inset:0;
    display:flex;
    align-items:flex-end;
    padding: 14px;
    background: linear-gradient(180deg, rgba(0,0,0,0) 45%, rgba(0,0,0,0.72) 100%);
    opacity: 0;
    transition: opacity .25s ease;
  }
  .home-masonry__card:hover .home-masonry__overlay{ opacity: 1; }
  .home-masonry__title{
    color:#fff;
    font-weight: 700;
    font-size: 14px;
    line-height: 1.25;
    margin: 0 0 6px;
    text-shadow: 0 6px 22px rgba(0,0,0,.35);
  }
  .home-masonry__meta{
    color: rgba(255,255,255,.92);
    font-size: 12px;
    display:flex;
    flex-wrap: wrap;
    gap: 8px 10px;
  }
  .home-masonry__meta span{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding: 4px 8px;
    border-radius: 999px;
    background: rgba(255,255,255,.14);
    backdrop-filter: blur(8px);
  }
  .home-masonry__meta i{
    font-size: 12px;
    opacity: .95;
  }

  /* Responsive columns */
  @media (min-width: 1200px) { .home-masonry{ column-count: 4; } }
  @media (min-width: 992px) and (max-width: 1199.98px) { .home-masonry{ column-count: 3; } }
  @media (min-width: 768px) and (max-width: 991.98px) { .home-masonry{ column-count: 2; } }
  @media (max-width: 767.98px) { .home-masonry{ column-count: 1; column-gap: 14px; } }

  @media (prefers-reduced-motion: reduce){
    .home-masonry__card,
    .home-masonry__img,
    .home-masonry__overlay{
      transition: none !important;
    }
    .home-masonry__img{
      animation: none !important;
      transform: none !important;
    }
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
<style>

/* ========== Homepage project search — premium animated ========== */
.project-search-wrap {
    position: relative;
    perspective: 1200px;
    z-index: 30; /* keep dropdown above following sections */
}

.project-search-wrap .container {
    position: relative;
    z-index: 1;
}

.project-search-wrap .project-search-form .row {
    overflow: visible;
}

.brochures-banner-wrap {
    position: relative;
    z-index: 1;
}

.project-search-shell {
    position: relative;
    border-radius: 1.5rem;
    padding: 2px;
    overflow: visible;
    z-index: 31;
    background: linear-gradient(
        125deg,
        rgba(255, 255, 255, 0.95),
        rgba(248, 250, 252, 0.88),
        rgba(255, 255, 255, 0.92)
    );
    box-shadow:
        0 4px 6px rgba(15, 23, 42, 0.04),
        0 24px 48px rgba(15, 23, 42, 0.08),
        0 0 0 1px rgba(255, 255, 255, 0.8) inset;
    animation: psShellIn 0.85s cubic-bezier(0.22, 1, 0.36, 1) both;
}

.project-search-shell::before {
    content: "";
    position: absolute;
    inset: -2px;
    border-radius: inherit;
    padding: 2px;
    background: linear-gradient(
        var(--ps-angle, 135deg),
        {{ $websiteParameter->primary_color }}88,
        {{ $websiteParameter->secondary_color ?? $websiteParameter->primary_color }}aa,
        #6366f1aa,
        {{ $websiteParameter->primary_color }}99
    );
    background-size: 300% 300%;
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    animation: psBorderFlow 8s ease infinite;
    z-index: 0;
    pointer-events: none;
}

.project-search-shell::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: calc(1.5rem - 2px);
    background:
        radial-gradient(ellipse 80% 60% at 10% 0%, rgba(255, 255, 255, 0.65), transparent 50%),
        radial-gradient(ellipse 70% 50% at 100% 100%, {{ $websiteParameter->primary_color }}18, transparent 55%),
        linear-gradient(165deg, rgba(255, 255, 255, 0.92) 0%, rgba(248, 250, 252, 0.85) 100%);
    z-index: 0;
    pointer-events: none;
}

.project-search-shell__glow {
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, {{ $websiteParameter->primary_color }}35 0%, transparent 70%);
    top: -80px;
    right: -40px;
    filter: blur(20px);
    animation: psOrbFloat 9s ease-in-out infinite;
    pointer-events: none;
    z-index: 0;
}

.project-search-shell__glow--2 {
    width: 160px;
    height: 160px;
    left: -50px;
    bottom: -60px;
    top: auto;
    right: auto;
    background: radial-gradient(circle, {{ $websiteParameter->secondary_color ?? $websiteParameter->primary_color }}30 0%, transparent 70%);
    animation-delay: -4s;
    animation-duration: 11s;
}

.project-search-shell__inner {
    position: relative;
    z-index: 2;
    padding: 1.5rem 1.35rem 1.6rem;
    border-radius: calc(1.5rem - 2px);
}

@media (min-width: 768px) {
    .project-search-shell__inner {
        padding: 1.75rem 1.85rem 1.85rem;
    }
}

.project-search-head {
    margin-bottom: 1.25rem;
    text-align: center;
}

@media (min-width: 768px) {
    .project-search-head {
        text-align: left;
        margin-bottom: 1.35rem;
    }
}

.project-search-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 0.85rem;
    border-radius: 100px;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: {{ $websiteParameter->primary_color }};
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.65));
    border: 1px solid rgba(0, 0, 0, 0.06);
    box-shadow: 0 2px 12px rgba(15, 23, 42, 0.06);
    animation: psBadgePulse 3.5s ease-in-out infinite;
}

.project-search-title {
    font-family: 'Bebas Neue', 'Raleway', sans-serif;
    font-size: clamp(1.65rem, 4vw, 2.15rem);
    line-height: 1.15;
    margin: 0.65rem 0 0.35rem;
    letter-spacing: 0.02em;
    background: linear-gradient(
        120deg,
        #1e293b 0%,
        #334155 40%,
        {{ $websiteParameter->primary_color }} 100%
    );
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: psTitleShine 6s ease-in-out infinite;
}

.project-search-lead {
    margin: 0;
    font-size: 0.9rem;
    color: #64748b;
    max-width: 36rem;
}

@media (min-width: 768px) {
    .project-search-lead {
        margin-left: 0;
    }
}

.project-search-wrap .ps-field {
    position: relative;
    overflow: visible;
    z-index: 1;
}

.project-search-wrap .ps-field:has(.project-search-choices.is-open) {
    z-index: 50;
}

.ps-field label {
    display: block;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 0.45rem;
    transition: color 0.25s ease;
}

.ps-field:focus-within label {
    color: {{ $websiteParameter->primary_color }};
}

.ps-select-wrap {
    position: relative;
    display: flex;
    align-items: stretch;
    border-radius: 0.85rem;
    background: rgba(255, 255, 255, 0.85);
    border: 1px solid rgba(15, 23, 42, 0.08);
    box-shadow:
        0 1px 2px rgba(15, 23, 42, 0.04),
        0 0 0 0 rgba(99, 102, 241, 0);
    transition:
        box-shadow 0.35s cubic-bezier(0.22, 1, 0.36, 1),
        border-color 0.25s ease,
        transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
    overflow: visible;
}

.ps-select-wrap:hover {
    border-color: rgba(99, 102, 241, 0.25);
    box-shadow:
        0 4px 16px rgba(15, 23, 42, 0.07),
        0 0 0 3px {{ $websiteParameter->primary_color }}14;
    transform: none;
}

.ps-field:focus-within .ps-select-wrap {
    border-color: {{ $websiteParameter->primary_color }}55;
    box-shadow:
        0 8px 24px rgba(15, 23, 42, 0.1),
        0 0 0 4px {{ $websiteParameter->primary_color }}22;
    transform: none;
}

.ps-select-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.65rem;
    flex-shrink: 0;
    color: {{ $websiteParameter->primary_color }};
    font-size: 0.95rem;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.5), rgba(248, 250, 252, 0.3));
    border-right: 1px solid rgba(15, 23, 42, 0.06);
}

.ps-select {
    flex: 1;
    min-width: 0;
    border: none !important;
    background: transparent !important;
    padding: 0.72rem 2.25rem 0.72rem 0.65rem !important;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #1e293b;
    border-radius: 0 !important;
    box-shadow: none !important;
    appearance: none;
    cursor: pointer;
    transition: color 0.2s ease;
}

.ps-select:focus {
    outline: none;
}

.ps-select-wrap::after {
    content: "\f078";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    right: 0.95rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.65rem;
    color: #94a3b8;
    pointer-events: none;
    transition: transform 0.3s ease, color 0.2s ease;
}

.ps-field:focus-within .ps-select-wrap::after {
    color: {{ $websiteParameter->primary_color }};
    transform: translateY(-50%) rotate(180deg);
}

/* Choices.js — custom rounded lucrative dropdown (scoped) */
.project-search-wrap .project-search-choices {
    position: relative;
    flex: 1 1 0;
    min-width: 0;
    margin-bottom: 0 !important;
}

.project-search-wrap .project-search-choices .choices__inner {
    min-height: 48px;
    padding: 0.55rem 2.5rem 0.55rem 0.75rem !important;
    border-radius: 0 0.7rem 0.7rem 0 !important;
    border: none !important;
    background: transparent !important;
    background-image: none !important;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #1e293b;
    vertical-align: middle;
    box-shadow: none !important;
}

.project-search-wrap .project-search-choices .choices__list--single {
    padding: 0 !important;
}

.project-search-wrap .project-search-choices .choices__list--single .choices__item {
    margin-bottom: 0 !important;
}

.project-search-wrap .project-search-choices .choices__list--single .choices__item--selectable {
    margin-bottom: 0 !important;
}

.project-search-wrap .project-search-choices.is-focused .choices__inner,
.project-search-wrap .project-search-choices:focus .choices__inner {
    box-shadow: none !important;
}

.project-search-wrap .project-search-choices[data-type*="select-one"] .choices__inner {
    padding-bottom: 0.55rem !important;
}

.project-search-wrap .project-search-choices .choices__list--dropdown {
    /* Ensure closed by default (Choices toggles .is-open) */
    visibility: hidden;
    opacity: 0;
    pointer-events: none;
    transform: translateY(-6px) scale(0.99);
    transition: opacity 0.18s ease, transform 0.22s cubic-bezier(0.22, 1, 0.36, 1), visibility 0s linear 0.22s;

    /* Force dropdown overlay (no layout push) */
    position: absolute !important;
    left: 0 !important;
    right: 0 !important;
    top: 100% !important;

    margin-top: 0.45rem !important;
    border-radius: 1rem !important;
    border: 1px solid rgba(15, 23, 42, 0.08) !important;
    background: rgba(255, 255, 255, 0.97) !important;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    box-shadow:
        0 4px 6px rgba(15, 23, 42, 0.04),
        0 18px 40px rgba(15, 23, 42, 0.12),
        0 0 0 1px rgba(255, 255, 255, 0.9) inset !important;
    overflow: hidden;
    z-index: 9999 !important;
}

.project-search-wrap .project-search-choices.is-open .choices__list--dropdown {
    visibility: visible;
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0) scale(1);
    transition-delay: 0s;
    animation: psChoicesReveal 0.28s cubic-bezier(0.22, 1, 0.36, 1) both;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__list,
.project-search-wrap .project-search-choices .choices__list--dropdown {
    max-height: 280px !important;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__list {
    max-height: 280px !important;
    overflow-y: auto !important;
    overscroll-behavior: contain;
    padding: 0.35rem 0 !important;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__item {
    word-break: break-word;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__item--choice {
    padding: 0.7rem 1rem !important;
    margin: 0.2rem 0.45rem !important;
    border-radius: 0.65rem !important;
    font-size: 0.9rem;
    font-weight: 600;
    color: #0f172a;
    background: transparent;
    transition: background 0.2s ease, color 0.2s ease, transform 0.15s ease;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__item--choice.is-highlighted {
    background: linear-gradient(
        135deg,
        {{ $websiteParameter->primary_color }}18,
        {{ $websiteParameter->secondary_color ?? $websiteParameter->primary_color }}12
    ) !important;
    color: #0f172a !important;
    transform: translateY(-1px);
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__item--choice:hover {
    background: rgba(248, 250, 252, 0.95) !important;
}

/* Hide the older selectable rule if it exists (Choices v9 uses __item--choice) */
.project-search-wrap .project-search-choices .choices__list--dropdown .choices__item--selectable {
    padding: 0.72rem 1rem !important;
    margin: 0.2rem 0.45rem !important;
    border-radius: 0.65rem !important;
    font-size: 0.9rem;
    font-weight: 500;
    color: #334155;
    transition: background 0.2s ease, color 0.2s ease, transform 0.15s ease;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__item--selectable.is-highlighted {
    background: linear-gradient(
        135deg,
        {{ $websiteParameter->primary_color }}18,
        {{ $websiteParameter->secondary_color ?? $websiteParameter->primary_color }}12
    ) !important;
    color: #0f172a !important;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__item--selectable:hover {
    background: rgba(248, 250, 252, 0.95) !important;
}

.project-search-wrap .project-search-choices .choices__list--dropdown .choices__placeholder {
    opacity: 0.55;
}

.project-search-wrap .project-search-choices::after {
    content: "\f078";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    right: 0.95rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.65rem;
    color: #94a3b8;
    pointer-events: none;
    transition: transform 0.3s ease, color 0.2s ease;
    z-index: 3;
}

.project-search-wrap .project-search-choices.is-open::after {
    color: {{ $websiteParameter->primary_color }};
    transform: translateY(-50%) rotate(180deg);
}

.ps-select-wrap:has(.project-search-choices)::after {
    display: none !important;
}

@keyframes psChoicesReveal {
    from {
        opacity: 0;
        transform: translateY(-6px) scale(0.985);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@media (prefers-reduced-motion: reduce) {
    .project-search-wrap .project-search-choices .choices__list--dropdown {
        animation: none !important;
    }
}

/* Match .premium-banner .review-btn (E-Brochures) — same cyan→blue, no extra gradient animation */
.ps-search-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    height: 48px;
    padding: 0 22px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.02em;
    color: #fff !important;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    box-shadow: 0 8px 20px rgba(0, 114, 255, 0.28);
    transition: all 0.3s ease;
}

.ps-search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(0, 114, 255, 0.36);
    color: #fff !important;
}

.ps-search-btn:active {
    transform: translateY(-1px);
}

.ps-search-btn i {
    transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
}

.ps-search-btn:hover i {
    transform: translateX(4px);
}

@keyframes psShellIn {
    from {
        opacity: 0;
        transform: translateY(24px) rotateX(8deg);
        filter: blur(4px);
    }
    to {
        opacity: 1;
        transform: translateY(0) rotateX(0);
        filter: blur(0);
    }
}

@keyframes psBorderFlow {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

@keyframes psOrbFloat {
    0%, 100% {
        transform: translate(0, 0) scale(1);
        opacity: 0.85;
    }
    50% {
        transform: translate(-12px, 8px) scale(1.08);
        opacity: 1;
    }
}

@keyframes psBadgePulse {
    0%, 100% {
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.06);
    }
    50% {
        box-shadow: 0 4px 20px {{ $websiteParameter->primary_color }}28;
    }
}

@keyframes psTitleShine {
    0%, 100% {
        filter: brightness(1);
    }
    50% {
        filter: brightness(1.08);
    }
}

@media (prefers-reduced-motion: reduce) {
    .project-search-shell,
    .project-search-shell::before,
    .project-search-badge,
    .project-search-title,
    .project-search-shell__glow,
    .project-search-shell__glow--2 {
        animation: none !important;
    }
    .project-search-shell {
        animation: none;
        opacity: 1;
        transform: none;
        filter: none;
    }
    .project-search-form .ps-field,
    .project-search-btn-col {
        animation: none !important;
    }
}

.project-search-form .ps-field {
    animation: psFieldRise 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
}

.project-search-form .col-12:nth-child(1) .ps-field {
    animation-delay: 0.08s;
}
.project-search-form .col-12:nth-child(2) .ps-field {
    animation-delay: 0.16s;
}
.project-search-form .col-12:nth-child(3) .ps-field {
    animation-delay: 0.24s;
}
.project-search-btn-col {
    animation: psFieldRise 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
    animation-delay: 0.32s;
}

@keyframes psFieldRise {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Premium counting + tower reveal (homepage) */
.count-premium-shell,
.count-card,
.tower-frame__inner{
    will-change: transform;
}

.count-premium-shell{
    position: relative;
    border-radius: 22px;
    background: linear-gradient(180deg, rgba(255,255,255,.92), rgba(255,255,255,.72));
    border: 1px solid rgba(15,23,42,.10);
    box-shadow: 0 20px 70px rgba(15,23,42,.12);
    overflow: hidden;
    padding: 22px;
}
.count-premium-shell::before{
    content:"";
    position:absolute;
    inset:-18% -40%;
    width: 120%;
    height: 140%;
    background: linear-gradient(90deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,.75) 45%,
        rgba(255,255,255,0) 100%);
    transform: translateX(-140%) rotate(12deg);
    opacity: .10;
    pointer-events:none;
    z-index: 3; /* shine above everything, still subtle */
    mix-blend-mode: soft-light;
    filter: blur(.6px);
    animation: countSectionShine 7.8s cubic-bezier(.2,.8,.2,1) infinite;
}
.count-premium-shell > .row{
    position: relative;
    z-index: 2;
}
.count-premium-shell__glow{
    z-index: 0;
}
.count-premium-shell::after{
    z-index: 0;
}

@keyframes countSectionShine{
    0%   { transform: translateX(-140%) rotate(12deg); opacity: .06; }
    12%  { opacity: .22; }
    55%  { opacity: .12; }
    100% { transform: translateX(140%) rotate(12deg); opacity: .06; }
}
.count-premium-shell::after{
    content:"";
    position:absolute;
    inset: 0;
    border-radius: inherit;
    pointer-events:none;
    background:
        radial-gradient(1200px 340px at 10% 0%, rgba(255,255,255,.55), rgba(255,255,255,0) 55%),
        radial-gradient(520px 240px at 90% 12%, rgba(255,255,255,.35), rgba(255,255,255,0) 55%);
    opacity: .45;
    z-index: 0;
}
.count-premium-shell__glow{
    position:absolute; inset:-30% -20% auto auto;
    width: 420px; height: 420px;
    background: radial-gradient(circle at 30% 30%, rgba(34,197,94,.20), rgba(59,130,246,.14) 45%, rgba(255,255,255,0) 70%);
    filter: blur(2px);
    pointer-events:none;
    z-index: 0;
}
.count-premium-shell__glow--2{
    inset:auto auto -35% -25%;
    background: radial-gradient(circle at 60% 60%, rgba(245,158,11,.16), rgba(168,85,247,.12) 45%, rgba(255,255,255,0) 70%);
}
.count-premium-badge{
    display:inline-flex;
    align-items:center;
    gap:.5rem;
    padding:.4rem .75rem;
    border-radius:999px;
    background: rgba(15,23,42,.05);
    border: 1px solid rgba(15,23,42,.08);
    font-weight:700;
    font-size:.85rem;
    letter-spacing:.2px;
    color:#0f172a;
}
.count-premium-title{
    margin-top:.8rem;
    font-weight:800;
    line-height:1.15;
    letter-spacing:-.3px;
    color:#0b1220;
}
.count-premium-lead{
    margin-top:.5rem;
    color: rgba(15,23,42,.72);
    max-width: 58ch;
}
.count-premium-shell > .row{
    position: relative;
    z-index: 2;
}

@keyframes countCardGlaze {
    0%   { transform: translateX(-170%) rotate(18deg); opacity: .06; }
    10%  { opacity: .55; }
    55%  { opacity: .22; }
    100% { transform: translateX(170%) rotate(18deg); opacity: .06; }
}
.count-card{
    height:100%;
    border-radius: 18px;
    padding: 16px 14px;
    background: rgba(255,255,255,.72);
    border: 1px solid rgba(15,23,42,.08);
    box-shadow: 0 10px 30px rgba(15,23,42,.08);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transform: translateY(0);
    opacity: 1;
    transition: transform .28s cubic-bezier(.2,.8,.2,1), box-shadow .35s ease;
    position: relative;
    overflow: hidden;
}
.count-card::before{
    content:"";
    position:absolute;
    top:-40%;
    left:-70%;
    width: 70%;
    height: 180%;
    background: linear-gradient(90deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,.95) 44%,
        rgba(255,255,255,0) 100%);
    filter: blur(.4px);
    transform: translateX(-170%) rotate(18deg);
    opacity: .06;
    pointer-events:none;
    mix-blend-mode: overlay;
    animation: countCardGlaze 5.8s cubic-bezier(.2,.8,.2,1) infinite;
}
.count-card:hover::before{
    opacity: .85;
    animation-duration: 3.2s;
}
.count-card > *{
    position: relative;
    z-index: 1;
}
.count-card:hover{
    transform: translateY(-2px) scale(1.035);
    box-shadow: 0 18px 52px rgba(15,23,42,.16);
}
.count-card__value{
    font-family: "Bebas Neue", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    font-size: clamp(28px, 3.2vw, 44px);
    line-height: 1;
    letter-spacing: .5px;
    color:#0b1220;
}
.count-card__label{
    margin-top: .45rem;
    font-weight: 800;
    font-size: .95rem;
    color: rgba(15,23,42,.92);
}
.count-card__meta{
    margin-top: .2rem;
    font-size: .82rem;
    color: rgba(15,23,42,.62);
}

.count-image-card{
    border-radius: 26px;
    padding: 12px;
    background: linear-gradient(180deg, rgba(255,255,255,.70), rgba(255,255,255,.40));
    border: 1px solid rgba(15,23,42,.10);
    box-shadow: 0 18px 56px rgba(15,23,42,.12);
    overflow: hidden;
    transition: transform .28s cubic-bezier(.2,.8,.2,1), box-shadow .35s ease;
}
.count-image-card:hover{
    transform: translateY(-3px) scale(1.04);
    box-shadow: 0 24px 76px rgba(15,23,42,.18);
}
.count-image-card__img{
    display:block;
    width: 100%;
    height: auto;
    border-radius: 20px;
    object-fit: cover;
    transform: scale(1.01);
    transition: transform .35s cubic-bezier(.2,.8,.2,1), filter .35s ease;
    filter: saturate(1.02) contrast(1.02);
}
.count-image-card__img.animate-zoom{
    animation: zoomIn 12s ease-in-out infinite alternate;
}
.count-image-card:hover .count-image-card__img.animate-zoom{
    animation-play-state: paused;
}
.count-image-card:hover .count-image-card__img{
    transform: scale(1.05);
}
.count-image-card{
    position: relative;
}
.count-image-card::after{
    content:"";
    position:absolute;
    inset:-30% -40%;
    width: 120%;
    height: 150%;
    background: linear-gradient(90deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,.85) 45%,
        rgba(255,255,255,0) 100%);
    transform: translateX(-140%) rotate(12deg);
    opacity: .08;
    pointer-events:none;
    mix-blend-mode: soft-light;
    filter: blur(.6px);
    animation: countImageCardShine 6.6s cubic-bezier(.2,.8,.2,1) infinite;
}
@keyframes countImageCardShine{
    0%   { transform: translateX(-140%) rotate(12deg); opacity: .06; }
    12%  { opacity: .24; }
    55%  { opacity: .12; }
    100% { transform: translateX(140%) rotate(12deg); opacity: .06; }
}

/* Same zoom animation as postDetails featured image */
@keyframes zoomIn {
  0% { transform: scale(1); filter: brightness(1) saturate(1.02) contrast(1.02); }
  50% { transform: scale(1.08); filter: brightness(1.05) saturate(1.06) contrast(1.02); }
  100% { transform: scale(1); filter: brightness(1) saturate(1.02) contrast(1.02); }
}

.tower-frame{
    position: relative;
    border-radius: 26px;
    padding: 18px;
    background: linear-gradient(180deg, rgba(15,23,42,.04), rgba(15,23,42,.02));
    border: 1px solid rgba(15,23,42,.10);
    box-shadow: 0 18px 56px rgba(15,23,42,.10);
    overflow: hidden;
    min-height: 500px;
}
.tower-frame__inner{
    position: relative;
    height: 100%;
    min-height: 470px;
    border-radius: 20px;
    background: radial-gradient(circle at 30% 10%, rgba(59,130,246,.14), rgba(255,255,255,0) 60%),
                radial-gradient(circle at 60% 70%, rgba(34,197,94,.10), rgba(255,255,255,0) 55%),
                linear-gradient(180deg, rgba(255,255,255,.70), rgba(255,255,255,.35));
    overflow:hidden;
}
.tower-frame__shine{
    position:absolute;
    inset:-40% auto auto -30%;
    width: 360px;
    height: 360px;
    background: radial-gradient(circle at 50% 50%, rgba(255,255,255,.55), rgba(255,255,255,0) 70%);
    transform: rotate(18deg);
    pointer-events:none;
}
.tower-frame__reveal{
    position:absolute;
    left: 50%;
    bottom: 10px;
    transform: translateX(-50%);
    width: min(420px, 92%);
    height: 100%;
    overflow: hidden;
    mask-image: linear-gradient(to top, rgba(0,0,0,1) 86%, rgba(0,0,0,0) 100%);
    -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1) 86%, rgba(0,0,0,0) 100%);
}
.tower-frame__reveal::after{
    content:"";
    position:absolute;
    top:-30%;
    left:-70%;
    width: 70%;
    height: 160%;
    background: linear-gradient(90deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,.85) 45%,
        rgba(255,255,255,0) 100%);
    transform: translateX(-170%) rotate(14deg);
    opacity: .0;
    pointer-events:none;
    mix-blend-mode: screen;
    filter: blur(.35px);
    animation: towerImgGlaze 6.6s cubic-bezier(.2,.8,.2,1) infinite;
}

@keyframes towerImgGlaze{
    0%   { transform: translateX(-170%) rotate(14deg); opacity: .06; }
    12%  { opacity: .48; }
    55%  { opacity: .18; }
    100% { transform: translateX(170%) rotate(14deg); opacity: .06; }
}
.tower-frame__img{
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height:100%;
    object-fit: contain;
    object-position: center bottom;
    display:block;
    filter: drop-shadow(0 26px 50px rgba(15,23,42,.18));
}
.tower-frame__tower{
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height: 130%;
    transform: translateY(0);
    opacity: 1;
    background:
        linear-gradient(180deg, rgba(15,23,42,.22), rgba(15,23,42,.06)),
        repeating-linear-gradient(
            90deg,
            rgba(255,255,255,.34) 0px,
            rgba(255,255,255,.34) 8px,
            rgba(255,255,255,.06) 8px,
            rgba(255,255,255,.06) 18px
        );
    border-radius: 18px 18px 10px 10px;
    clip-path: polygon(10% 100%, 90% 100%, 82% 6%, 18% 0%);
    box-shadow: 0 40px 100px rgba(15,23,42,.18);
}
.tower-frame__shadow{
    position:absolute;
    left: 50%;
    bottom: 8px;
    transform: translateX(-50%);
    width: min(300px, 82%);
    height: 22px;
    background: radial-gradient(circle at 50% 50%, rgba(15,23,42,.18), rgba(15,23,42,0) 68%);
    filter: blur(2px);
    pointer-events:none;
}

@media (max-width: 991.98px){
    .tower-frame{ min-height: 380px; }
    .tower-frame__inner{ min-height: 350px; }
}

/* Mobile spacing polish for counting section */
@media (max-width: 767.98px){
    #count-stats{
        padding-top: .9rem !important;
        padding-bottom: 1rem !important;
    }
    #count-stats .count-premium-shell{
        padding: 14px;
        border-radius: 18px;
    }
    #count-stats .count-premium-title{
        font-size: 1.45rem;
        margin-top: .65rem;
    }
    #count-stats .count-premium-lead{
        font-size: .95rem;
        margin-top: .4rem;
    }
    #count-stats .count-card{
        padding: 12px 12px;
        border-radius: 16px;
        box-shadow: 0 10px 26px rgba(15,23,42,.08);
    }
    #count-stats .count-card__label{
        font-size: .9rem;
    }
    #count-stats .count-card__meta{
        font-size: .78rem;
    }
    #count-stats .tower-frame{
        padding: 14px;
        border-radius: 20px;
        min-height: 260px;
    }
    #count-stats .tower-frame__inner{
        min-height: 230px;
        border-radius: 16px;
    }
}

@media (prefers-reduced-motion: reduce){
    .count-premium-shell::before{
        animation: none !important;
        opacity: .14;
    }
    .count-card::before{
        animation: none !important;
        opacity: .14;
    }
    .tower-frame__reveal::after{
        animation: none !important;
        opacity: .12;
    }
    .count-image-card::after{
        animation: none !important;
        opacity: .12;
    }
    .count-image-card__img.animate-zoom{
        animation: none !important;
    }
    .count-card{
        transition: box-shadow .25s ease;
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




 

        {{-- (Removed) category list cards --}}

         

        @isset($projectSearchPayload)
        <section class="project-search-wrap mb-4 mb-md-5" id="home-project-search" aria-label="Project search">
            <div class="container px-3 px-md-4">
                <div class="project-search-shell">
                    <span class="project-search-shell__glow" aria-hidden="true"></span>
                    <span class="project-search-shell__glow project-search-shell__glow--2" aria-hidden="true"></span>
                    <div class="project-search-shell__inner">
                        <header class="project-search-head">
                            <span class="project-search-badge">
                                <i class="fas fa-compass" aria-hidden="true"></i>
                                Explore projects
                            </span>
                            <h2 class="project-search-title">Find your perfect project</h2>
                            <p class="project-search-lead">
                                Choose location, category, and subcategory — we’ll show matching developments in one place.
                            </p>
                        </header>

                        <form method="get"
                              action="{{ route('user.projectSearch') }}"
                              class="project-search-form mb-0">
                            <div class="row g-3 g-md-3 align-items-end">
                                <div class="col-12 col-md">
                                    <div class="ps-field ps-field--location">
                                        <label for="ps-location">Location</label>
                                        <div class="ps-select-wrap">
                                            <span class="ps-select-icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                                            <select name="location_id"
                                                    id="ps-location"
                                                    class="form-control ps-select"
                                                    required
                                                    autocomplete="address-level1">
                                                <option value="">Select location</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="ps-field ps-field--category">
                                        <label for="ps-category">Category</label>
                                        <div class="ps-select-wrap">
                                            <span class="ps-select-icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                                            <select name="category_id"
                                                    id="ps-category"
                                                    class="form-control ps-select"
                                                    autocomplete="off">
                                                <option value="">Select category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="ps-field ps-field--sub">
                                        <label for="ps-subcategory">Subcategory</label>
                                        <div class="ps-select-wrap">
                                            <span class="ps-select-icon" aria-hidden="true"><i class="fas fa-tags"></i></span>
                                            <select name="subcategory_id"
                                                    id="ps-subcategory"
                                                    class="form-control ps-select"
                                                    autocomplete="off">
                                                <option value="">Select subcategory</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-auto project-search-btn-col">
                                    <label class="d-none d-lg-block mb-1 small" style="visibility: hidden;">Search</label>
                                    <button type="submit"
                                            id="ps-submit"
                                            class="ps-search-btn w-100">
                                        <span>Search</span>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="application/json" id="project-search-data">@json($projectSearchPayload)</script>
        </section>
        @endisset

        {{-- Same width as project search: .container.px-3.px-md-4 --}}
        <section class="brochures-banner-wrap mb-4 mb-md-5" aria-label="Brochures">
            <div class="container px-3 px-md-4">
                <div class="premium-banner py-6 py-md-5 border-radius-xl mb-0"
                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/desktop.jpg');"
                    loading="lazy">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="text-white">Built by expert developers</h4>
                                <h1 class="text-white">Cube Holdings Ltd</h1>
                            </div>

                            <div class="col-sm-12 col-md-6 pt-4 pt-md-0">
                                <p class="lead text-white opacity-8 mb-3">Download E-Brochures of all projects</p>
                                <a href="{{ route('allbrochures') }}"
                                    class="review-btn text-white icon-move-right w3-border w3-round px-3 py-2">
                                    E-Brochures
                                    <i class="fas fa-arrow-right text-sm ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="pt-4 pb-4 mb-4" id="count-stats" aria-label="Company stats">
    <div class="container px-3 px-md-4">
        <div class="count-premium-shell">
            <span class="count-premium-shell__glow" aria-hidden="true"></span>
            <span class="count-premium-shell__glow count-premium-shell__glow--2" aria-hidden="true"></span>

            <div class="row align-items-center g-4 g-lg-5 position-relative">
                <div class="col-12 col-lg-6">
                    <div class="count-premium-head">
                        <span class="count-premium-badge">
                            <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                            Growth by the numbers
                        </span>
                        <h2 class="count-premium-title">
                            {{ $websiteParameter->count_section_title ?: 'Witness, as we transform your land to a landmark' }}
                        </h2>
                        <p class="count-premium-lead mb-0">
                            {{ $websiteParameter->count_section_subtitle ?: 'Scroll করলে সংখ্যাগুলো smoothly increment হবে—একই সাথে ডান পাশে building নিচ থেকে উপরে reveal হবে।' }}
                        </p>
                    </div>

                    <div class="row g-3 g-md-4 mt-3 mt-md-4">
                        <div class="col-6 col-md-6">
                            <div class="count-card js-count-card">
                                <div class="count-card__value">
                                    <span class="js-count"
                                          data-target="{{ $websiteParameter->count_stat_1 ?? 11000000 }}"
                                          data-suffix="+"
                                          data-format="compact">0</span>
                                </div>
                                <div class="count-card__label">Total Area Built</div>
                                <div class="count-card__meta">(Million sft.)</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="count-card js-count-card">
                                <div class="count-card__value">
                                    <span class="js-count"
                                          data-target="{{ $websiteParameter->count_stat_2 ?? 21 }}"
                                          data-suffix=""
                                          data-format="plain">0</span>
                                </div>
                                <div class="count-card__label">Years Since Inception</div>
                                <div class="count-card__meta">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="count-card js-count-card">
                                <div class="count-card__value">
                                    <span class="js-count"
                                          data-target="{{ $websiteParameter->count_stat_3 ?? 63 }}"
                                          data-suffix=""
                                          data-format="plain">0</span>
                                </div>
                                <div class="count-card__label">Completed Projects</div>
                                <div class="count-card__meta">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="count-card js-count-card">
                                <div class="count-card__value">
                                    <span class="js-count"
                                          data-target="{{ $websiteParameter->count_stat_4 ?? 100 }}"
                                          data-suffix="+"
                                          data-format="plain">0</span>
                                </div>
                                <div class="count-card__label">Number of Projects</div>
                                <div class="count-card__meta">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="count-card js-count-card">
                                <div class="count-card__value">
                                    <span class="js-count"
                                          data-target="{{ $websiteParameter->count_stat_5 ?? 1500 }}"
                                          data-suffix="+"
                                          data-format="plain">0</span>
                                </div>
                                <div class="count-card__label">Happy Clients</div>
                                <div class="count-card__meta">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="count-card js-count-card">
                                <div class="count-card__value">
                                    <span class="js-count"
                                          data-target="{{ $websiteParameter->count_stat_6 ?? 18000000 }}"
                                          data-suffix="+"
                                          data-format="compact">0</span>
                                </div>
                                <div class="count-card__label">Total Area in Pipeline</div>
                                <div class="count-card__meta">(Million sft.)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    @if(!empty($websiteParameter->count_section_image))
                        <div class="count-image-card" aria-label="Count section image">
                            <img src="{{ asset($websiteParameter->countSectionImage()) }}"
                                 alt=""
                                 class="count-image-card__img animate-zoom"
                                 loading="lazy">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
 
{{-- Masonry mosaic section removed --}}
<section class="my-4 py-1" aria-label="Featured works">
  <div class="container px-3 px-md-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <div>
        <h4 class="mb-0">Featured Works</h4>
        <p class="text-muted mb-0 small">Hover to see details, click to open.</p>
      </div>
    </div>

    <div class="home-masonry">
      @foreach($posts as $i => $post)
        @php
          $heightClass = 'h-' . (($i % 5) + 1);
          $firstCategory = optional($post->categories->first())->name;
          $locationTitle = optional($post->location)->title;
        @endphp
        <div class="home-masonry__item">
          <a class="home-masonry__card"
             href="{{ route('user.postDetails', [$post, \Illuminate\Support\Str::slug($post->title)]) }}"
             aria-label="{{ $post->title }}">
            <img
              class="home-masonry__img {{ $heightClass }}"
              src="{{ route('imagecache', ['template' => 'pnilg', 'filename' => $post->fi()]) }}"
              alt=""
              loading="lazy"
              decoding="async"
            >
            <span class="home-masonry__overlay">
              <span>
                <span class="home-masonry__title">{{ $post->title }}</span>
                <span class="home-masonry__meta">
                  @if($locationTitle)
                    <span><i class="fa-solid fa-location-dot" aria-hidden="true"></i>{{ $locationTitle }}</span>
                  @endif
                  @if($firstCategory)
                    <span><i class="fa-solid fa-tag" aria-hidden="true"></i>{{ $firstCategory }}</span>
                  @endif
                </span>
              </span>
            </span>
          </a>
        </div>
      @endforeach
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
@php
$customerLinkRaw = $websiteParameter->customer_review_link ?? '';
$landownerLinkRaw = $websiteParameter->landowner_review_link ?? '';
$customerHref = filled($customerLinkRaw)
? (\Illuminate\Support\Str::startsWith(trim($customerLinkRaw), ['http://', 'https://'])
   ? trim($customerLinkRaw)
   : url(trim($customerLinkRaw)))
: route('customerReviews');
$landownerHref = filled($landownerLinkRaw)
? (\Illuminate\Support\Str::startsWith(trim($landownerLinkRaw), ['http://', 'https://'])
   ? trim($landownerLinkRaw)
   : url(trim($landownerLinkRaw)))
: route('landownerReviews');
$customerExternal = filled($customerLinkRaw) && \Illuminate\Support\Str::startsWith(trim($customerLinkRaw), ['http://', 'https://']);
$landownerExternal = filled($landownerLinkRaw) && \Illuminate\Support\Str::startsWith(trim($landownerLinkRaw), ['http://', 'https://']);
@endphp

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

   <a href="{{ $customerHref }}" class="review-btn primary" @if ($customerExternal) target="_blank" rel="noopener noreferrer" @endif>
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

   <a href="{{ $landownerHref }}" class="review-btn secondary" @if ($landownerExternal) target="_blank" rel="noopener noreferrer" @endif>
       View Landowner Reviews
   </a>
</div>
</div>
</div>

</div>
</div>
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

 
                <div class="container- py-0 postion-relative z-index-2 position-relative">
                    <div class="row">
                        <div class="col-md-12 mx-auto- text-center">{!! $websiteParameter->google_map_code !!}</div>
                    </div>
                </div> 

 
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

(function () {
    var dataEl = document.getElementById('project-search-data');
    if (!dataEl) {
        return;
    }
    var data;
    try {
        data = JSON.parse(dataEl.textContent);
    } catch (e) {
        return;
    }
    var locSel = document.getElementById('ps-location');
    var catSel = document.getElementById('ps-category');
    var subSel = document.getElementById('ps-subcategory');
    var form = document.querySelector('#home-project-search .project-search-form');
    if (!locSel || !catSel || !subSel || !form) {
        return;
    }

    var choiceLoc = null;
    var choiceCat = null;
    var choiceSub = null;
    var useChoices = typeof window.Choices === 'function';

    function destroyChoice(inst) {
        if (inst) {
            try {
                inst.destroy();
            } catch (err) {
                /* ignore */
            }
        }
        return null;
    }

    function bindChoices(selectEl) {
        if (!useChoices) {
            return null;
        }
        return new window.Choices(selectEl, {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false,
            position: 'bottom',
            allowHTML: false,
            classNames: {
                containerOuter: 'choices project-search-choices'
            }
        });
    }

    function categoryName(id) {
        var c = data.categories.find(function (x) { return Number(x.id) === Number(id); });
        return c ? c.name : '';
    }
    function subName(id) {
        var s = data.subcategories.find(function (x) { return Number(x.id) === Number(id); });
        return s ? s.name : '';
    }

    function fillCategories(locId) {
        choiceCat = destroyChoice(choiceCat);
        choiceSub = destroyChoice(choiceSub);
        catSel.innerHTML = '<option value="">Select category</option>';
        subSel.innerHTML = '<option value="">Select subcategory</option>';
        var ids = data.locationCategories[locId] || data.locationCategories[String(locId)] || [];
        ids.forEach(function (cid) {
            var opt = document.createElement('option');
            opt.value = cid;
            opt.textContent = categoryName(cid);
            catSel.appendChild(opt);
        });
        choiceCat = bindChoices(catSel);
        choiceSub = bindChoices(subSel);
    }

    function fillSubcats(locId, catId) {
        choiceSub = destroyChoice(choiceSub);
        subSel.innerHTML = '<option value="">Select subcategory</option>';
        var key = String(locId) + '_' + String(catId);
        var ids = data.locationCategorySubcategories[key] || [];
        ids.forEach(function (sid) {
            var opt = document.createElement('option');
            opt.value = sid;
            opt.textContent = subName(sid);
            subSel.appendChild(opt);
        });
        choiceSub = bindChoices(subSel);
    }

    function resetCatSubEmpty() {
        choiceCat = destroyChoice(choiceCat);
        choiceSub = destroyChoice(choiceSub);
        catSel.innerHTML = '<option value="">Select category</option>';
        subSel.innerHTML = '<option value="">Select subcategory</option>';
        choiceCat = bindChoices(catSel);
        choiceSub = bindChoices(subSel);
    }

    (data.locations || []).forEach(function (loc) {
        var opt = document.createElement('option');
        opt.value = loc.id;
        opt.textContent = loc.title;
        locSel.appendChild(opt);
    });

    choiceLoc = bindChoices(locSel);
    choiceCat = bindChoices(catSel);
    choiceSub = bindChoices(subSel);

    locSel.addEventListener('change', function () {
        var v = this.value;
        if (!v) {
            resetCatSubEmpty();
            return;
        }
        fillCategories(parseInt(v, 10));
    });

    catSel.addEventListener('change', function () {
        var lid = locSel.value;
        var cid = this.value;
        if (!lid || !cid) {
            choiceSub = destroyChoice(choiceSub);
            subSel.innerHTML = '<option value="">Select subcategory</option>';
            choiceSub = bindChoices(subSel);
            return;
        }
        fillSubcats(parseInt(lid, 10), parseInt(cid, 10));
    });

    form.addEventListener('submit', function (e) {
        if (!locSel.value || !catSel.value || !subSel.value) {
            e.preventDefault();
        }
    });
})();

/* Count value animation only (homepage) */
(function(){
    function clamp(v, min, max){ return Math.min(max, Math.max(min, v)); }

    function formatNumber(value, format){
        if (format === 'plain') return Math.round(value).toString();
        var abs = Math.abs(value);
        var unit = '';
        var num = value;
        if (abs >= 1e9) { num = value / 1e9; unit = 'B'; }
        else if (abs >= 1e6) { num = value / 1e6; unit = 'M'; }
        else if (abs >= 1e3) { num = value / 1e3; unit = 'K'; }
        else { return Math.round(value).toString(); }

        var rounded = Math.round(num * 10) / 10; // 1 decimal max
        if (Math.abs(rounded - Math.round(rounded)) < 1e-9) rounded = Math.round(rounded);
        return String(rounded) + unit;
    }

    function animateCount(el){
        if (!el || el.dataset.counted === '1') return;
        el.dataset.counted = '1';

        var target = Number(el.getAttribute('data-target') || '0');
        var suffix = el.getAttribute('data-suffix') || '';
        var format = el.getAttribute('data-format') || 'plain';
        var duration = clamp(Number(el.getAttribute('data-duration') || '1400'), 600, 2600);

        var start = 0;
        var startTs = null;

        function step(ts){
            if (startTs === null) startTs = ts;
            var p = clamp((ts - startTs) / duration, 0, 1);
            var eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
            var current = start + (target - start) * eased;
            el.textContent = formatNumber(current, format) + suffix;
            if (p < 1) requestAnimationFrame(step);
            else el.textContent = formatNumber(target, format) + suffix;
        }

        requestAnimationFrame(step);
    }

    var statsSection = document.getElementById('count-stats');
    if (!statsSection) return;

    var countEls = Array.prototype.slice.call(statsSection.querySelectorAll('.js-count'));
    if (!countEls.length) return;

    function run(){
        countEls.forEach(animateCount);
    }

    if ('IntersectionObserver' in window){
        var io = new IntersectionObserver(function(entries){
            entries.forEach(function(entry){
                if (entry.isIntersecting){
                    run();
                    io.disconnect();
                }
            });
        }, { root: null, threshold: 0.25, rootMargin: '0px 0px -10% 0px' });
        io.observe(statsSection);
    } else {
        run();
    }
})();

</script>
    @endpush
