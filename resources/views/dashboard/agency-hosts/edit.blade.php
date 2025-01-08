@extends('dashboard.parent')

@section('title',__('site.agency_hosts'))

@section('page_name',__('site.edit').' '.$agency->user->name)

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
    <li class="breadcrumb-item text-muted">{{__('site.agency_hosts')}}</li>
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
            {{-- form --}}
            @include('dashboard.agency-hosts._form', ['agency' => $agency ,'users' => $users ,'function' =>
            'update'])
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

    function update() {
        axios.put('/agency-hosts/{{$agency->id}}', {
            user_id: document.getElementById('user_id').value,
            status: document.getElementById('status').value,
            agent_ratio: document.getElementById('agent_ratio').value,
            host_ratio: document.getElementById('host_ratio').value,
            management_ratio: document.getElementById('management_ratio').value,
        })
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            window.location.href = '/agency-hosts';
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