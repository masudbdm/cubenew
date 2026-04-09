@extends('home.layouts.pageMaster')

@push('meta')
<meta property="og:type" content="website">
@endpush

@push('css')
<style>
/* Search bar styling (shared look with homepage) */
.project-search-wrap {
    position: relative;
    perspective: 1200px;
    z-index: 30;
}
.project-search-shell {
    position: relative;
    border-radius: 1.5rem;
    padding: 2px;
    overflow: visible;
    z-index: 31;
    background: linear-gradient(125deg, rgba(255, 255, 255, 0.95), rgba(248, 250, 252, 0.88), rgba(255, 255, 255, 0.92));
    box-shadow: 0 4px 6px rgba(15, 23, 42, 0.04), 0 24px 48px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
}
.project-search-shell::before{
    content:"";
    position:absolute;
    inset:-2px;
    border-radius: inherit;
    padding:2px;
    background: linear-gradient(var(--ps-angle, 135deg), {{ $websiteParameter->primary_color }}88, {{ $websiteParameter->secondary_color ?? $websiteParameter->primary_color }}aa, #6366f1aa, {{ $websiteParameter->primary_color }}99);
    background-size: 300% 300%;
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    animation: psBorderFlow 8s ease infinite;
    z-index: 0;
    pointer-events: none;
}
.project-search-shell::after{
    content:"";
    position:absolute;
    inset:0;
    border-radius: calc(1.5rem - 2px);
    background:
        radial-gradient(ellipse 80% 60% at 10% 0%, rgba(255,255,255,0.65), transparent 50%),
        radial-gradient(ellipse 70% 50% at 100% 100%, {{ $websiteParameter->primary_color }}18, transparent 55%),
        linear-gradient(165deg, rgba(255,255,255,0.92) 0%, rgba(248,250,252,0.85) 100%);
    z-index: 0;
    pointer-events: none;
}
.project-search-shell__inner{
    position: relative;
    z-index: 2;
    padding: 1.2rem 1.15rem 1.25rem;
    border-radius: calc(1.5rem - 2px);
}
@media (min-width: 768px){
    .project-search-shell__inner{ padding: 1.35rem 1.6rem 1.55rem; }
}
.ps-field{ position: relative; overflow: visible; z-index: 1; }
.ps-field label{
    display:block; font-size:0.72rem; font-weight:600; letter-spacing:.04em; text-transform:uppercase;
    color:#64748b; margin-bottom:.45rem;
}
.ps-select-wrap{
    position:relative; display:flex; align-items:stretch; border-radius:.85rem;
    background: rgba(255,255,255,.85);
    border: 1px solid rgba(15,23,42,.08);
    box-shadow: 0 1px 2px rgba(15,23,42,.04);
    overflow: visible;
}
.ps-select-icon{
    display:flex; align-items:center; justify-content:center; width:2.65rem; flex-shrink:0;
    color: {{ $websiteParameter->primary_color }};
    background: linear-gradient(180deg, rgba(255,255,255,.5), rgba(248,250,252,.3));
    border-right: 1px solid rgba(15,23,42,.06);
    border-radius: .85rem 0 0 .85rem;
}
.project-search-choices{ position: relative; flex:1 1 0; min-width:0; margin-bottom:0 !important; }
.project-search-choices .choices__inner{
    min-height:48px;
    padding: .55rem 2.5rem .55rem .75rem !important;
    border-radius: 0 .85rem .85rem 0 !important;
    border:none !important;
    background: transparent !important;
    background-image:none !important;
    box-shadow:none !important;
    font-size:.9375rem;
    font-weight:600;
    color:#0f172a;
}
.project-search-choices .choices__list--single{ padding:0 !important; }
.project-search-choices .choices__list--single .choices__item{ margin-bottom:0 !important; }
.project-search-choices::after{
    content:"\f078";
    font-family:"Font Awesome 6 Free";
    font-weight:900;
    position:absolute;
    right:.95rem;
    top:50%;
    transform: translateY(-50%);
    font-size:.65rem;
    color:#94a3b8;
    pointer-events:none;
    transition: transform .3s ease, color .2s ease;
    z-index:3;
}
.project-search-choices.is-open::after{
    color: {{ $websiteParameter->primary_color }};
    transform: translateY(-50%) rotate(180deg);
}
.project-search-choices .choices__list--dropdown{
    visibility:hidden;
    opacity:0;
    pointer-events:none;
    transform: translateY(-6px) scale(0.99);
    transition: opacity .18s ease, transform .22s cubic-bezier(0.22, 1, 0.36, 1), visibility 0s linear .22s;
    position:absolute !important;
    left:0 !important;
    right:0 !important;
    top:100% !important;
    margin-top:.45rem !important;
    border-radius:1rem !important;
    border:1px solid rgba(15,23,42,.08) !important;
    background: rgba(255,255,255,.97) !important;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    box-shadow: 0 4px 6px rgba(15,23,42,.04), 0 18px 40px rgba(15,23,42,.12), 0 0 0 1px rgba(255,255,255,.9) inset !important;
    overflow:hidden;
    z-index: 9999 !important;
}
.project-search-choices.is-open .choices__list--dropdown{
    visibility: visible;
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0) scale(1);
    transition-delay: 0s;
    animation: psChoicesReveal .28s cubic-bezier(0.22, 1, 0.36, 1) both;
}
.project-search-choices .choices__list--dropdown .choices__list{
    max-height: 280px !important;
    overflow-y:auto !important;
    padding: .35rem 0 !important;
    overscroll-behavior: contain;
}
.project-search-choices .choices__list--dropdown .choices__item--choice{
    padding:.7rem 1rem !important;
    margin:.2rem .45rem !important;
    border-radius:.65rem !important;
    font-size:.9rem;
    font-weight:600;
    color:#0f172a;
    transition: background .2s ease, transform .15s ease;
}
.project-search-choices .choices__list--dropdown .choices__item--choice.is-highlighted{
    background: linear-gradient(135deg, {{ $websiteParameter->primary_color }}18, {{ $websiteParameter->secondary_color ?? $websiteParameter->primary_color }}12) !important;
    transform: translateY(-1px);
}
.ps-search-btn{
    height:48px;
    padding:0 22px;
    border:none;
    border-radius:8px;
    font-weight:600;
    color:#fff !important;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    box-shadow: 0 8px 20px rgba(0,114,255,0.28);
    transition: all .3s ease;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:.5rem;
    width:100%;
}
.ps-search-btn:hover{ transform: translateY(-2px); box-shadow: 0 12px 26px rgba(0,114,255,0.36); }
.ps-search-btn:active{ transform: translateY(-1px); }
@keyframes psBorderFlow{ 0%,100%{ background-position:0% 50%; } 50%{ background-position:100% 50%; } }
@keyframes psChoicesReveal{ from{ opacity:0; transform: translateY(-6px) scale(.985);} to{ opacity:1; transform: translateY(0) scale(1);} }
</style>
@endpush

