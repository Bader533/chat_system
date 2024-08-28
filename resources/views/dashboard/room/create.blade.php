@extends('dashboard.parent')

@section('title',__('site.room'))

@section('page_name',__('site.add_new_room'))

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
    <li class="breadcrumb-item text-muted">{{__('site.room')}}</li>
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
            @include('dashboard.room._form', ['function' => 'store'])
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
    // buttonSideBar()

    // function buttonSideBar() {
    //     const button = document.getElementById('room');
    //     button.classList.add('here', 'show');
    // }

    function store() {
        let formData = new FormData();

        formData.append("name", document.getElementById('name').value);
        formData.append("description", document.getElementById('description').value);
        formData.append("country_id", document.getElementById('country_id').value);
        formData.append("city_id", document.getElementById('city_id').value);
        formData.append("roomtype_id", document.getElementById('roomtype_id').value);
        formData.append("status", document.getElementById('status').value);
        formData.append("avatar", document.getElementById('avatar').files[0]);

        axios.post('/room',formData)
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            window.location.href = '/room';
        }).catch(function (error) {
            // console.log(error);
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.error(error.response.data.message);
        });
    }

    //get cities for clicked country
    function getCities(countryId){
        console.log(countryId);
        axios.get(`/get-cities/${countryId}`)
        .then(function(response) {
            //2xx
            $('#select_option').html(response.data);
        })
        .catch(function(error) {
            //4xx - 5xx
            console.log('empty');

        });
    }

    document.getElementById('country_id').addEventListener('change', function() {
        const countryId = this.value;
        getCities(countryId);
    });

</script>
@endsection
