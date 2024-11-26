@extends('dashboard.parent')

@section('title',__('site.ads'))

@section('page_name',__('site.ads'))

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
    <li class="breadcrumb-item text-muted">{{__('site.ads')}}</li>
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
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::avatar-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('site.avatar')}}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            <!--begin::Image input placeholder-->
                            <style>
                                .image-input-placeholder {
                                    background-image: url('{{asset("assets/media/svg/files/blank-image.svg")}}');
                                }
                            </style>
                            <!--end::Image input placeholder-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <!--begin::Icon-->
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--end::Icon-->
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::avatar-->

                    <!--begin::Status-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('site.status')}}</h2>
                            </div>
                            <!--end::Card title-->

                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                data-placeholder="Select an option" id="status">
                                <option></option>
                                <option value="1" selected="selected">{{__('site.active')}}</option>
                                <option value="0">{{__('site.non_active')}}</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->

                    <!--begin::is home-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{__('site.is_home')}}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                data-placeholder="Select an option" id="is_home">
                                <option></option>
                                <option value="1" selected="selected">{{__('site.yes')}}</option>
                                <option value="0">{{__('site.no')}}</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::is home-->
                </div>
                <!--end::Aside column-->
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

                            <!--begin::name-->
                            <div class="row">
                                <div class="col-6 mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{__('site.name_en')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name_en" id="name_en" class="form-control mb-2"
                                        placeholder="{{__('site.name_en')}}" required />
                                    <!--end::Input-->
                                </div>
                                <div class="col-6 mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{__('site.name_ar')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name_ar" id="name_ar" class="form-control mb-2"
                                        placeholder="{{__('site.name_ar')}}" required />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::name-->

                            <!--begin::description-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">{{__('site.description_en')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control mb-2" id="kt_docs_tinymce_basic">

                                </textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::description-->

                            <!--begin::description-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">{{__('site.description_ar')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control mb-2" id="kt_docs_tinymce_basic_ar">

                                </textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::description-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{route('ads.index')}}" id="kt_ecommerce_add_product_cancel"
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
    // buttonSideBar()

    function store() {
        let formData = new FormData();
        formData.append("status", document.getElementById('status').value);
        formData.append("is_home", document.getElementById('is_home').value);
        formData.append("name_en", document.getElementById('name_en').value);
        formData.append("name_ar", document.getElementById('name_ar').value);
        formData.append("description_en", tinymce.get("kt_docs_tinymce_basic").getContent());
        formData.append("description_ar", tinymce.get("kt_docs_tinymce_basic_ar").getContent());
        formData.append("avatar",document.getElementById('avatar').files[0]);

        axios.post('/ads',formData)
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            location.reload();
        }).catch(function (error) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.error(error.response.data.message);
        });

    }

    var options = {selector: "#kt_docs_tinymce_basic", height : "480"};

    tinymce.init(options);

    var kt_docs_tinymce_basic_ar = {selector: "#kt_docs_tinymce_basic_ar", height : "480"};
    tinymce.init(kt_docs_tinymce_basic_ar);
</script>
@endsection