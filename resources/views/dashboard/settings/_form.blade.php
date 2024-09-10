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

                <div class="row">
                    <div class="col-md-4">
                        <label for="inputEmail4">{{__('site.type')}}</label>
                        <input type="text" class="form-control" id="type[diamonds]" placeholder="Diamonds"
                            value="diamonds" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4">{{__('site.quantity')}}</label>
                        <input type="number" class="form-control" id="quantity[diamonds]">
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4">{{__('site.dollor')}}</label>
                        <input type="number" class="form-control" id="dollar[diamonds]">
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-4">
                        <label for="inputEmail4">{{__('site.type')}}</label>
                        <input type="text" class="form-control" id="type[silver]" placeholder="Silver" value="silver"
                            disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4">{{__('site.quantity')}}</label>
                        <input type="number" class="form-control" id="quantity[silver]">
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4">{{__('site.dollor')}}</label>
                        <input type="number" class="form-control" id="dollar[silver]">
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-4">
                        <label for="inputEmail4">{{__('site.type')}}</label>
                        <input type="text" class="form-control" id="type[gold]" placeholder="Gold" value="gold"
                            disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4">{{__('site.quantity')}}</label>
                        <input type="number" class="form-control" id="quantity[gold]">
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4">{{__('site.dollor')}}</label>
                        <input type="number" class="form-control" id="dollar[gold]">
                    </div>
                </div><br>

                <!--begin::quantity-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('site.Percentage')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="number" name="percentage" id="percentage" value="" class="form-control mb-2"
                        placeholder="{{__('site.percentage')}}" required />
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