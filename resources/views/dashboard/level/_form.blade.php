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
                        background-image: url('{{asset($level->avatar_url ?? "assets/media/svg/files/blank-image.svg")}}');
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
                        <input type="text" name="name_en" id="name_en" value="{{$level->name_en ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.name_en')}}" required />
                        <!--end::Input-->
                    </div>
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.name_ar')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="name_ar" id="name_ar" value="{{$level->name_ar ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.name_ar')}}" required />
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::name-->

                <!--begin::description-->
                <div class="row">
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.description_en')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="description_en" id="description_en" value="{{$level->description_en ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.description_en')}}" required />
                        <!--end::Input-->
                    </div>
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.description_ar')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="description_ar" id="description_ar" value="{{$level->description_ar ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.description_ar')}}" required />
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::description-->

                <!--begin::status-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.status')}}</label>
                    <!--end::Label-->
                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                        data-placeholder="Select an option" id="status" required>
                        <option></option>
                        <option value="1" @selected(($level->status ?? null) == 1)>{{__('site.active')}}</option>
                        <option value="0" @selected(($level->status ?? null) == 0)>{{__('site.non_active')}}</option>
                    </select>
                </div>
                <!--end::status-->

                <!--begin::point-->
                <div class="row">
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.point_status')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                        data-placeholder="Select an option" id="point_status" required>
                        <option></option>
                        <option value="1" @selected(($level->point_status ?? null) == 1)>{{__('site.active')}}</option>
                        <option value="0" @selected(($level->point_status ?? null) == 0)>{{__('site.non_active')}}</option>
                    </select>
                        <!--end::Input-->
                    </div>
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.point')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="point" id="point" value="{{$level->point ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.point')}}" required />
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::point-->

                <!--begin::diamonds gold silver-->
                <div class="row">
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.diamonds')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="diamonds" id="diamonds" value="{{$level->diamonds ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.diamonds')}}" required />
                        <!--end::Input-->
                    </div>
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.gold')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="gold" id="gold" value="{{$level->gold ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.gold')}}" required />
                        <!--end::Input-->
                    </div>
                    <div class="col-6 mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('site.silver')}}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="silver" id="silver" value="{{$level->silver ?? null}}" class="form-control mb-2"
                            placeholder="{{__('site.silver')}}" required />
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::diamonds gold silver-->

            </div>
            <!--end::Card header-->
        </div>
        <!--end::General options-->
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{route('level.index')}}" id="kt_ecommerce_add_product_cancel"
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
