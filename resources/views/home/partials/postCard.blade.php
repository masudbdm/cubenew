<div class="card elevation-2 mb-3 h-100">
        <a href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}">
            <img class="card-img-top"
                 src="{{ route('imagecache', ['template' => 'cplg', 'filename' => $post->fi()]) }}"
                 style="height: 200px; object-fit: cover;">
        </a>

        <div class="card-body p-3">
            <h4 class="card-title">
                {{ $post->title }}
            </h4>

            <p class="card-text small">
                {{ Str::limit($post->excerpt, 80, '...') }}
            </p>

            <a href="{{ route('user.postDetails', [$post,Str::slug($post->title)]) }}"
               class="text-primary">
                Read more →
            </a>
        </div>
    </div>