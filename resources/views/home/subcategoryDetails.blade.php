@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush

@section('content')
<div class="container-fluid mt-5 mx-0">
    <div class="row">

        {{-- Header / Breadcrumb --}}
        <div class="mb-4">
            <nav class="w-100 w-md-50 w-lg-20" aria-label="breadcrumb">
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

            <h3>{{ $subcategory->name }}</h3>
        </div>

        {{-- Main Content --}}
        <div class="col-md-8 px-0">
            <div class="card">
                <div class="tab-content tab-space card-body">
                    <div class="tab-pane active">

                        <div class="row">
                            @forelse ($posts as $post)
                           <div class="col-md-4 col-12 w3-animate-zoom mb-3">
    @include('home.partials.postCard')
</div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        There is no post in this subcategory. 
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Right Sidebar --}}
        <div class="col-md-4 ms-auto">
            <ul class="list-group list-group-flush">
                @foreach ($postsForRightSidebar as $post)
                    <li class="list-group-item mx-0 px-0">
                        <a href="{{ route('user.postDetails', [$post, Str::slug($post->title)]) }}">
                            <div class="card">
                                <div class="card-body p-1">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-4 pl-0">
                                            <img src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}"
                                                 class="img-fluid rounded">
                                        </div>
                                        <div class="col-8 p-1">
                                            <span class="text-bold" style="font-size:1em;">
                                                {!! Str::limit($post->title, 45, '...') !!}
                                            </span>
                                            <br>
                                            <span style="font-size:15px;">
                                                {!! Str::limit($post->excerpt, 25, '...') !!}
                                            </span>
                                            <br>
                                            <span>Read more</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection
