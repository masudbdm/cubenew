@extends('admin.layouts.adminMaster')
@push('css')
<style>
    .post-reorder-handle {
        cursor: grab;
        user-select: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
    }
    .post-reorder-row.is-dragging {
        background: #fff3cd !important;
    }
</style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    All Posts
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th style="width: 56px;">Sort</th>
                                <th>#ID</th>
                                <th>Action</th>
                                <th>Title</th>
            
                                <th>Image</th>
                                <th>Brochure</th>
                                {{-- <th>Applications</th> --}}
                                <th>Tags</th>
                                <th>Categories</th>
                                <th>Subcategories</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody id="js-posts-sortable">
                            @forelse ($posts as $post)
                                <tr class="post-reorder-row" data-post-id="{{ $post->id }}">
                                    <td>
                                        <span class="post-reorder-handle" title="Drag to reorder">
                                            <i class="fas fa-grip-vertical"></i>
                                        </span>
                                    </td>

                                    <td>{{ $post->id }}</td>
                                    <td>
    <div class="btn-group btn-sm pull-right">
        <a class="btn btn-primary btn-xs" href="{{ route('admin.editPost',$post) }}">Edit</a>
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu px-2" role="menu">
            <li><a href="{{ route('admin.viewPost',$post->slug) }}">Details</a></li>
            {{-- <li class="dropdown-divider"></li>
            <li><a href="{{ route('admin.post.applications', [$post->id, 'pending']) }}">Pending Applications ({{ $post->pendingApplications()->count() }})</a></li>
            <li><a href="{{ route('admin.post.applications', [$post->id, 'approved']) }}">Approved Applications ({{ $post->approvedApplications()->count() }})</a></li>
            <li><a href="{{ route('admin.post.applications', [$post->id, 'delivered']) }}">Delivered Applications ({{ $post->deliveredApplications()->count() }})</a></li> --}}
        </ul>
    </div>
</td>

                                    <td>{{ Str::limit($post->title,20) }}</td>
                                     
                                    <td> @if($post->feature_img_name)
        <img src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $post->fi() ]) }}"
             alt="Post Image"
             style="width: 80px; height: auto; border-radius: 4px;">
    @else
        <span class="text-muted">No Image</span>
    @endif</td>

    <td>
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
    </td>
    {{-- <td>
       Pending: {{ $post->pendingApplications()->count() }} <br>
       Approved: {{ $post->approvedApplications()->count() }} <br>
       Delivered: {{ $post->deliveredApplications()->count() }}
    </td> --}}
                                    <td>
                                        @if ($post->tags)
                                            @foreach ($post->tags as $item)
                                                <span class="badge badge-info">{{ $item }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->categories)
                                            @foreach ($post->categories as $item)
                                                <span class="badge badge-success">{{ $item->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->subcategories)
                                            @foreach ($post->subcategories as $item)
                                                <span class="badge badge-warning">{{ $item->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        {{ optional($post->location)->title }}
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
(function () {
    var el = document.getElementById('js-posts-sortable');
    if (!el || typeof Sortable === 'undefined') return;

    var saveTimer = null;
    function collectIds() {
        return Array.prototype.slice.call(el.querySelectorAll('tr[data-post-id]'))
            .map(function (tr) { return parseInt(tr.getAttribute('data-post-id'), 10); })
            .filter(function (v) { return !Number.isNaN(v); });
    }

    function saveOrder() {
        var ids = collectIds();
        if (!ids.length) return;

        fetch("{{ route('admin.posts.reorder') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({ ids: ids })
        }).catch(function () {
            // Silent fail; admin can retry by dragging again.
        });
    }

    new Sortable(el, {
        animation: 150,
        handle: ".post-reorder-handle",
        ghostClass: "is-dragging",
        onEnd: function () {
            window.clearTimeout(saveTimer);
            saveTimer = window.setTimeout(saveOrder, 150);
        }
    });
})();
</script>
@endpush
