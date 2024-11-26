@extends('dashboard.parent')

@section('title',__('site.city'))

@section('page_name',__('site.add_new_city'))

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
    <li class="breadcrumb-item text-muted">{{__('site.city')}}</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{__('site.create')}}</li>
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
            {{-- form --}}
            @include('dashboard.city._form', ['countries' => $countries,'function' => 'store'])
            {{-- end form --}}
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content container-->
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script>
    buttonSideBar()

    function buttonSideBar() {
        const button = document.getElementById('city');
        button.classList.add('here', 'show');
    }

    function store() {
        let formData = new FormData();

        formData.append("name_en", document.getElementById('name_en').value);
        formData.append("name_ar", document.getElementById('name_ar').value);
        formData.append("country_id", document.getElementById('country_id').value);
        formData.append("status", document.getElementById('status').value);
        formData.append("avatar", document.getElementById('avatar').files[0]);

        axios.post('/city',formData)
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            window.location.href = '/city';
        }).catch(function (error) {
            // console.log(error);
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.error(error.response.data.message);
        });
    }

</script>
@endsection
