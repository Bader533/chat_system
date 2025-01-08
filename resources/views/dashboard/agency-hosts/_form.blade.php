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
                    <label class="required form-label">{{__('site.user')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                        data-placeholder="Select an option" id="user_id" required>
                        <option></option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}" @selected(($agency->user_id ?? null) == $user->id)>{{$user->name}}
                        </option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::title-->

                <!--begin::title-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.status')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                        data-placeholder="Select an option" id="status" required>
                        <option></option>
                        <option value="0" @selected(($agency->status ?? null) == 0)>{{__('site.non_active')}}</option>
                        <option value="1" @selected(($agency->status ?? null) == 1)>{{__('site.active')}}</option>
                    </select>
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::title-->

                <!--begin::agent_ratio-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.agent_ratio')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="agent_ratio" id="agent_ratio" value="{{$agency->agent_ratio ?? null}}"
                        class="form-control mb-2" placeholder="{{__('site.agent_ratio')}}" required />
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::agent_ratio-->

                <!--begin::host_ratio-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.host_ratio')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="host_ratio" id="host_ratio" value="{{$agency->host_ratio ?? null}}"
                        class="form-control mb-2" placeholder="{{__('site.host_ratio')}}" required />
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::host_ratio-->

                <!--begin::management_ratio-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.management_ratio')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="management_ratio" id="management_ratio"
                        value="{{$agency->management_ratio ?? null}}" class="form-control mb-2"
                        placeholder="{{__('site.management_ratio')}}" required />
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::management_ratio-->

            </div>
            <!--end::Card header-->
        </div>
        <!--end::General options-->
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{route('agency-hosts.index')}}" id="kt_ecommerce_add_product_cancel"
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