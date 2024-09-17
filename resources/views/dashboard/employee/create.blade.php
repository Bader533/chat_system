@extends('dashboard.parent')

@section('title',__('site.employee'))

@section('page_name',__('site.add_employee'))

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
    <li class="breadcrumb-item text-muted">{{__('site.roomtype')}}</li>
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
            @include('dashboard.employee._form', ['roles' => $roles ,'function' => 'store'])
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
        const button = document.getElementById('users');
        button.classList.add('here', 'show');
    }

    function store() {
        let formData = new FormData();

        formData.append("name", document.getElementById('name').value);
        formData.append("status", document.getElementById('status').value);
        // Handle multi-select roles
        let roleSelect = document.getElementById('role');
        let selectedRoles = Array.from(roleSelect.selectedOptions).map(option => option.value);
        selectedRoles.forEach(role => formData.append('roles[]', role));
        formData.append("role", selectedRoles);
        formData.append("type", document.getElementById('type').value);
        formData.append("email", document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value),
        formData.append('password_confirmation', document.getElementById('password_confirmation').value),

        axios.post('/employee',formData)
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            window.location.href = '/employee';
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