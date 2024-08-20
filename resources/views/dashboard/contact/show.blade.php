@extends('dashboard.parent')

@section('title',__('site.contact'))

@section('page_name',__('site.contact'))

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
    <li class="breadcrumb-item text-muted">{{__('site.contact')}}</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{__('site.show')}}</li>
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
                            <!--begin::f_name-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label">{{__('site.f_name')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control mb-2" value="{{$contact->f_name}}" disabled />
                                <!--end::Input-->
                            </div>
                            <!--end::f_name-->

                            <!--begin::l_name-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label">{{__('site.l_name')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control mb-2" value="{{$contact->l_name}}" disabled />
                                <!--end::Input-->
                            </div>
                            <!--end::l_name-->

                            <!--begin::email-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label">{{__('site.email')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control mb-2" value="{{$contact->email}}" disabled />
                                <!--end::Input-->
                            </div>
                            <!--end::email-->

                            <!--begin::subject-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label">{{__('site.subject')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control mb-2" value="{{$contact->subject}}" disabled />
                                <!--end::Input-->
                            </div>
                            <!--end::subject-->

                            <!--begin::message-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label">{{__('site.message')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control mb-2" disabled>
                                    {!! $contact->message !!}
                                </textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::message-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    {{-- <div class="d-flex justify-content-end">
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
                    </div> --}}
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

@endsection
