@extends('home.layouts.pageMaster')
@push('meta')
<meta property="og:type" content="website">
@endpush
@section('content')
    <div class="container-fluid mt-5 mx-0">
        <div class="row">
            {{-- <div class="mb-4 w-100 w-md-50 w-lg-25"> --}}
            <div class="mb-4">
                <nav class="w-100 w-md-50 w-lg-20" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.welcome') }}">
                                Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
                <h3>{{ $category->name }}</h3>

                @if($category->subcats->count())
                <div class="mb-3">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($category->subcats as $subcat)
                            <a href="{{ route('user.subcategoryDetails', $subcat) }}"
                               class="btn btn-outline-primary rounded-pill px-3 py-1 mb-2">
                                {{ $subcat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <div class="col-md-8 px-0 mb-3">
                <div class="card">
                    {{-- <div class="container-fluid border-bottom py-2">
                        <div class="col-lg-3 me-auto px-1">
                            <p class="lead text-dark pt-1 mb-0">{{ $category->name }}</p>
                        </div>

                    </div> --}}
                    <div class="tab-content tab-space card-body">
                        <div class="tab-pane active" id="preview-features-1">
                            <!-- -------- START Features w/ icons and text on left & gradient title and text on right -------- -->
                
                     
                                    <div class="row">
                                        @foreach ($posts as $post)
                                             
                                            <div class="col-md-4 col-12 w3-animate-zoom mb-3">
    @include('home.partials.postCard')
</div>

                                        @endforeach
                                    </div>
                      
                      
                            <!-- -------- END Features w/ icons and text on left & gradient title and text on right -------- -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 ms-auto">
                {{-- <label class="m-0" for="">Posts</label> --}}
                <ul class="list-group list-group-flush">
                    @foreach ($postsForRightSidebar as $post)
                        @include('home.partials.sidebarPostRow', ['post' => $post])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
