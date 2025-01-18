@extends('dashboard.parent')

@section('title',__('site.task'))

@section('page_name',__('site.add_new_task'))

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
    <li class="breadcrumb-item text-muted">{{__('site.task')}}</li>
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
            @include('dashboard.task._form', ['function' => 'store'])
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
        const button = document.getElementById('task');
        button.classList.add('here', 'show');
    }

    function store() {
        let formData = new FormData();

        formData.append("name_en", document.getElementById('name_en').value);
        formData.append("name_ar", document.getElementById('name_ar').value);
        formData.append("description_en", document.getElementById('description_en').value);
        formData.append("description_ar", document.getElementById('description_ar').value);
        formData.append("diamonds", document.getElementById('diamonds').value);
        formData.append("gold", document.getElementById('gold').value);
        formData.append("silver", document.getElementById('silver').value);
        formData.append("days", document.getElementById('days').value);
        formData.append("status", document.getElementById('status').value);
        formData.append("point_status", document.getElementById('point_status').value);
        formData.append("point", document.getElementById('point').value);
        formData.append("avatar", document.getElementById('avatar').files[0]);

        axios.post('/task',formData)
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            window.location.href = '/task';
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