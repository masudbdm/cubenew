@once
@push('css')
<style>
@keyframes postCardKenBurns {
  0% { transform: scale(1) translate(0, 0); }
  50% { transform: scale(1.045) translate(0.35%, -0.25%); }
  100% { transform: scale(1) translate(0, 0); }
}
@keyframes postCardGlaze {
  0% { transform: translateX(-120%) skewX(-12deg); opacity: 0; }
  15% { opacity: 0.55; }
  50% { opacity: 0.4; }
  100% { transform: translateX(220%) skewX(-12deg); opacity: 0; }
}
.post-card-listing {
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.06);
  transition: transform 0.45s cubic-bezier(0.25, 0.8, 0.25, 1),
              box-shadow 0.45s ease;
}
.post-card-listing:hover {
  transform: translateY(-6px);
  box-shadow:
    0 12px 28px rgba(15, 23, 42, 0.1),
    0 24px 56px rgba(63, 81, 181, 0.12);
}
.post-card-listing__link {
  display: block;
  background: linear-gradient(180deg, #eef1f6 0%, #f1f3f5 100%);
  border-bottom: 1px solid rgba(0, 0, 0, 0.06);
  position: relative;
}
.post-card-listing__media {
  position: relative;
  display: block;
  overflow: hidden;
}
.post-card-listing__media::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 0.22) 0%,
    transparent 42%,
    transparent 58%,
    rgba(0, 0, 0, 0.06) 100%
  );
  opacity: 0.85;
}
.post-card-listing__media::after {
  content: "";
  position: absolute;
  top: -20%;
  left: 0;
  width: 45%;
  height: 140%;
  z-index: 2;
  pointer-events: none;
  background: linear-gradient(
    100deg,
    transparent 0%,
    rgba(255, 255, 255, 0) 35%,
    rgba(255, 255, 255, 0.55) 50%,
    rgba(255, 255, 255, 0) 65%,
    transparent 100%
  );
  animation: postCardGlaze 4.5s ease-in-out infinite;
}
.post-card-listing__img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: contain;
  object-position: center;
  display: block;
  position: relative;
  z-index: 0;
  animation: postCardKenBurns 9s ease-in-out infinite;
  will-change: transform;
}
.post-card-listing:hover .post-card-listing__img {
  animation-duration: 5s;
}
@media (prefers-reduced-motion: reduce) {
  .post-card-listing,
  .post-card-listing:hover {
    transform: none;
    transition: none;
  }
  .post-card-listing__img {
    animation: none;
  }
  .post-card-listing__media::after {
    animation: none;
    opacity: 0;
  }
}
</style>
@endpush
@endonce
<div class="card elevation-2 mb-3 h-100 post-card-listing">
    <a href="{{ route('user.postDetails', [$post, Str::slug($post->title)]) }}" class="post-card-listing__link">
        <span class="post-card-listing__media">
            <img class="post-card-listing__img card-img-top border-0"
                 src="{{ route('imagecache', ['template' => 'pnilg', 'filename' => $post->fi()]) }}"
                 alt=""
                 loading="lazy"
                 decoding="async">
        </span>
    </a>

    <div class="card-body p-3">
        <h4 class="card-title">
            {{ $post->title }}
        </h4>

        <p class="card-text small">
            {{ Str::limit($post->excerpt, $excerptLimit ?? 80, '...') }}
        </p>

        <a href="{{ route('user.postDetails', [$post, Str::slug($post->title)]) }}"
           class="text-primary">
            Read more →
        </a>
    </div>
</div>
