@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush

@push('css')
<style>
.category-details-page {
    padding-bottom: 4rem;
}
.category-details-page .post-card-listing {
    border-radius: 20px;
}
.category-details-page .post-card-listing__media {
    min-height: 320px;
}
.category-details-page .post-card-listing__img {
    aspect-ratio: 3 / 4;
    min-height: 320px;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
.category-details-page .post-card-listing .card-body {
    padding: 1.35rem 1.5rem 1.5rem;
}
.category-details-page .post-card-listing .card-title {
    font-size: 1.35rem;
    line-height: 1.35;
    margin-bottom: 0.65rem;
}
.category-details-page .post-card-listing .card-text {
    font-size: 1rem;
    line-height: 1.55;
}
.category-details-page .category-details-grid {
    --bs-gutter-x: 2.5rem;
    --bs-gutter-y: 2.5rem;
}
@media (min-width: 992px) {
    .category-details-page .post-card-listing__media {
        min-height: 480px;
    }
    .category-details-page .post-card-listing__img {
        aspect-ratio: 3 / 4;
        min-height: 480px;
    }
    .category-details-page .category-details-grid {
        --bs-gutter-x: 4rem;
        --bs-gutter-y: 3.5rem;
    }
    .category-details-page .category-details-header h3 {
        font-size: 2rem;
    }
    .category-details-page {
        padding-bottom: 5.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid mt-5 mx-0 category-details-page">
    <div class="row">
        <div class="col-12 category-details-header mb-4">
            <nav class="w-100" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.welcome') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.categoryDetails', $subcategory->category) }}">
                            {{ $subcategory->category->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $subcategory->name }}
                    </li>
                </ol>
            </nav>
            <h3 class="mb-0">{{ $subcategory->name }}</h3>
        </div>

        <div class="col-12">
            <div class="row category-details-grid g-4 g-lg-5">
                @forelse ($posts as $post)
                    <div class="col-lg-6 col-12 w3-animate-zoom px-lg-4">
                        @include('home.partials.postCard', ['excerptLimit' => 140])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">
                            No projects found in this subcategory.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