@section('content')
    <div class="container-fluid mt-5 mx-0">
        <div class="row">
            <div class="mb-3">
                <nav class="w-100 w-md-50 w-lg-20" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.welcome') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                    </ol>
                </nav>
            </div>

            {{-- Search bar (preselected from query string) --}}
            @isset($projectSearchPayload)
                <div class="col-12 mb-4">
                    <section class="project-search-wrap" id="project-search-page-bar" aria-label="Project search">
                        <div class="container px-3 px-md-4">
                            <div class="project-search-shell">
                                <div class="project-search-shell__inner">
                                    <form method="get" action="{{ route('user.projectSearch') }}" class="project-search-form mb-0">
                                        <div class="row g-3 align-items-end">
                                            <div class="col-12 col-md">
                                                <div class="ps-field">
                                                    <label for="psp-location">Location</label>
                                                    <div class="ps-select-wrap">
                                                        <span class="ps-select-icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                                                        <select name="location_id" id="psp-location" class="form-control" required>
                                                            <option value="">Select location</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <div class="ps-field">
                                                    <label for="psp-category">Category</label>
                                                    <div class="ps-select-wrap">
                                                        <span class="ps-select-icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                                                        <select name="category_id" id="psp-category" class="form-control" required>
                                                            <option value="">Select category</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md">
                                                <div class="ps-field">
                                                    <label for="psp-subcategory">Subcategory</label>
                                                    <div class="ps-select-wrap">
                                                        <span class="ps-select-icon" aria-hidden="true"><i class="fas fa-tags"></i></span>
                                                        <select name="subcategory_id" id="psp-subcategory" class="form-control" required>
                                                            <option value="">Select subcategory</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-auto">
                                                <button type="submit" class="ps-search-btn w-100">
                                                    <span>Search</span>
                                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script type="application/json" id="project-search-page-data">@json($projectSearchPayload)</script>
                        @php
                            $projectSearchSelected = [
                                'location_id' => request()->get('location_id'),
                                'category_id' => request()->get('category_id'),
                                'subcategory_id' => request()->get('subcategory_id'),
                            ];
                        @endphp
                        <script type="application/json" id="project-search-page-selected">@json($projectSearchSelected)</script>
                    </section>
                </div>
            @endisset

            <div class="col-md-8 px-0 mb-3">
                <div class="card">
                    <div class="tab-content tab-space card-body">
                        <div class="tab-pane active">
                            @if ($posts->count())
                                <div class="row">
                                    @foreach ($posts as $post)
                                        <div class="col-md-4 col-12 w3-animate-zoom mb-3">
                                            @include('home.partials.postCard')
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $posts->links() }}
                                </div>
                            @else
                                <p class="mb-0 text-muted">No projects match this combination.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

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

