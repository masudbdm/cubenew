    @extends('admin.layouts.adminMaster')
    @push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        pre {
            background-color: #ccc;
            border: 0.5px solid #ccc;

        }


        span.select2-selection__choice__remove {
            color: #fff !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;

        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
    integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- End dropzone --}}
    @endpush
    @section('content')
    <div class="container-fluid">
        {{-- @include('alerts.alerts') --}}
        <h1>Edit Post <small>edit</small> </h1>
        <div class="card w3-light-gray">
            <div class="card-header w3-white">
                <div class="card-title  ">Edit Post</div>
            </div>
            @include('admin.media.addMediaDropzon')
            <input type="hidden" value="{{route('admin.mediaUploadDropZon')}}" id="route">
            <div class="card-body">
                <form action="{{ route('admin.updtePost', $post) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="publish_date">Publish Date</label>
                                                <input type="date" name="publish_date" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="publish_time">Publish Time</label>
                                                <input type="time" name="publish_time" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($post->published_at)->format('H:i') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                      
                                            <div class="form-group">
                                                <label for="project_location_id">Project Location</label>

                                                <select name="project_location_id"
                                                        id="project_location_id"
                                                        class="form-control select2"
                                                        data-placeholder="Select Location">

                                                    <option value="">Select Location</option>

                                                    @foreach($locations as $location)
                                                        <option value="{{ $location->id }}"
                                                            {{ old('project_location_id', $post->project_location_id) == $location->id ? 'selected' : '' }}>
                                                            {{ $location->title }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        
                                            {{-- <label for="author">Author/Writer</label>
                                            <select id="author" name="author"
                                            class="form-control user-select select2-container step2-select select2"
                                            data-placeholder="example@example.com"
                                            data-ajax-url="{{ route('admin.selectUserForAssignRole') }}"
                                            data-ajax-cache="true" data-ajax-dataType="json" data-ajax-delay="200"
                                            style="">
                                            <option selected="selected" value="{{ $post->writer ? $post->writer->id : '' }}">
                                                {{ $post->writer ? $post->writer->email : '' }}
                                            </option>
                                        </select> --}}

                                        @if ($websiteParameter->news_editions)
                                        <?php $version_Editions = explode(',', $websiteParameter->news_editions); ?>
                                        <div class="col-md-12">
                                            @foreach ($version_Editions as $vwise)
                                            {{ app()->setLocale($vwise) }}
                                            <div class="form-group">
                                                <label for="{{ $vwise }}_title">Title </label>
                                                <input type="text" class="form-control"
                                                name="{{ $vwise }}_title"
                                                placeholder="{{ $vwise }} Title"
                                                value="{{ $post->title }}">
                                            </div>
                                            @endforeach
                                            @foreach ($version_Editions as $vwise)
                                            {{ app()->setLocale($vwise) }}
                                            <div class="form-group">
                                                <label for="description_{{ $vwise }}">Description </label>
                                                <textarea name="{{ $vwise }}_description"
                                                class="tinyMC" id="summerNote" cols="30" rows="10"
                                                placeholder="{{ $vwise }} Description">{{ $post->description }}</textarea>
                                            </div>
                                            @endforeach

                                            @foreach ($version_Editions as $vwise)
                                            {{ app()->setLocale($vwise) }}
                                            <div class="form-group">
                                                <label for="{{ $vwise }}_excerpt">Excerpt </label>
                                                <textarea name="{{ $vwise }}_excerpt" id="excerpt"
                                                cols="30" rows="3"
                                                class="form-control">{{ $post->excerpt }}</textarea>
                                                @if ($errors->has('excerpt_' . $vwise . ''))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('excerpt_' . $vwise . '') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            @endforeach

                                            @foreach ($version_Editions as $vwise)
                                            {{ app()->setLocale($vwise) }}
                                            <div class="form-group">
                                                <label for="{{ $vwise }}_tags"
                                                class=" control-label">Tags
                                            (For Search)</label>
                                            <select id="{{ $vwise }}_tags"
                                            name="{{ $vwise }}_tags[]"
                                            class="form-control select2-tags select2-container step2-select select2"
                                            data-placeholder="Select {{ $vwise }} Tags From list or Add New"
                                            data-ajax-url="{{ route('admin.selectTagsOrAddNew') }}"
                                            data-ajax-cache="true" data-ajax-dataType="json"
                                            data-ajax-delay="200" multiple="multiple"
                                            style="width: 100%;">
                                            {{-- @if (count($post->tags)) --}}
                                            @if ($post->tags)
                                            @foreach ($post->tags as $ot)
                                            <option selected="selected">{{ $ot }}
                                            </option>
                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                @endif


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="publish" {{ $post->publish_status == 'published' ? 'checked' : ''  }}>Publish
                                            Instantly</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="front_slider" checked>Front</label>
                                        </div>
                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Update Feature Image</h3>
                                    </div>
                                    <div class="card-body">

                                        @if (!empty($post->feature_img_name))
                                        <div class="mb-3 text-center">
                                            <label class="d-block font-weight-bold">Current Feature Image</label>
                                            <img src="{{ asset('storage/media/image/' . $post->feature_img_name) }}"
                                            class="img-fluid img-thumbnail"
                                            style="max-height: 180px;">
                                        </div>
                                        @endif


                                        <div class="form-group {{ $errors->has('feature_image') ? ' has-error' : '' }}">
                                            <label for="feature_image" class="col-sm-5 form-control-label">Feature
                                            Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="feature_image" class=""
                                                id="feature_image">
                                                <span class="help-block">Image Dimention 300px X 200px or larger and
                                                    Ratio
                                                3/2.</span>

                                                @if ($errors->has('feature_image'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('feature_image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                        </div>
                                    </div>
                                </div>


                                <div class="card card-widget">
    <div class="card-header">
        <h3 class="card-title">Brochure File</h3>
    </div>

    <div class="card-body">

        {{-- Existing Brochure Preview --}}
        @if($post->brochure_file)

@php
    $filePath = 'storage/media/brochure/'.$post->brochure_file;

    $ext = strtolower(pathinfo($post->brochure_file, PATHINFO_EXTENSION));

    $originalName = $post->brochure_original_name ?? $post->brochure_file;

    $fileSize = Storage::disk('public')
                ->exists('media/brochure/'.$post->brochure_file)
                ? round(Storage::disk('public')
                ->size('media/brochure/'.$post->brochure_file)/1024,2)
                : 0;

    $imageTypes = ['jpg','jpeg','png','webp'];
    $pdfTypes = ['pdf'];
    $wordTypes = ['doc','docx'];

    if(in_array($ext,$imageTypes)){
        $icon = asset($filePath);
    }
    elseif(in_array($ext,$pdfTypes)){
        $icon = asset('admin/images/pdf.png');
    }
    elseif(in_array($ext,$wordTypes)){
        $icon = asset('admin/images/word.png');
    }
    else{
        $icon = asset('admin/images/file.png');
    }
@endphp


<div class="brochure-card">

    <div class="brochure-icon">

@php
    $icons = [
        'pdf' => ['icon' => 'fa-file-pdf', 'color' => '#e74c3c'],
        'doc' => ['icon' => 'fa-file-word', 'color' => '#3498db'],
        'docx' => ['icon' => 'fa-file-word', 'color' => '#3498db'],
        'jpg' => ['icon' => 'fa-file-image', 'color' => '#2ecc71'],
        'jpeg' => ['icon' => 'fa-file-image', 'color' => '#2ecc71'],
        'png' => ['icon' => 'fa-file-image', 'color' => '#2ecc71'],
        'webp' => ['icon' => 'fa-file-image', 'color' => '#2ecc71'],
    ];

    $defaultIcon = ['icon'=>'fa-file-alt','color'=>'#95a5a6'];

    $ext = strtolower(pathinfo($post->brochure_file, PATHINFO_EXTENSION));

    $iconData = $icons[$ext] ?? $defaultIcon;
@endphp

<i class="fas {{ $iconData['icon'] }}"
   style="font-size:60px;color:{{ $iconData['color'] }}">
</i>

</div>

    <div class="brochure-info">

        <div class="brochure-title">
            {{ $originalName }}
        </div>

        <div class="brochure-meta">
            Type: {{ strtoupper($ext) }} |
            Size: {{ $fileSize }} KB
        </div>

        <div class="mt-2">
            <a href="{{ asset($filePath) }}"
               target="_blank"
               class="btn btn-sm btn-primary">
                Download / View
            </a>
        </div>

    </div>

</div>


<style>
.brochure-card{
    display:flex;
    align-items:center;
    gap:15px;
    padding:15px;
    border-radius:12px;
    border:1px solid #eee;
    transition:0.3s;
    background:#fff;
}

.brochure-card:hover{
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
    transform:translateY(-2px);
}

.brochure-icon img{
    width:60px;
    height:60px;
    object-fit:contain;
}

.brochure-title{
    font-weight:600;
    font-size:15px;
    color:#333;
}

.brochure-meta{
    font-size:13px;
    color:#888;
}
</style>

@endif

        {{-- Upload New File --}}
        <div class="form-group">
            <label>Upload New Brochure (Image/PDF/Word)</label>
            <input type="file" name="brochure_file" class="form-control">

            <small class="text-muted">
                Allowed: jpg, jpeg, png, webp, pdf, doc, docx
            </small>

            @error('brochure_file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>


                            </div>
                            <div class="col-md-12">




                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

    <!-- Existing fields এখানে থাকছে... -->

    <!-- New Property Fields -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="land">Land</label>
            <input type="text" name="land" class="form-control"
                value="{{ old('land', $post->land) }}" placeholder="Enter Land">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="specialty">Specialty</label>
            <input type="text" name="specialty" class="form-control"
                value="{{ old('specialty', $post->specialty) }}" placeholder="Enter Specialty">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="front_road">Front Road</label>
            <input type="text" name="front_road" class="form-control"
                value="{{ old('front_road', $post->front_road) }}" placeholder="Enter Front Road">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="floors">Floors</label>
            <input type="text" name="floors" class="form-control"
                value="{{ old('floors', $post->floors) }}" placeholder="Enter Floors">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="apartments">Apartments</label>
            <input type="text" name="apartments" class="form-control"
                value="{{ old('apartments', $post->apartments) }}" placeholder="Enter Apartments">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control"
                value="{{ old('size', $post->size) }}" placeholder="Enter Size (sqft)">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="basements">Basements</label>
            <input type="text" name="basements" class="form-control"
                value="{{ old('basements', $post->basements) }}" placeholder="Enter Basements">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="no_of_car_parking">No of Car Parking</label>
            <input type="text" name="no_of_car_parking" class="form-control"
                value="{{ old('no_of_car_parking', $post->no_of_car_parking) }}" placeholder="Enter Parking Spaces">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="number_of_bedrooms">Number of Bedrooms</label>
            <input type="text" name="number_of_bedrooms" class="form-control"
                value="{{ old('number_of_bedrooms', $post->number_of_bedrooms) }}" placeholder="Enter Number of Bedrooms">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="rajuk_approval_number">Rajuk Approval Number</label>
            <input type="text" name="rajuk_approval_number" class="form-control"
                value="{{ old('rajuk_approval_number', $post->rajuk_approval_number) }}" placeholder="Enter Rajuk Approval Number">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="engineer_name">Architect Name</label>
            <input type="text" name="engineer_name" class="form-control"
                value="{{ old('engineer_name', $post->engineer_name) }}" placeholder="Enter Architect Name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control"
                value="{{ old('address', $post->address) }}" placeholder="Enter Address">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="yt_video_code">Youtube Video Code</label>
            <input type="text" name="yt_video_code" class="form-control"
                value="{{ old('yt_video_code', $post->yt_video_code) }}" placeholder="Enter Youtube Video Code">
        </div>
    </div>

    

    <div class="col-md-6">
        <div class="form-group">
            <label for="lat">Latitude</label>
            <input type="text" name="lat" class="form-control"
                value="{{ old('lat', $post->lat) }}" placeholder="Enter Latitude">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lng">Longitude</label>
            <input type="text" name="lng" class="form-control"
                value="{{ old('lng', $post->lng) }}" placeholder="Enter Longitude">
        </div>
    </div>



    <div class="col-md-12">
        <div class="form-group">
            <label for="lng">Google Map</label>
            <textarea name="google_map" rows="2" class="form-control">{{ old('lng', $post->google_map) }}</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="mb-3">Project Images (Gallery)</h5>

                <div class="form-group">
                    <label for="post_images">Upload multiple images</label>
                    <input type="file" name="post_images[]" id="post_images" class="form-control" multiple accept="image/*">
                    <small class="text-muted">You can select multiple images at once. Recommended: JPG/PNG/WEBP.</small>
                </div>

                @if($post->images && $post->images->count())
                    <div class="mt-3">
                        <label class="d-block mb-2">Existing images (edit description / order, or select to remove)</label>
                        <div class="row">
                            @foreach($post->images as $img)
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="border rounded p-3">
                                        <div class="d-flex gap-3">
                                            <img src="{{ asset('storage/'.$img->image_path) }}"
                                                 alt="image"
                                                 class="img-fluid"
                                                 style="width:160px;max-width:160px;height:120px;object-fit:cover;border-radius:10px;">
                                            <div class="flex-grow-1">
                                                <div class="form-group mb-2">
                                                    <label class="small text-muted mb-1">Description (optional)</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="post_image_meta[{{ $img->id }}][description]"
                                                           value="{{ old('post_image_meta.'.$img->id.'.description', $img->description) }}"
                                                           maxlength="500"
                                                           placeholder="e.g. Lobby / Exterior / Living room">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="small text-muted mb-1">Sort order</label>
                                                    <input type="number"
                                                           class="form-control"
                                                           name="post_image_meta[{{ $img->id }}][sort_order]"
                                                           value="{{ old('post_image_meta.'.$img->id.'.sort_order', $img->sort_order) }}"
                                                           style="max-width:140px">
                                                </div>
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           name="remove_post_image_ids[]"
                                                           value="{{ $img->id }}"
                                                           id="remove_post_image_{{ $img->id }}">
                                                    <label class="form-check-label" for="remove_post_image_{{ $img->id }}">
                                                        Remove this image
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



</div>
                                        
                                    </div>
                                </div>


                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Add Category / Subcategory</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="extra_file" class=" control-label"></label>
                                            <div class="row">
                                                @foreach ($cats->chunk(2) as $cats2)
                                                @foreach ($cats2 as $cat)
                                                <div class="col-sm-3">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="categories[]"
                                                            value="{{ $cat->id }}"
                                                            {{ $cat->hasPost($post) ? 'checked' : '' }}>&nbsp;{{ $cat->name }}</label>
                                                        </div>
                                                        @if ($cat->subcats)
                                                        <div class="pl-2">
                                                            @foreach ($cat->subcats as $sc)
                                                            <div class="checkbox">
                                                                <label><input type="checkbox"
                                                                    name="subCategories[]"
                                                                    value="{{ $sc->id }}"
                                                                    {{ $sc->hasPost($post) ? 'checked' : '' }}>&nbsp;{{ $sc->name }}</label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                        </div>

                                                        @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <input type="submit" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endsection

                @push('js')
                <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
                <script src="{{ asset('admin/plugins/summernote/summernote.min.js') }}"></script>



                <script>
                    $(document).ready(function() {
                        $('.select2').select2({
                            theme: 'bootstrap4'
                        });

                        $('.step2-select').select2({
                            theme: 'bootstrap4',
                    // minimumInputLength: 1,
                            ajax: {
                                data: function(params) {
                                    return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            // alert(data[0].s);
                            var data = $.map(data, function(obj) {
                                obj.id = obj.id || obj.id;
                                return obj;
                            });
                            var data = $.map(data, function(obj) {
                                obj.text = obj.email;
                                return obj;
                            });
                            return {
                                results: data,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        }
                    },
                });

                        $('#summerNote').summernote();
                        $('.summerNote').summernote();
                        $('.summernote').each(function(i, obj) {
                            $(obj).summernote({
                                onblur: function(e) {
                                    var id = $(obj).data('id');
                                    var sHTML = $(obj).code();
                                    alert(sHTML);
                                }
                            });
                        });

                        $('.select2-tags').select2({
                            minimumInputLength: 1,
                            tags: true,
                            tokenSeparators: [','],
                            ajax: {
                                data: function(params) {
                                    return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            // alert(data[0].s);
                            var data = $.map(data, function(obj) {
                                obj.id = obj.id || obj.title;
                                return obj;
                            });
                            var data = $.map(data, function(obj) {
                                obj.text = obj.text || obj.title;
                                return obj;
                            });
                            return {
                                results: data,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        }
                    },
                });
                    });
                </script>

                @endpush
