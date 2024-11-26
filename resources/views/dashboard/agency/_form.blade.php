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
                        background-image: url('{{$agency->avatar_url ?? asset("assets/media/svg/files/blank-image.svg")}}');
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
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
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
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Cancel-->
                    <!--begin::Remove-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
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
                    <option value="1" @if(($agency->status ?? null) == 1) selected="selected"
                        @endif>{{__('site.active')}}
                    </option>
                    <option value="0" @if(($agency->status ?? null) == 0) selected="selected"
                        @endif>{{__('site.non_active')}}
                    </option>
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
                    <option value="1" @if(($agency->is_home ?? null) == 1) selected="selected" @endif>{{__('site.yes')}}
                    </option>
                    <option value="0" @if(($agency->is_home ?? null) == 0) selected="selected" @endif>{{__('site.no')}}
                    </option>
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
                        <input type="text" name="name_en" id="name_en" value="{{$agency->name_en ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.name_en')}}" required />
                        <!--end::Input-->
                    </div>
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.name_ar')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="name_ar" id="name_ar" value="{{$agency->name_ar ?? null}}" class="form-control mb-2"
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
                            {!! $agency->description_en ?? null !!}
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
                            {!! $agency->description_ar ?? null !!}
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
            <a href="{{route('agency.index')}}" id="kt_ecommerce_add_product_cancel"
                class="btn btn-light me-5">{{__('site.cancel')}}</a>
            <!--end::Button-->
            <!--begin::Button-->
            <button type="button" id="kt_ecommerce_add_category_submit" class="btn btn-primary"
                onclick="{{$function}}()">
                <span class="indicator-label">{{__('site.submit')}}</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
        </div>
    </div>
    <!--end::Main column-->
</form>