@push('js')
<script src="{{ asset('template/assets/js/plugins/choices.min.js') }}"></script>
<script>
(function () {
    var dataEl = document.getElementById('project-search-page-data');
    var selEl = document.getElementById('project-search-page-selected');
    if (!dataEl || !selEl) return;

    var data, selected;
    try { data = JSON.parse(dataEl.textContent); } catch (e) { return; }
    try { selected = JSON.parse(selEl.textContent); } catch (e) { selected = {}; }

    var locSel = document.getElementById('psp-location');
    var catSel = document.getElementById('psp-category');
    var subSel = document.getElementById('psp-subcategory');
    if (!locSel || !catSel || !subSel) return;

    var useChoices = typeof window.Choices === 'function';
    var choiceLoc = null, choiceCat = null, choiceSub = null;

    function destroyChoice(inst){ if(!inst) return null; try{ inst.destroy(); }catch(e){} return null; }
    function bindChoices(selectEl){
        if (!useChoices) return null;
        return new window.Choices(selectEl, {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false,
            position: 'bottom',
            allowHTML: false,
            classNames: { containerOuter: 'choices project-search-choices' }
        });
    }
    function setValue(inst, selectEl, value){
        if (!value) return;
        if (inst && typeof inst.setChoiceByValue === 'function') {
            inst.setChoiceByValue(String(value));
        } else {
            selectEl.value = String(value);
        }
    }

    function categoryName(id){
        var c = (data.categories || []).find(function(x){ return Number(x.id) === Number(id); });
        return c ? c.name : '';
    }
    function subName(id){
        var s = (data.subcategories || []).find(function(x){ return Number(x.id) === Number(id); });
        return s ? s.name : '';
    }

    function fillCategories(locId){
        choiceCat = destroyChoice(choiceCat);
        choiceSub = destroyChoice(choiceSub);
        catSel.innerHTML = '<option value="">Select category</option>';
        subSel.innerHTML = '<option value="">Select subcategory</option>';
        var ids = data.locationCategories[locId] || data.locationCategories[String(locId)] || [];
        ids.forEach(function(cid){
            var opt = document.createElement('option');
            opt.value = cid;
            opt.textContent = categoryName(cid);
            catSel.appendChild(opt);
        });
        choiceCat = bindChoices(catSel);
        choiceSub = bindChoices(subSel);
    }

    function fillSubcats(locId, catId){
        choiceSub = destroyChoice(choiceSub);
        subSel.innerHTML = '<option value="">Select subcategory</option>';
        var key = String(locId) + '_' + String(catId);
        var ids = data.locationCategorySubcategories[key] || [];
        ids.forEach(function(sid){
            var opt = document.createElement('option');
            opt.value = sid;
            opt.textContent = subName(sid);
            subSel.appendChild(opt);
        });
        choiceSub = bindChoices(subSel);
    }

    // Populate locations
    (data.locations || []).forEach(function(loc){
        var opt = document.createElement('option');
        opt.value = loc.id;
        opt.textContent = loc.title;
        locSel.appendChild(opt);
    });

    // Init
    choiceLoc = bindChoices(locSel);
    choiceCat = bindChoices(catSel);
    choiceSub = bindChoices(subSel);

    // Preselect from query string
    var lid = selected.location_id ? parseInt(selected.location_id, 10) : null;
    var cid = selected.category_id ? parseInt(selected.category_id, 10) : null;
    var sid = selected.subcategory_id ? parseInt(selected.subcategory_id, 10) : null;

    if (lid) {
        setValue(choiceLoc, locSel, lid);
        fillCategories(lid);
        if (cid) {
            setValue(choiceCat, catSel, cid);
            fillSubcats(lid, cid);
            if (sid) {
                setValue(choiceSub, subSel, sid);
            }
        }
    }

    // Cascade on user change
    locSel.addEventListener('change', function(){
        var v = this.value;
        if (!v) return;
        fillCategories(parseInt(v, 10));
    });
    catSel.addEventListener('change', function(){
        var v = this.value;
        if (!v || !locSel.value) return;
        fillSubcats(parseInt(locSel.value, 10), parseInt(v, 10));
    });
})();
</script>
@endpush
