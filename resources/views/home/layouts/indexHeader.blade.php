<!-- Navbar -->
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-1 start-0 end-0 mx-4">
                <div class="container-fluid px-0 py-0">
                    <a class="navbar-brand p-0 font-weight-bolder ms-sm-3" href="{{ url('/') }}" rel="tooltip"
                        title="{{ $websiteParameter->h1 }}" data-placement="bottom" target="">
                        <div class="logo-cube-wrapper">
    <div class="logo-cube">
        <div class="face front">
            <img src="{{ asset($websiteParameter->logo()) }}">
        </div>
        <div class="face right">
            <img src="{{ asset($websiteParameter->logo()) }}">
        </div>
        <div class="face back">
            <img src="{{ asset($websiteParameter->logo()) }}">
        </div>
        <div class="face left">
            <img src="{{ asset($websiteParameter->logo()) }}">
        </div>
    </div>
</div>
{{-- <span class="w3-xlarge w3-text-indigo d-none d-md-inline ">
    &nbsp;{{ $websiteParameter->h1 }}
</span>
 --}}
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-auto">
                            {{-- <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-home fa-2x"></i>
                                </a>
                            </li> --}}
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center w3-text-white" id="dropdownMenuPages"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons opacity-6 me-2 text-md w3-text-white font-weight-bolder">dashboard</i>
                                    Projects
                                    <img src="{{ asset('template/assets/img/down-arrow-white.svg') }}" alt="down-arrow"
                                        class="arrow ms-auto ms-md-2">
                                </a>
                                {{-- Desktop --}}
                                <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                    aria-labelledby="dropdownMenuPages">
                                    <div class="d-none d-lg-block">
                                        @foreach ($categoriesForAll as $category)
                                            <a href="{{ route('user.categoryDetails', $category) }}"
                                                class="dropdown-item border-radius-md text-dark font-weight-bolder ">
                                                <span>{!! $category->name !!}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                    {{-- Mobile --}}
                                    <div class="d-lg-none">
                                        @foreach ($categories as $category)
                                            <a href="{{ route('user.categoryDetails', $category) }}"
                                                class="dropdown-item border-radius-md text-light font-weight-bolder">
                                                <span>{!! $category->name !!}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            
                            @foreach ($menusForAll as $menu)
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center w3-text-white"
                                        id="dropdownMenuBlocks" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md w3-text-white">view_day</i>
                        
                                        {!! $menu->menu_title !!}
                                        <img src="{{ asset('template/assets/img/down-arrow-white.svg') }}"
                                            alt="down-arrow" class="arrow ms-auto ms-md-2">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                        aria-labelledby="dropdownMenuPages">
                                        {{-- Destop --}}
                                        <div class="d-none d-lg-block">
                                            @if ($menu->pages)
                                                @foreach ($menu->pages as $page)
                                                    <a href="{{ route('user.pageDetails',['url' => $page->slug , 'page' => $page->id]) }}"
                                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                        <span>{!! $page->page_title !!}</span>
                                                    </a>
                                                @endforeach
                                                <a href="{{ route('user.contactUs') }}"
                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                        <span>Contact Us</span>
                                    </a>

                                    <a href="{{ route('user.career') }}"
                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                        <span>Career</span>
                                    </a>

                                    <a href="{{ route('user.teams') }}"
                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                        <span>Featured Projects</span>
                                    </a>

                                    {{-- <a href="{{ route('donateNow') }}"
                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                        <span>ডোনেট করুন</span>
                                    </a>
 --}}
                                    {{-- <a href="{{ route('donation.track.page') }}"
                                        class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                        <span>ডোনেশনের আবেদন ট্র্যাকিং</span>
                                    </a> --}}


                                                @auth
 
                                                        <a href="{{ route('admin.dashboard') }}"
                                                           class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                                            <span>Admin Dashboard</span>
                                                        </a>
                                                 
                                                @endauth

                                            @endif
                                        </div>
                                        {{-- Mobile --}}
                                        <div class="d-lg-none">
                                          
                                            @if ($menu->pages)
                                                @foreach ($menu->pages as $page)
                                                    <a href="{{ route('user.pageDetails',['url' => $page->slug , 'page' => $page->id]) }}"
                                                        class="dropdown-item border-radius-md text-light font-weight-bolder">
                                                        <span>{!! $page->page_title !!}</span>
                                                    </a>
                                                @endforeach
                                                <a href="{{ route('user.contactUs') }}"
                                        class="dropdown-item border-radius-md text-light font-weight-bolder">
                                        <span>Contact Us</span>
                                    </a>

                                    <a href="{{ route('user.career') }}"
                                        class="dropdown-item border-radius-md text-light font-weight-bolder">
                                        <span>Career</span>
                                    </a>

                                    <a href="{{ route('user.teams') }}"
                                        class="dropdown-item border-radius-md text-light font-weight-bolder">
                                        <span>Featured Projects</span>
                                    </a>

                                    {{-- <a href="{{ route('donateNow') }}"
                                        class="dropdown-item border-radius-md text-light font-weight-bolder">
                                        <span>ডোনেট করুন</span>
                                    </a>

                                    <a href="{{ route('donation.track.page') }}"
                                        class="dropdown-item border-radius-md text-light font-weight-bolder">
                                        <span>ডোনেশনের আবেদন ট্র্যাকিং</span>
                                    </a> --}}


                                                @auth
 
                                                <a href="{{ route('admin.dashboard') }}"
                                                   class="dropdown-item border-radius-md text-light font-weight-bolder">
                                                    <span>Admin Dashboard</span>
                                                </a>
                                         
                                        @endauth


                                            @endif


                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center w3-text-white"
                                   id="dropdownMenuSeo" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons opacity-6 me-2 text-md w3-text-white">public</i>
                                    SEO
                                    <img src="{{ asset('template/assets/img/down-arrow-white.svg') }}"
                                         alt="down-arrow" class="arrow ms-auto ms-md-2">
                                </a>
                                <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                     aria-labelledby="dropdownMenuSeo">
                                    {{-- Desktop --}}
                                    <div class="d-none d-lg-block">
                                        <a href="{{ route('seo.sitemap') }}"
                                           class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                            <span>Sitemap (XML)</span>
                                        </a>
                                        <a href="{{ route('seo.llmsTxt') }}"
                                           class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                            <span>LLMs.txt</span>
                                        </a>
                                        <a href="{{ route('seo.aiSitemap') }}"
                                           class="dropdown-item border-radius-md text-dark font-weight-bolder">
                                            <span>AI content map</span>
                                        </a>
                                    </div>
                                    {{-- Mobile --}}
                                    <div class="d-lg-none">
                                        <a href="{{ route('seo.sitemap') }}"
                                           class="dropdown-item border-radius-md text-light font-weight-bolder">
                                            <span>Sitemap (XML)</span>
                                        </a>
                                        <a href="{{ route('seo.llmsTxt') }}"
                                           class="dropdown-item border-radius-md text-light font-weight-bolder">
                                            <span>LLMs.txt</span>
                                        </a>
                                        <a href="{{ route('seo.aiSitemap') }}"
                                           class="dropdown-item border-radius-md text-light font-weight-bolder">
                                            <span>AI content map</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>
