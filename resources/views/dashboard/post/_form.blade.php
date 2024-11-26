<form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

        <!--begin::Thumbnail settings-->
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
                        background-image: url('{{asset($post->avatar_url ?? "assets/media/svg/files/blank-image.svg")}}');
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
                        <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" required />
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
                <!--begin::Description-->
                <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and *.jpeg
                    image files are accepted</div>
                <!--end::Description-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Thumbnail settings-->

        <!--begin::status-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{__('site.status')}}</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    {{-- <div class="rounded-circle bg-success w-15px h-15px">
                    </div> --}}
                </div>
                <!--begin::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Select2-->
                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                    data-placeholder="Select an option" id="status" required>
                    <option></option>
                    <option value="1" @selected(($post->status ?? null) == 1)>{{__('site.active')}}</option>
                    <option value="0" @selected(($post->status ?? null) == 0)>{{__('site.non_active')}}</option>
                </select>
                <!--end::Select2-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Status-->

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

                <!--begin::title-->
                <div class="row">
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.title_en')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="title_en" id="title_en" value="{{$post->title_en ?? null}}"
                            class="form-control mb-2" placeholder="{{__('site.title_en')}}" required />
                        <!--end::Input-->
                    </div>
                    <div class="col-6 mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.title_ar')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="title_ar" id="title_ar" value="{{$post->title_ar ?? null}}"
                        class="form-control mb-2" placeholder="{{__('site.title_ar')}}" required />
                    <!--end::Input-->
                </div>
                </div>
                <!--end::title-->

                <!--begin::description-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.description_en')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <textarea class="form-control mb-2" name="description_en" id="description_en" cols="30"
                        rows="10">{{$post->description_en ?? null}}</textarea>
                    <!--end::Input-->
                </div>
                <!--end::description-->

                <!--begin::description-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.description_ar')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <textarea class="form-control mb-2" name="description_ar" id="description_ar" cols="30"
                        rows="10">{{$post->description_ar ?? null}}</textarea>
                    <!--end::Input-->
                </div>
                <!--end::description-->

            </div>
            <!--end::Card header-->
        </div>
        <!--end::General options-->
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{route('post.index')}}" id="kt_ecommerce_add_product_cancel"
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