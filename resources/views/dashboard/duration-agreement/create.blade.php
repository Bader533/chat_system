@extends('dashboard.parent')

@section('title',__('site.duration-agreement'))

@section('page_name',__('site.duration-agreement'))

@section('css')
@endsection

@section('bread_crumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('site.home')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{__('site.duration-agreement')}}</li>
    <!--end::Item-->
</ul>
@endsection

@section('actions')

@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row">
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__('site.information')}}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::title-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">{{__('site.title')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="title" id="title" class="form-control mb-2"
                                    placeholder="{{__('site.title')}}" @if($duration) value="{{$duration->title}}"
                                    @endif required />
                                <!--end::Input-->
                                <!--begin::Description-->
                                {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                                </div> --}}
                                <!--end::Description-->
                            </div>
                            <!--end::title-->

                            <!--begin::description-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">{{__('site.description')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea id="kt_docs_tinymce_basic">
                                    @if($duration)
                                    {!! $duration->description !!}
                                    @endif
                                </textarea>
                                <!--end::Input-->
                                <!--begin::Description-->
                                {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                                </div> --}}
                                <!--end::Description-->
                            </div>
                            <!--end::description-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{route('boarding.index')}}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">{{__('site.cancel')}}</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="kt_ecommerce_add_category_submit" class="btn btn-primary"
                            onclick="store()">
                            <span class="indicator-label">{{__('site.submit')}}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </form>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content container-->
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
<script>
    buttonSideBar()

    function store() {
        axios.post('/duration-agreement',{
            title: document.getElementById('title').value,
            description: tinymce.get("kt_docs_tinymce_basic").getContent(),
        })
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
        }).catch(function (error) {
            // console.log(error);
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.error(error.response.data.message);
        });
    }

    function buttonSideBar() {
        const button = document.getElementById('duration-agreement');
        button.classList.add('active');
        //button.classList.add('here', 'show');
    }

    var options = {selector: "#kt_docs_tinymce_basic", height : "480"};

    if ( KTThemeMode.getMode() === "dark" ) {
    options["skin"] = "oxide-dark";
    options["content_css"] = "dark";
    }

    tinymce.init(options);
</script>
@endsection
