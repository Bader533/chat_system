@extends('dashboard.parent')

@section('title',__('site.agency'))

@section('page_name',__('site.agency'))

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
    <li class="breadcrumb-item text-muted">{{__('site.agency')}}</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{__('site.edit')}}</li>
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
            @include('dashboard.agency._form', ['function' => 'update', 'agency' => $agency])
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

    function update() {
        let formData = new FormData();
        formData.append("status", document.getElementById('status').value);
        formData.append("is_home", document.getElementById('is_home').value);
        formData.append("name", document.getElementById('name').value);
        formData.append("description", tinymce.get("kt_docs_tinymce_basic").getContent());
        formData.append("avatar",document.getElementById('avatar').files[0]);

        formData.append("_method", "PUT");
        axios.post('/agency/{{$agency->slug}}',formData)
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

    function buttonSideBar() {
        const button = document.getElementById('agency');
        // button.classList.add('active');
        button.classList.add('here', 'show');
    }

    var options = {selector: "#kt_docs_tinymce_basic", height : "480"};

    if ( KTThemeMode.getMode() === "dark" ) {
    options["skin"] = "oxide-dark";
    options["content_css"] = "dark";
    }

    tinymce.init(options);
</script>
@endsection
