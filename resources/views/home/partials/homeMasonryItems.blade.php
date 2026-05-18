@foreach($posts as $post)
  @php
    $i = ($startIndex ?? 0) + $loop->index;
    $heightPattern = [1, 3, 5, 2, 4, 2, 5, 3, 1, 4, 3, 2];
    $heightClass = 'masonry-h-' . $heightPattern[$i % count($heightPattern)];
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

