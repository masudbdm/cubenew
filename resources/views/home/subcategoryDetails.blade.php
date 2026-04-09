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
                    @include('home.partials.sidebarPostRow', ['post' => $post])
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection
