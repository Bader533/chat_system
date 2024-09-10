<form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::Status-->
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
            <div class="card-body pt-0">
                <!--begin::Select2-->
                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                    data-placeholder="Select an option" id="type">
                    <option></option>
                    <option value="diamonds" @if(($agency->type ?? null) == 'diamonds') selected="selected"
                        @endif>Diamonds
                    </option>
                    <option value="gold" @if(($agency->type ?? null) == 'gold') selected="selected"
                        @endif>Gold
                    </option>
                    <option value="silver" @if(($agency->type ?? null) == 'silver') selected="selected"
                        @endif>Silver
                    </option>
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

                <!--begin::name-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.user_id')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="user_id" id="user_id" value="" class="form-control mb-2"
                        placeholder="{{__('site.user_id')}}" required />
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::name-->

                <!--begin::quantity-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.quantity')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="quantity" id="quantity" value="" class="form-control mb-2"
                        placeholder="{{__('site.quantity')}}" required />
                    <!--end::Input-->
                    <!--begin::Description-->
                    {{-- <div class="text-muted fs-7">A name is required and recommended to be unique.
                    </div> --}}
                    <!--end::Description-->
                </div>
                <!--end::quantity-->


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