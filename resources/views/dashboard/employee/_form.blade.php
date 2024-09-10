<form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

        <!--begin::Thumbnail settings-->
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
            <div class="card-body text-center pt-0">
                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                    data-placeholder="Select an option" id="status" required>
                    <option></option>
                    <option value="1" @selected(($employee->status ?? null) == 1)>{{__('site.active')}}</option>
                    <option value="0" @selected(($employee->status ?? null) == 0)>{{__('site.non_active')}}</option>
                </select>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Thumbnail settings-->

        <!--begin::Thumbnail settings-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{__('site.type')}}</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                    data-placeholder="Select an option" id="type" required>
                    <option></option>
                    <option value="1" @selected(($employee->type ?? null) == 1)>{{__('site.employee')}}</option>
                    <option value="0" @selected(($employee->type ?? null) == 0)>{{__('site.admin')}}</option>
                </select>
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
                <!--begin::title-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.name')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name" id="name" value="{{$employee->name ?? null}}"
                        class="form-control mb-2" placeholder="{{__('site.name')}}" required />
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::title-->

                <!--begin::email-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.email')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="email" id="email" value="{{$employee->email ?? null}}"
                        class="form-control mb-2" placeholder="{{__('site.email')}}" required />
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::email-->

                <!--begin::Main wrapper password-->
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold fs-6 mb-2">
                            {{ __('site.password') }}
                        </label>
                        <!--end::Label-->

                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                placeholder="" name="password" id="password" autocomplete="off" required />

                            <!--begin::Visibility toggle-->
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>

                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                            <!--end::Visibility toggle-->
                        </div>
                        <!--end::Input wrapper-->

                        <!--begin::Highlight meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Highlight meter-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Hint-->
                    <div id="passwordError" class="invalid-feedback"></div>
                    <!--end::Hint-->
                </div>

                <!--end::Main wrapper password-->

                <!--begin::Main wrapper password-->
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold fs-6 mb-2">
                            {{ __('site.password_confirmation') }}
                        </label>
                        <!--end::Label-->

                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                placeholder="" name="password_confirmation" id="password_confirmation"
                                autocomplete="off" required />

                            <!--begin::Visibility toggle-->
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>

                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                            <!--end::Visibility toggle-->
                        </div>
                        <!--end::Input wrapper-->

                        <!--begin::Highlight meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Highlight meter-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Hint-->
                    <div id="password_confirmationError" class="invalid-feedback"></div>
                    <!--end::Hint-->
                </div>
                <!--end::Main wrapper password-->


            </div>
            <!--end::Card header-->
        </div>
        <!--end::General options-->
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{route('employee.index')}}" id="kt_ecommerce_add_product_cancel"
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