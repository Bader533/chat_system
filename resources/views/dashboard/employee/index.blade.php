@extends('dashboard.parent')

@section('title',__('site.employee'))

@section('page_name',__('site.employee'))

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/checkbox.css')}}">
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
    <li class="breadcrumb-item text-muted">{{__('site.employee')}}</li>
    <!--end::Item-->
</ul>
@endsection

@section('actions')

@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-customer-table-filter="search" id="search_data"
                            class="form-control form-control-solid w-250px ps-15" placeholder="{{__('site.search')}}" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <!--begin::Add customer-->
                        <a href="{{ route('employee.create') }}" class="btn btn-primary">{{__('site.add_employee')}}
                        </a>
                        <!--end::Add customer-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="table-responsive card-body pt-0" id="table-content">

            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script>
    getEmployee();

    buttonSideBar()

    function buttonSideBar() {
        const button = document.getElementById('users');
        button.classList.add('active','show');
    }

    function getEmployee(page = 1, query = null){
        axios.get('/getEmployee', {
            params: {
                page: page,
                query: query,
            }
        })
        .then(function (response) {
            $('#table-content').html(response.data);
            }).catch(function (error) {
                console.error('There was an error!', error);
            });
    }

    document.getElementById('search_data').addEventListener('input', function () {
        const searchQuery = this.value;
        if (searchQuery) {
            console.log('data');
            getEmployee(1, searchQuery);
        } else {
            console.log('empty');
            getEmployee();
        }
    });

    function changeStatus(itemId) {
        axios.get('/status/employee', {
            params: {
                id: itemId
            }
        })
            .then(function (response) {
                console.log(response.data.message);
            }).catch(function (error) {
                console.error('There was an error!', error);
            });
    }


</script>
@endsection
