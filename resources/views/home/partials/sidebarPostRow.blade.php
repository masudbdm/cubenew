@once
@push('css')
<style>
@keyframes sidebarThumbPulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.04); }
}
@keyframes sidebarThumbGlaze {
  0% { transform: translateX(-100%) skewX(-10deg); opacity: 0; }
  20% { opacity: 0.5; }
  100% { transform: translateX(280%) skewX(-10deg); opacity: 0; }
}
.sidebar-post-row .card {
  border-radius: 12px;
  border: 1px solid rgba(0, 0, 0, 0.06);
  transition: transform 0.35s ease, box-shadow 0.35s ease;
}
.sidebar-post-row:hover .card {
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(15, 23, 42, 0.1);
}
.sidebar-post-row__thumb {
  aspect-ratio: 1;
  width: 100%;
  max-width: 100%;
  background: linear-gradient(145deg, #eef1f6, #f8f9fb);
  border-radius: 0.4rem;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 72px;
  position: relative;
  border: 1px solid rgba(0, 0, 0, 0.05);
}
.sidebar-post-row__thumb::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  background: linear-gradient(
    160deg,
    rgba(255, 255, 255, 0.35) 0%,
    transparent 45%
  );
  opacity: 0.7;
}
.sidebar-post-row__thumb::after {
  content: "";
  position: absolute;
  top: -15%;
  left: 0;
  width: 40%;
  height: 130%;
  z-index: 2;
  pointer-events: none;
  background: linear-gradient(
    95deg,
    transparent 0%,
    rgba(255, 255, 255, 0) 40%,
    rgba(255, 255, 255, 0.5) 50%,
    rgba(255, 255, 255, 0) 60%,
    transparent 100%
  );
  animation: sidebarThumbGlaze 5s ease-in-out infinite;
}
.sidebar-post-row__thumb img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: center;
  position: relative;
  z-index: 0;
  animation: sidebarThumbPulse 5.5s ease-in-out infinite;
  will-change: transform;
}
.sidebar-post-row:hover .sidebar-post-row__thumb img {
  animation-duration: 3.2s;
}
@media (prefers-reduced-motion: reduce) {
  .sidebar-post-row:hover .card {
    transform: none;
  }
  .sidebar-post-row__thumb img {
    animation: none;
  }
  .sidebar-post-row__thumb::after {
    animation: none;
    opacity: 0;
  }
}
</style>
@endpush
@endonce
<li class="list-group-item mx-0 px-0 sidebar-post-row">
    <a href="{{ route('user.postDetails', [$post, Str::slug($post->title)]) }}">
        <div class="card">
            <div class="card-body p-1">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-4 pl-0">
                        <div class="sidebar-post-row__thumb">
                            <img src="{{ route('imagecache', ['template' => 'pnilg', 'filename' => $post->fi()]) }}"
                                 alt=""
                                 class="img-fluid"
                                 loading="lazy"
                                 decoding="async">
                        </div>
                    </div>
                    <div class="col-8 p-1">
                        <div>
                            <span class="text-bold" style="font-size: 1em;">{!! Str::limit($post->title, 45, '...') !!}</span>
                            <br>
                            <span style="font-size: 15px;">{!! Str::limit($post->excerpt, 25, '...') !!}</span>
                            <br>
                            <span>Read more...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</li>
